<?php

namespace MyRentPoint\Models;

use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    public static $rentalRules = array(
        'name'=>'required|alpha_spaces',
        'email'=>'required|email',
        'phone'=>'required|mobile',
        'duration'=>'required',
        "product"=>"required",
        "city"=>"required",
        "location"=>"required",
        "country"=>"required",
        "state"=>"required",
    );
}
