<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Тариф
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property array $days
 */
class Plan extends Model
{
    public $timestamps = false;

    public function days()
    {
        return $this->hasMany('App\DeliveryDay');
    }

    /**
     * Возвращает все тарифы с доступными днями недели в виде массива
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function allWithDaysArray()
    {
        $plans = self::with('days')->get();
        foreach ($plans as &$plan) {
            $days_array = [];
            foreach ($plan->days as $day) {
                $days_array[] = $day->day_of_week;
            }
            $plan->days_array = $days_array;
        }
        return $plans;
    }

    /**
     * Проверяет является ли дата подходящим днем недели
     * @param $date
     * @return bool
     */
    public function isDateSuitable($date)
    {
        $date = new DateTime($date);
        $day_of_week = intval($date->format('w'));
        foreach ($this->days as $day) {
            if ($day_of_week == $day->day_of_week) return true;
        }
        return false;
    }
}
