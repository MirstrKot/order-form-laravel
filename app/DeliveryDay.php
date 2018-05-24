<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Дни недели доставки по тарифу
 * @property integer $day_of_week
 * @property integer $plan_id
 * @property Plan $plan
 */
class DeliveryDay extends Model
{
    public $timestamps = false;

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
