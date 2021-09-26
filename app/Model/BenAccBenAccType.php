<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BenAccBenAccType extends Model
{
    public static $TABLE_NAME = 'benacc_benacctype';
    public static $DENOMINATION_COLUMN = 'denomination';
    public static $DESCRIPTION_COLUMN = 'description';
    //
    protected $table = 'benacc_benacctype';
    protected $primaryKey = 'id_type_ben_account';

    public function customer(){
        return $this->hasMany(UsrmgtCustomerAccount::class, "id_type_ben_account");
    }

    public function subscriptions(){
        return $this->hasMany(BenAccBenAccSubscription::class, 'id_type_ben_account');
    }
}
