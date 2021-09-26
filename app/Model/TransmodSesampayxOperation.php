<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransmodSesampayxOperation extends Model
{

    public static $LITTLESHOPP_PAYBILL_REF = "SO_PYBLIT";
    //
    protected $table = 'transmod_sesampayxoperation';
    protected $primaryKey = 'id_sesampayx_operation';
}
