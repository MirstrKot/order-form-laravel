<?php

namespace App\Http\Controllers;

use App\Plan;

class PlanController extends Controller
{
    public function list()
    {
        $plan = new Plan();
        return $plan->allWithDaysArray();
    }
}
