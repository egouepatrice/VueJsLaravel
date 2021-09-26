<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsrmgtPrivilege extends Model
{

    public static $ACCESS_PLATFORM = 'PRI_SPX_ACCESS';
    public static $USE_BENEFITS_ACCOUNT = 'PRI_BENACC';
    public static $WITHDRAW = 'PRI_SPX_WTDRW';
    public static $ACCOUNT_TRANSFERT = 'PRI_SPX_TRSCUST';
    public static $RECEIVE_ACCOUNT_TRANSFERT = 'PRI_SPX_RECTRSCUST';
    public static $NON_ACCOUNT_TRANSFERT = 'PRI_SPX_TRSNCUST';
    public static $DEPOSIT = 'PRI_SPX_DPSIT';
    public static $PAYMENT = 'PRI_SPX_PAY';
    public static $VERIFY_BALANCE = 'VERIFY_BALANCE';
    //
    protected $table = 'usrmgt_privilege';
    protected $primaryKey = 'id_privilege';
}
