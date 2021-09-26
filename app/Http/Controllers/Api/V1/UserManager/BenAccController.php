<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\Helpers\Api\V1\AuthenticationHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BenAccBenAccSubscriptionResource;
use App\Http\Resources\BenAccBenAccTypeResource;
use App\Model\BenAccBenAccSubscription;
use App\Model\BenAccBenAccType;
use App\Model\BenAccCustommerAdvantage;
use App\Model\Partner;
use App\Model\TransmodSesampayxOperation;
use App\Model\UsrmgtPrivilege;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class BenAccController extends Controller
{
    use AuthenticationHelper;
    private $err_code = "BAC-";

    public function userBenAccStatus (Request $request){

        $err_code_function = "UBS";
        $locale = App::getLocale();
        $fair_user = $request->fair_user;


        try{

            if(!$this->doesAccountHavePrivilege($fair_user['customer_account']->id_account_state,UsrmgtPrivilege::$ACCESS_PLATFORM)){
                $response['status'] = 0;
                $response['err_title'] = __('api_auth.unothorised_operation');
                $response['err_msg'] = __('api_auth.cannot_access_services');
                $response['err_code'] = $this->err_code.$err_code_function."1";
                $response['search']=$request->input('search');
                return response()->json($response, 404);
            }

            $last_subscription=BenAccBenAccSubscription::where('id_type_ben_account',"=",$fair_user['customer_account']->id_type_ben_account)
                ->where('id_customer_account',"=",$fair_user['customer_account']->id_customer_account)
                ->where('deleted_at',"=",null)
                ->orderBy('created_at','desc')->first();


            $data['search']=$request->input('search');

            //vérification de la validité du compte
            $verify_acc_validity = $this->verifysubscriptionActive($last_subscription);
            if ($verify_acc_validity['status'] == 1){
                $data['last_subscription'] = new BenAccBenAccSubscriptionResource($last_subscription);
            }else{
                $verify_acc_validity['search']=$request->input('search');
                return response()->json($verify_acc_validity, 404);
            }


            $data['active_benacc']=BenAccBenAccType::where('id_type_ben_account',"=",$fair_user['customer_account']->id_type_ben_account)
                ->where('deleted_at',"=",null)->first();

            if($data['active_benacc']){
                //setting the correct value for not french
                if ($locale!="fr") {
                    $data['active_benacc']['denomination'] = $this->translate(
                        BenAccBenAccType::$TABLE_NAME,
                        BenAccBenAccType::$DENOMINATION_COLUMN,
                        $data['active_benacc']['id_type_ben_account'],
                        $locale
                    );
                    $data['active_benacc']['description'] = $this->translate(
                        BenAccBenAccType::$TABLE_NAME,
                        BenAccBenAccType::$DESCRIPTION_COLUMN,
                        $data['active_benacc']['id_type_ben_account'],
                        $locale
                    );
                }
            }
            if ($data['active_benacc']){
                $data['active_benacc'] = new BenAccBenAccTypeResource($data['active_benacc']);
            }

            $response['status']=1;
            $response['data']=$data;

            return response()->json($response, 200);

        }catch (\Exception $exception){

            Bugsnag::notifyException(new RuntimeException($exception));
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.server_error_title');
            $response['err_msg'] = __('api_auth.server_error_msg');
            $response['err_code'] = $this->err_code.$err_code_function."EX";
            $response['search']=$request->input('search');

            return response()->json($response, 500);
        }
    }

    private function verifysubscriptionActive($last_subscription){
        $err_code_function = 'VSA';

        if (!$last_subscription){
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.not_up_to_date_accout');
            $response['err_msg'] = __('api_auth.not_up_to_date_accout_msg');
            $response['err_code'] = $this->err_code.$err_code_function."1";
            return $response;
        }
        $lastsub_end_date = new Carbon($last_subscription->end_date);


        if($lastsub_end_date->lessThan(Carbon::now())){
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.not_up_to_date_accout');
            $response['err_msg'] = __('api_auth.not_up_to_date_accout_msg');
            $response['err_code'] = $this->err_code.$err_code_function."2";
            return $response;
        }else{
            if ($last_subscription->is_subscription_active){
                $response['status'] = 1;
                return $response;
            }else{
                $response['status'] = 0;
                $response['err_title'] = __('api_auth.not_up_to_date_accout');
                $response['err_msg'] = __('api_auth.not_up_to_date_accout_msg');
                $response['err_code'] = $this->err_code.$err_code_function."3";
                return $response;
            }
        }
    }

    public function saveAdvantage (Request $request){

        $err_code_function = "SA";
        $locale = App::getLocale();
        $fair_user = $request->fair_user;
        try{

            //vérification de l'id de la souscription
            $current_subscription=BenAccBenAccSubscription::where('id_customer_account',"=",$fair_user['customer_account']->id_customer_account)
                ->where('id_subscription',"=",$request->input('subscription_ref'))
                ->first();

            if (!$current_subscription){
                $response['status'] = 0;
                $response['err_title'] = __('api_auth.incorrect_datas');
                $response['err_msg'] = __('api_auth.id_subscription_incorrect');
                $response['err_code'] = $this->err_code.$err_code_function."1";
                return response()->json($response, 404);
            }
            switch ($request->input('service_code')){
                case "LITTLESHOP_BILL":
                    $response = $this->payLittleshoppBill($fair_user['customer_account']->id_customer_account,$request->input('subscription_ref'),$request->advantage);
                    return response()->json($response, 200);
                default:
                    $response['status'] = 0;
                    $response['err_title'] = __('api_auth.incorrect_datas');
                    $response['err_msg'] = __('api_auth.service_code_incorrect');
                    $response['err_code'] = $this->err_code.$err_code_function."2";
                    return response()->json($response, 404);
            }

        }catch (\Exception $exception){

            Bugsnag::notifyException(new RuntimeException($exception));
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.server_error_title');
            $response['err_msg'] = __('api_auth.server_error_msg');
            $response['err_code'] = $this->err_code.$err_code_function."EX";

            return response()->json($response, 500);
        }
    }

    private function payLittleshoppBill($id_custommer_account,$id_subscription,$advantage){

        $err_code_function = "PLB";

        $partner_service_id = DB::table('partmgt_ser_partnerservice')
            ->join('partmgt_partner', function ($join) {
                $join->on('partmgt_partner.id_partner', '=', 'partmgt_ser_partnerservice.id_partner')
                    ->where('partmgt_partner.abbr', '=', Partner::$LITTLESHOPP_ABBREV);
            })
            ->join('transmod_sesampayxoperation', function ($join) {
                $join->on('transmod_sesampayxoperation.id_sesampayx_operation', '=', 'partmgt_ser_partnerservice.id_sesampayx_operation')
                    ->where('transmod_sesampayxoperation.reference', '=', TransmodSesampayxOperation::$LITTLESHOPP_PAYBILL_REF);
            })
            ->select( 'partmgt_ser_partnerservice.id_partner_service')
            ->where('partmgt_ser_partnerservice.deleted_at',"=",null)->first();

        if (!$partner_service_id){
            $response['status'] = 0;
            $response['err_title'] = __('api_auth.server_error_title');
            $response['err_msg'] = __('api_auth.server_error_msg');
            $response['err_code'] = $this->err_code.$err_code_function."1";

            return $response;
        }

        $cust_advantage = new BenAccCustommerAdvantage([
            'id_partner_service'=>$partner_service_id->id_partner_service,
            'id_subscription'=> $id_subscription,
            'id_customer_account'=>$id_custommer_account,
            'price_before'=>$advantage['price_before'],
            'price_after'=>$advantage['price_after'],
            'description'=>$advantage['description'],
            'state'=>BenAccCustommerAdvantage::$ACTIVE_ADVANAGE
        ]);
        $cust_advantage->save();

        $response['status'] = 1;

        return $response;
    }
}
