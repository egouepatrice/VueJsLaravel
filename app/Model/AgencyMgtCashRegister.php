<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AgencyMgtCashRegister extends Model
{
    //
    protected $table = 'agcymgt_cashregister';
    protected $primaryKey = 'id_cash_register';

    public function agence()
    {
        return $this->belongsTo(AgencyMgt::class, 'id_agency');
    }

    public function migrations(){
        return $this->hasMany(AgencyMgtMigration::class, 'cashregister_id');
    }
}
