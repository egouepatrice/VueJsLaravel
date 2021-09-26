<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyMgtMigration extends Model
{
    use SoftDeletes;
    protected $table = 'agcymgt_migration';

    public function connexion(){
        return $this->belongsTo(BackendConnexion::class, 'connexion_id');
    }

    public function cashregister(){
        return $this->belongsTo(AgencyMgtCashRegister::class, 'cashregister_id');
    }
}
