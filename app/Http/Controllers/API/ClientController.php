<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Car;
use Carbon\Carbon;

class ClientController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>  'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'contact' => 'required|string'
        ]);

        $user_id = \DB::table('users')-> insertGetId(array(
            'name' => $request['name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'bio' => $request['bio'],
        ));

        Achat::create([
            'user_id' => $user_id,
            'car_id' => $request['car_id'],
            'created_at' => Carbon::now()->timestamp,
        ]);

        $car = Car::find($request['car_id']);
        $car->statut = "vendu";
        $car->save();

        return ["user_id" => $user_id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
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
