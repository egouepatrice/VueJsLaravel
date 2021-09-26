<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BenAccCustommerAdvantage extends Model
{
    public static $ACTIVE_ADVANAGE = "ACTIVE";
    public static $INACTIVE_ADVANAGE = "INACTIVE";
    //
    protected $table = 'benacc_custommeradvantage';
    protected $primaryKey = ' id_custommer_advantage';

    protected $fillable = [
        'id_partner_service', 'id_subscription',
        'id_customer_account', 'price_before','price_after','description','state'
    ];
}
