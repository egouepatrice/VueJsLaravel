<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsrmgtAccountState extends Model
{
    //
    protected $table = 'usrmgt_accountstate';
    protected $primaryKey = 'id_account_state';

    public function privileges(){

        return $this->belongsToMany('App\Model\UsrmgtPrivilege','usrmgt_privilegegrantedtoaccstate','id_account_state','id_privilege')
            ->where('usrmgt_privilegegrantedtoaccstate.deleted_at', '=',null);

    }

    public function customPrivilege($privilege_code){

        return $this->belongsToMany('App\Model\UsrmgtPrivilege','usrmgt_privilegegrantedtoaccstate','id_account_state','id_privilege')
            ->where('usrmgt_privilege.code', '=',$privilege_code)
            ->where('usrmgt_privilegegrantedtoaccstate.deleted_at', '=',null);

    }
}
