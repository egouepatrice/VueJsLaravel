<?php

namespace App\Http\Controllers\Api\V1\UserManager;

use App\Http\Controllers\Controller;
use App\Model\BackendConnexion;
use App\Model\BenAccBenAccType;
use App\Model\UsrmgtCustomerAccount;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function users(Request $request){
        $connexions = null;
        try{
            $connexions = BackendConnexion::all();
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $connexions;
    }

    public function user(Request $request, $id){
        $connexion = null;
        try{
            $connexion = BackendConnexion::findOrFail($id);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return response()->json($connexion);
    }

    public function user_actions(Request $request, $id){
        $connexion = null;
        try{
            $connexion = BackendConnexion::find($id);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $connexion;
    }

    public function user_search(Request $request){
        $result = null;
        $benetype = null;
        $q = trim($request->get('q'));

        try{
            // La recherche se fait sur la table suivante "usrmgt_customeraccount"
            $customer = UsrmgtCustomerAccount::where([
                ['account_number', '=', $q],
                ['phone_number', '=', $q],
            ])->first();

            $result = $customer != null ? $customer->is_ben_enabled() : null;

        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }

        return response()->json([
            'search' => $q,
            'response' => $result != null ? "found" : "not_found",
            'reference' => $result != null ? $result->benefitType->reference : null,
            'denomination' => $result != null ? $result->benefitType->denomination : null,
            'status_account' => $result != null ? "ACTIVE" : null,
            'expire_le' => $result != null ? $result->end_date : null,
        ]);
    }

}
