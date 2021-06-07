<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RandomNumberModel extends Model {

    public function randomNumber($min = 5, $max = 15) {
        $length = rand($min, $max);
        $string = '';
        $index = '0123456789abcdefghijklmnopqrstuvwxyzOLIVineLiMiTeDABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++) {
            $string .= $index[rand(0, strlen($index) - 1)];
        }
        return $string;
    }
    
    /*
     * this function will generate 6 digits nubmer
     * this string will be send to users mobile number as verification code
     * @return string
     */

    public function mobileVerification($min = 6, $max = 6) {
        $length = rand($min, $max);
        $string = '';
        $index = '0123456789';
        for ($i = 0; $i < $length; $i++) {
            $string .= $index[rand(0, strlen($index) - 1)];
        }
        return $string;
    }
}
