<?php

namespace MyRentPoint\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use MyRentPoint\Models\City;
use MyRentPoint\Models\Country;
use MyRentPoint\Models\RentalRequest;
use MyRentPoint\Models\State;

class RentalRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Function for send Contact Forms details  @ Contact@mytyrepoint.com
     */

    public function postEnquiry(Request $request){
        try {
            $input = $request->all();
            $v = Validator::make($input, RentalRequest::$rentalRules);
            if ($v->passes()) {

                $enquiry = new RentalRequest();
                $enquiry->name = $request->input('name');
                $enquiry->email = $request->input('email');
                $enquiry->phone = $request->input('phone');
                $enquiry->city = $request->input('city');
                $enquiry->state = $request->input('state');
                $enquiry->country = $request->input('country');
                $enquiry->location = $request->input('location');
                $enquiry->product_on_rent = $request->input('product');
                $enquiry->duration = $request->input('duration');
                $enquiry->save();

                if ($enquiry->save()){
                    
                    $city = City::find($request->input('city'));
                    $state = State::find($request->input('state'));
                    $country = Country::find($request->input('country'));

                    $data['name'] = $request->input('name');
                    $data['email'] = $request->input('email');
                    $data['city'] = $city->name;
                    $data['state'] = $state->name;
                    $data['country'] = $country->name;
                    $data['location'] = $request->input('location');
                    $data['product'] = $request->input('product');
                    $data['duration'] = $request->input('duration');
                    $data['phone'] = $request->input('phone');

                    $subject = Config::get('vocabulary.app.company_name').' - '.Lang::get('mails.enquiries.title');

                    $toMyRentPoint= Config::get('vocabulary.app.to_email');
                    $toNameMyRentPoint = Config::get('vocabulary.app.company_name');
                    $frommail = Config::get('vocabulary.app.from_email');
                    $fromname = Config::get('vocabulary.app.company_name');

                    Mail::send('site.emails.adminenquiry', $data, function($message) use ($toMyRentPoint, $toNameMyRentPoint, $subject,$frommail,$fromname){
                        $message->to($toMyRentPoint, $toMyRentPoint);
                        $message->subject($subject);
                        $message->from($frommail,$fromname);
                    });

                    $toName = $request->input('name');
                    $toEmail = $request->input('email');

                    Mail::send('site.emails.userenquiry', $data, function($message) use ($toEmail, $toName, $subject,$frommail,$fromname){
                        $message->to($toEmail, $toName);
                        $message->subject($subject);
                        $message->from($frommail,$fromname);
                    });

                    return redirect('/')
                        ->with('message', Lang::get('enquiries.usermessage.success'));
                }else{
                    return redirect()
                        ->back()
                        ->with('error', Lang::get('enquiries.usermessage.error'))
                        ->withInput();
                }

            }else {
                return redirect()
                    ->back()
                    ->withErrors($v)
                    ->withInput();
            }
        }
        catch(\Exception $ex)
        {
            return redirect('/')
                ->with('error',Lang::get('enquiries.usermessage.failure'));
        }
    }
}
