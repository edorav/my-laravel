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
        return view('trip.index');
        
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCities(Request $request)
    {
        $tripId = $request->tripId;

        foreach ($request->cities as $tripDay) {
            $city = City::firstOrCreate(
                [
                    'name' => $tripDay['name']
                ],
                [
                    'name' => $tripDay['name'],
                    'country' => 'France',
                    'latitude'=> $tripDay['latitude'],
                    'longitude'=> $tripDay['longitude']
                ]
            );

            TripDay::create([
                'city_id' => $city->id,
                'trip_id' => $tripId,
                'from'=> $tripDay['from'],
                'to'=> $tripDay['to']
            ]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUsers(Request $request)
    {
        $tripId = $request->tripId;

        foreach ($request->friends as $people) {
            TripUser::create(
                [
                    'user_id' => $people['id'],
                    'trip_id' => $tripId,
                ]
            );
        }

        // Anche Logged User come partecipante
        TripUser::create([
            'user_id' => Auth::user()->id,
            'trip_id' => $tripId,
        ]);
 
        return $tripId;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tripList(Request $request)
    {
        $loggedUser = Auth::guard('api')->user();
        $myFriendsRelationships = $loggedUser->getAllFriendships();

        //return response()->json($myFriendsRelationships);
        //$trips = Trip::with('users')->get()->paginate(20, ['*'], 'page', $request->pagenumber);
        $trips = Trip::with('users')->orderBy('created_at', 'DESC');
        $pagination = $trips->paginate(20, ['*'], 'page', $request->pagenumber);
       // $results = Trip::orderBy('created_at')->get();
       // $trips = Trip::with('users')->get();
        //$paginator = new Illuminate\Pagination\Paginator($trips, 20);
        if (request()->wantsJson()) {
            return response()->json($pagination);
        } else {
            return view('trip.index', compact('trips'));
        }
    }
}
