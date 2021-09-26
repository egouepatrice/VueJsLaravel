<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsrmgtPerson extends Model
{
    public static $ACTIVE_PERSON = 'ACTIVE';
    //
    protected $table = 'usrmgt_person';
    protected $primaryKey = "id_person";

    public function account(){
        return $this->hasOne(UsrmgtAccount::class, 'id_person');
    }
}
