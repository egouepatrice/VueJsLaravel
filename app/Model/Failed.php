<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Failed extends Model
{
    //

    protected $table = 'failed_jobs';
    protected $primaryKey = 'id';
}
