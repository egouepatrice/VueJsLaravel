<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsrmgtAdministrationAccount extends Model
{
    //
    protected $table = 'usrmgt_administrationaccount';
    protected $primaryKey = 'id_admin_account';

    public function connexion(){
        return $this->belongsTo(BackendConnexion::class, 'id_admin_account');
    }
}
