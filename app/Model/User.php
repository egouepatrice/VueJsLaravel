<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    protected $table = 'usrmgt_administrationaccount';
    protected $primaryKey = 'id_admin_account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function connexion(){
        return $this->hasOne(BackendConnexion::class, 'administration_id');
    }

    public function actions(){
        return $this->connexion->actions($this->connexion->id);
    }

    public function droits(){
        return $this->connexion->droits($this->connexion->id);
    }

    public function main(){
        return $this->connexion->main($this->connexion->id);
    }

    public function process(){
        return $this->connexion->process($this->connexion->id);
    }

    public function account(){
        return $this->hasOne(UsrmgtAccount::class, 'id_admin_account');
    }
}
