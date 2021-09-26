<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BackendModule extends Model
{
    //
    protected $table = 'usrmgt_backend_module';
    protected $primaryKey = 'id';

    public function moduleactions(){
        return $this->hasMany(BackendModuleAction::class, 'module_id');
    }
}
