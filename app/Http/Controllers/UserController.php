<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\TripDay;
use Illuminate\Support\Facades\DB;
use Storage;

class UserController extends Controller
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
    public function show()
    {
        return view('auth.myprofile');
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
    public function update(Request $request)
    {
        $loggedUser = Auth::user();

        if ($request->file('picture')) {
            $file = $request->file('picture');
            $folderId = uniqid();
            $directory = 'app/public/'. $folderId . DIRECTORY_SEPARATOR;
 
            mkdir(storage_path($directory));

            $path = storage_path($directory . 'default.jpg');
            $imgResized = Image::make($file)->save($path);
    
            $loggedUser->picture = $folderId;
        }
    
        $loggedUser->firstname = $request->firstname;
        $loggedUser->lastname = $request->lastname;

        //$loggedUser->cellnumber = $request->cellnumber;
        //$loggedUser->locale = $request->locale;
        //$loggedUser->currencycode = $request->currencycode;
        $loggedUser->save();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'ok'
            ]);
        } else {
            return back();
        }
        
    }


    /**
    *
    *   Ritorna tutti i viaggi dell'utente Loggato con la suddivisione in giorni
    *
    */
    public function showMyTrip()
    {
        $tripdays = DB::table('trip_day')
                        ->join('trips', 'trips.id', '=', 'trip_day.trip_id')
                        ->join('trip_user', 'trips.id', '=', 'trip_user.trip_id')
                        ->join('users', 'trip_user.user_id', '=', 'users.id' )
                        ->join('cities', 'cities.id', '=', 'trip_day.city_id')
                        ->select('trips.*','trip_day.*','cities.*')
                        ->where('users.id','=',Auth::user()->id)
                        ->get();
                        
        return view('auth.mytriplist', compact('tripdays'));
    }
}
