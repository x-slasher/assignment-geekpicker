<?php
namespace App\Http\Traits;

trait exchangeTrait{
    //currency conversion api

    public function currencyConversion($from,$to,$amount){
        $ch = curl_init(config('settings.baseUrl').$from);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $conversionResult = json_decode($json, true);
        if($conversionResult['result'] == 'error'){
            $rate = null;
        }else{
            $rate = $conversionResult['conversion_rates'][$to] * $amount;
        }

        return $rate;
    }
}
