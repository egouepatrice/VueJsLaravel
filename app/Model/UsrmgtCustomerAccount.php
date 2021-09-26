<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsrmgtCustomerAccount extends Model
{
    //
    protected $table = 'usrmgt_customeraccount';
    protected $primaryKey = "id_customer_account";

    public function account(){
        return $this->hasOne(UsrmgtAccount::class, 'id_customer_account');
    }

    public function benefitA(){
        return $this->belongsTo(BenAccBenAccType::class, 'id_type_ben_account');
    }

    public function souscriptionsBen(){
        return $this->hasMany(BenAccBenAccSubscription::class, 'id_customer_account');
    }

    public function is_ben_enabled(){
        $subscription_actif = BenAccBenAccSubscription::where([
            ['id_customer_account', '=', $this->id_customer_account]
        ])->get();
        $subscription = sizeof($subscription_actif) > 0 ? $subscription_actif[sizeof($subscription_actif) - 1] : null;
        return $subscription->end_date > date('Y-m-d H:i:s') ? $subscription : null;
    }
}
