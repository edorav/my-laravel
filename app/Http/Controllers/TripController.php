<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\TripDay;
use App\Models\TripUser;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        return view('trip.create');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'label' => 'required|string|max:255',
        ]);
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
        $input = $request->all();

        $trip = Trip::create([
            'label' => $request['label'],
        ]);

        return redirect()->route('detail-trip', ['id'=>$trip->id]);

        /*foreach($request->cities as $tripDay){

            $city = City::firstOrCreate([
                    'name' => $tripDay['name']
                ],
                [
                    'name' => $tripDay['name'],
                    'country' => 'France',
                    'latitude'=> 52.520007,
                    'longitude'=> 13.404954
                ]
            );

            TripDay::create([
                'city_id' => $city->id,
                'trip_id' => $trip->id,
                'from'=>$tripDay['from'],
                'to'=>$tripDay['to']
            ]);

        }

        foreach($request->friends as $people){

            TripUser::create([
                'user_id' => $people['id'],
                'trip_id' => $trip->id,
            ]);
        }

        TripUser::create([
            'user_id' => Auth::user()->id,
            'trip_id' => $trip->id,
        ]);
 
        return $trip;*/
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
        $trip = Trip::find($id);
        
        return view('trip.show', compact('trip'));
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
}
