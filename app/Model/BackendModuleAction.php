<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BackendModuleAction extends Model
{
    protected $table = 'usrmgt_backend_moduleaction';
    protected $primaryKey = 'id';

    public function action(){
        return $this->belongsTo(BackendAction::class, 'action_id');
    }

    public function module(){
        return $this->belongsTo(BackendModule::class, 'module_id');
    }
}
