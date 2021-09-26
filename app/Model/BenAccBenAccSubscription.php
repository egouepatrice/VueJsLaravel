<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BenAccBenAccSubscription extends Model
{
    //
    protected $table = 'benacc_benaccsubscription';
    protected $primaryKey = 'id_subscription';

    public function customer(){
        return $this->belongsTo(UsrmgtCustomerAccount::class, 'id_customer_account');
    }

    public function benefitType(){
        return $this->belongsTo(BenAccBenAccType::class, "id_type_ben_account");
    }
}
