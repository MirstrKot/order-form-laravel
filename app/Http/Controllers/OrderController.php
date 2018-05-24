<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Plan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $this->validateData($request);
        $input_data = $request->all();
        $this->storeData($input_data);
        return $input_data;
    }

    private function storeData($input_data)
    {
        $order = new Order();
        $order->fill($input_data);
        $date = new DateTime($input_data['date']);
        $order->date = $date->format("Y-m-d");
        if (!$user = User::where('phone', $input_data['phone'])->first()) {
            $user = User::create($input_data);
        }
        $order->user_id = $user->id;
        $order->save();
        return $order;
    }

    private function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|digits:10',
            'plan_id' => 'required|exists:plans,id',
            'date' => 'required|date',
            'address' => 'required',
        ]);
        $validator->after(function ($validator) {
            if (!$this->validateDayOfWeek($validator->getData())) {
                $validator->errors()->add('date', 'Данный тариф не доставляется в этот день недели');
            }
        });
        $validator->validate();
    }

    private function validateDayOfWeek($input_data)
    {
        return ($plan = Plan::find($input_data['plan_id'])) && $plan->isDateSuitable($input_data['date']);
    }
}
