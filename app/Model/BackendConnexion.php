<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BackendConnexion extends Model
{
    //
    protected $table = 'usrmgt_backend_connexion';
    protected $primaryKey = 'id';

    public function droits($id){
        $actions = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id', [$id])
            ->select('usrmgt_backend_action.*')
            ->get();

        $actionsprofile = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_actionprofile', 'usrmgt_backend_actionconnexionprofile.actionprofile_id', '=', 'usrmgt_backend_actionprofile.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id', [$id])
            ->select('usrmgt_backend_action.*')
            ->get();
        return Arr::collapse([$actions, $actionsprofile]);
    }

    public function actions($id){
        $actions = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id', [$id])
            ->select('usrmgt_backend_action.code')
            ->get()
            ->pluck('code');

        $actionsprofile = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_actionprofile', 'usrmgt_backend_actionconnexionprofile.actionprofile_id', '=', 'usrmgt_backend_actionprofile.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id', [$id])
            ->select('usrmgt_backend_action.code')
            ->get()
            ->pluck('code');
        return Arr::collapse([$actions, $actionsprofile]);
    }

    public function process($id){
        $actions = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id = ? and usrmgt_backend_action.is_business_process = ? and usrmgt_backend_action.state = ?', [$id, 1, 1])
            ->select('usrmgt_backend_action.code')
            ->get()
            ->pluck('code');

        $actionsprofile = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_actionprofile', 'usrmgt_backend_actionconnexionprofile.actionprofile_id', '=', 'usrmgt_backend_actionprofile.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->whereRaw('usrmgt_backend_connexion.id = ? and usrmgt_backend_action.is_business_process = ? and usrmgt_backend_action.state = ?', [$id, 1, 1])
            ->select('usrmgt_backend_action.code')
            ->get()
            ->pluck('code');
        return Arr::collapse([$actions, $actionsprofile]);
    }

    public function main($id){
        $listmodule = array();

        $modules = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->join('usrmgt_backend_moduleaction', 'usrmgt_backend_action.id', '=', 'usrmgt_backend_moduleaction.action_id')
            ->join('usrmgt_backend_module', 'usrmgt_backend_moduleaction.module_id', '=', 'usrmgt_backend_module.id')
            ->whereRaw('usrmgt_backend_connexion.id = ? and usrmgt_backend_action.is_view = 1', [$id])
            ->select('usrmgt_backend_module.id as module_id', 'usrmgt_backend_module.libelle as module', 'usrmgt_backend_action.id as droit_id', 'usrmgt_backend_action.code as droit', 'usrmgt_backend_action.display_name as libelle_droit')
            ->get();

        $modulesprofile = DB::table('usrmgt_backend_connexion')
            ->join('usrmgt_backend_actionconnexionprofile', 'usrmgt_backend_actionconnexionprofile.connexion_id', '=', 'usrmgt_backend_connexion.id')
            ->join('usrmgt_backend_actionprofile', 'usrmgt_backend_actionconnexionprofile.actionprofile_id', '=', 'usrmgt_backend_actionprofile.id')
            ->join('usrmgt_backend_action_typepartner', 'usrmgt_backend_actionconnexionprofile.actiontypepartner_id', '=', 'usrmgt_backend_action_typepartner.id')
            ->join('usrmgt_backend_action', 'usrmgt_backend_action_typepartner.action_id', '=', 'usrmgt_backend_action.id')
            ->join('usrmgt_backend_moduleaction', 'usrmgt_backend_action.id', '=', 'usrmgt_backend_moduleaction.action_id')
            ->join('usrmgt_backend_module', 'usrmgt_backend_moduleaction.module_id', '=', 'usrmgt_backend_module.id')
            ->whereRaw('usrmgt_backend_connexion.id = ? and usrmgt_backend_action.is_view = 1', [$id])
            ->select('usrmgt_backend_module.id as module_id', 'usrmgt_backend_module.libelle as module', 'usrmgt_backend_action.id as droit_id', 'usrmgt_backend_action.code as droit', 'usrmgt_backend_action.display_name as libelle_droit')
            ->get();

        $modules = Arr::collapse([$modules, $modulesprofile]);
        $idmodules = [];
        $fullmodules = [];

        foreach ($modules as $module){
            if(!in_array($module->module_id, $idmodules)){
                $idmodules[] = $module->module_id;
                $fullmodules[] = array([
                    $module->module_id, $module->module
                ]);
            }
        }

        foreach ($idmodules as $key => $idmodule){
            $droitsmodule = [];
            foreach ($modules as $module){
                if($idmodule == $module->module_id){
                    $droitsmodule[] = [
                        $module->droit_id,
                        $module->droit,
                        $module->libelle_droit,
                    ];
                }
            }

            $listmodule[] = array([
                $fullmodules[$key][0][0],
                $fullmodules[$key][0][1],
                $droitsmodule
            ]);
        }

        return $listmodule;
    }

    public function migrations(){
        return $this->hasMany(BackendConnexion::class, 'connexion_id');
    }

    public function migration_actif(){
        $migrations = DB::table('agcymgt_migration')
            ->join('usrmgt_backend_connexion', 'usrmgt_backend_connexion.id', '=', 'agcymgt_migration.connexion_id')
            ->whereRaw('agcymgt_migration.connexion_id = ? and agcymgt_migration.state = ?', [$this->id, 1])
            ->select('agcymgt_migration.*')
            ->get();
        return $migrations;
    }

    public function partner(){
        return $this->belongsTo(Partner::class, 'partner_id');
    }

     public function admin_operatrices(){
        return $this->hasMany(UsrmgtAdministrationAccount::class, 'id_admin_account');
    }
}
