<?php

namespace MyRentPoint\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public static $data;

    function __construct() {
        parent::__construct();
    }

    // Fetch all countries list
    public static function getCountries() {
        try {
            $result = Country::where('isactive',1)->get();

            if(!$result) {
                throw new exception("Country not found.");
            }

            $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Countries fetched successfully.", 'result'=>$result);
        } catch (Exception $e) {
            $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
        } finally {
            return $data;
        }
    }

    // Fetch all states list by country id
    public static function getStates($countryId) {
        try {

            $result = State::where('country_id',$countryId)->where('isactive',1)->get();
            if(!$result) {
                throw new exception("State not found.");
            }

            $data = array('status'=>'success', 'tp'=>1, 'msg'=>"States fetched successfully.", 'result'=>$result);
        } catch (Exception $e) {
            $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
        } finally {
            return $data;
        }
    }

    // Fetch all cities list by state id
    public static function getCities($stateId) {
        try {

            $result = City::where('state_id',$stateId)->where('isactive',1)->get();
            if(!$result) {
                throw new exception("City not found.");
            }

            $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Cities fetched successfully.", 'result'=>$result);
        } catch (Exception $e) {
            $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
        } finally {
            return $data;
        }
    }

}
