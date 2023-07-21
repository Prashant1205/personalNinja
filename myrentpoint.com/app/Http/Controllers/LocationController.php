<?php

namespace MyRentPoint\Http\Controllers;

use Illuminate\Http\Request;
use MyRentPoint\Models\Location;

class LocationController extends Controller
{
    function getLocation(Request $request){


        try {
            if(!isset($request['type']) || empty($request['type'])) {
                throw new exception("Type is not set.");
            }
            $type = $request['type'];
            if($type=='getCountries') {
                $data = Location::getCountries();

            }

            if($type=='getStates') {
                if(!isset($request['countryId']) || empty($request['countryId'])) {
                    throw new exception("Country Id is not set.");
                }
                $countryId = $request['countryId'];
                $data = Location::getStates($countryId);
            }

            if($type=='getCities') {
                if(!isset($request['stateId']) || empty($request['stateId'])) {
                    throw new exception("State Id is not set.");
                }
                $stateId = $request['stateId'];
                $data = Location::getCities($stateId);
            }

        } catch (Exception $e) {
            $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
        }

        finally {
            echo json_encode($data);
        }
    }
}
