<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\exchangeTrait;
use App\Models\Conversion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    use exchangeTrait;
    public function transferMoney(Request $request){
        //validation
        $id = 1;
        $sender = User::find($id);
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'exists:users,id',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        //check sender balance
        if($sender->balance < $request->amount){
            return response(['errors'=> 'you do not have sufficient balance'], 404);
        }
        //find receiver info
        $receiver = User::find($request->receiver_id);
        $transferred_amount = $this->currencyConversion($sender->currency,$receiver->currency,$request->amount); //init transfer
        if(empty($transferred_amount)){
            return response(['errors'=> 'Somethings wrong. Please check the data'], 404);
        }

        return response($this->saveTransferData($request,$receiver,$transferred_amount,$sender),200);

    }

    public function saveTransferData($request,$receiver,$transferred_amount,$sender){
        //save conversion info
        $conversion = Conversion::create([
            'sender_id' => $sender->id,
            'receiver_id' => $request->receiver_id,
            'sender_previous_balance' => $sender->balance,
            'sender_current_balance' => $sender->balance - $request->amount,
            'receiver_previous_balance' => $receiver->balance,
            'receiver_current_balance' => $receiver->balance + $transferred_amount,
            'amount' => $request->amount,
            'transferred_amount' => $transferred_amount
        ]);

        //update sender info
        //$sender = Auth::user();
        $sender->balance = $sender->balance - $request->amount;
        $sender->save();

        //update reveiver info
        $receiver->balance = $receiver->balance + $transferred_amount;
        $receiver->save();

        return ['message' => 'Money Transferred successfully'];
    }


    public function allUser(){
        $users = User::all();
        return response([
            'data' => $users
        ],200);
    }




}
