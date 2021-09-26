<?php

namespace App\Helpers\Api\V1;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


trait VerifyDataHelper {

    public function validationData(Request $request, $routeName){
        switch ($routeName){
            case 'user_ben_acc_status':
                return $this->user_ben_acc_status($request);
            case 'save_advantage':
                return $this->save_advantage($request);
            default:
                return [];
        }

    }


    private function user_ben_acc_status(Request $request){
        return  [
            'lan' => 'required|string|',
            'search' => 'required|string'
        ];
    }

    private function save_advantage(Request $request){
        return  [
            'lan' => 'required|string|',
            'subscription_ref' => 'required|integer',
            'search' => 'required|string',
            'advantage.price_before' => 'required|numeric',
            'advantage.price_after' => 'required|numeric',
            'advantage.description' => 'required|string',
        ];
    }

}
