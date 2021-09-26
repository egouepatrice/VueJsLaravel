<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AgencyMgt extends Model
{
    //
    protected $table = 'agcymgt_agency';
    protected $primaryKey = 'id_agency';


    public function caisses()
    {
        return $this->hasMany(AgencyMgtCashRegister::class, 'id_agency');
    }
}
