<?php

namespace App\Helpers\Api\V1;


use App\Model\TransmgtSenderReceiver;
use App\Model\UsrmgtAccount;
use App\Model\UsrmgtAccountState;
use App\Model\UsrmgtCustomerAccount;
use App\Model\UsrmgtPerson;
use App\Models\UserManagement\AccountState;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

trait AuthenticationHelper {

    use TranslationHelper;


    private function userIntegrity($search,$err_code_function){
        $err_code_function = $err_code_function."UI";
        $fair_user['status'] = false;
        $fair_user['customer_account'] = UsrmgtCustomerAccount::where('phone_number','=',$search)
            ->orWhere('account_number','=',$search)
            ->where('deleted_at', '=',null)->first();
        if (!$fair_user['customer_account']){
            $fair_user['err_title'] = __('api_auth.account_inexist');
            $fair_user['err_msg'] = __('api_auth.account_inexist');
            $fair_user['err_code'] = $this->err_code.$err_code_function."1";
            return $fair_user;
        }

        $fair_user['account'] = UsrmgtAccount::where('id_customer_account','=',$fair_user['customer_account']->id_customer_account)
            ->where('deleted_at', '=',null)->first();
        $fair_user['sender_receiver'] = TransmgtSenderReceiver::where('id_customer_account','=',$fair_user['customer_account']->id_customer_account)
            ->where('deleted_at', '=',null)->first();
        if (!$fair_user['sender_receiver']){
            $fair_user['err_title'] = __('api_auth.account_inexist');
            $fair_user['err_msg'] = __('api_auth.account_inexist');
            $fair_user['err_code'] = $this->err_code.$err_code_function."2";
            return $fair_user;
        }
        if (!$fair_user['account']){
            $fair_user['status'] = 0;
            $fair_user['err_title'] = __('api_auth.account_inexist');
            $fair_user['err_msg'] = __('api_auth.account_inexist');
            $fair_user['err_code'] = $this->err_code.$err_code_function."3";
            return $fair_user;
        }
        $fair_user['person'] = UsrmgtPerson::where('id_person','=',$fair_user['account']->id_person)
            ->where('state', '=',UsrmgtPerson::$ACTIVE_PERSON)
            ->where('deleted_at', '=',null)->first();
        if (!$fair_user['person']){
            $fair_user['err_title'] = __('api_auth.account_inexist');
            $fair_user['err_msg'] = __('api_auth.account_inexist');
            $fair_user['err_code'] = $this->err_code.$err_code_function."4";
            return $fair_user;
        }
        $fair_user['status'] = true;
        return $fair_user;
    }

    private function doesAccountHavePrivilege($id_account_state,$privilege_code){

        $account_state = UsrmgtAccountState::where('id_account_state','=',$id_account_state)->first();
        $account_privileges = $account_state->customPrivilege($privilege_code)->first();
        if ($account_privileges)
            return true;

        return false;
    }


}
