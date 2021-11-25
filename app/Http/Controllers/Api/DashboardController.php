<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function totalTransfer(){
        $id = 1;
        $total_conversion_amount = Conversion::where('sender_id',$id)->sum('amount');
        return $this->sendResponse('The total amount converted for a particular user.',$total_conversion_amount);
    }

    public function thirdTransfer(){
        $id = 1;
        $third_highest_transaction = Conversion::select([
            'third_highest' => Conversion::select('amount')->orderByDesc('amount')->limit(1)->offset(2)->where('sender_id',$id)
        ])->first();
        return $this->sendResponse('The third highest amount of transactions for a particular user.',$third_highest_transaction['third_highest']);
    }

    public function mostTransfer(){
        $most_transaction = Conversion::with('users')->get()->groupBy('sender_id')->max()->take(1);
        return $this->sendResponse('User who used most conversion.',$most_transaction);
    }

    public function sendResponse($message,$data){
        return response([
            'message'=>$message,
            'data' => $data
        ]);
    }


}
