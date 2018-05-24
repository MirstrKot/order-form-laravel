<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Заказ
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $date
 * @property integer $user_id
 */
class Order extends Model
{
    protected $fillable = ['name', 'address', 'plan_id'];
}
