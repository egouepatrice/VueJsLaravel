<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public static $LITTLESHOPP_ABBREV = "littleshopp";
    //
    protected $table = 'partmgt_partner';
    protected $primaryKey = 'id';
}
