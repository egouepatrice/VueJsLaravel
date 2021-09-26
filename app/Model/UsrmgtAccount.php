<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsrmgtAccount extends Model
{
    //
    protected $table = 'usrmgt_account';
    protected $primaryKey = 'id_account';

    public function person(){
        return $this->belongsTo(UsrmgtPerson::class, "id_person");
    }

    public function customer(){
        return $this->belongsTo(UsrmgtCustomerAccount::class, "id_customer_account");
    }
}
