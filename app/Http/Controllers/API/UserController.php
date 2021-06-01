<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();
        if($user->type === 'admin'){

            return User::latest()->paginate(8);
        }
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
            'password' => 'required|string|min:6'
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'contact' => $request['contact'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password']),
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name' =>  'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6'
        ]);
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        $user->update($request->all());
        return ['user' => $user, 'message' => "success"];
    }

    public function profile()
    {
        
        return auth('api')->user();
    }

    public function UpdateProfile(Request $request)
    {

        $user = auth('api')->user();
        $this->validate($request,[
            'name' =>  'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'contact' => 'sometimes|string',
            'password' => 'sometimes|string|min:6'
        ]);

        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto){

            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => 'Success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        // delete user

        $user->delete();

        return ['message' => 'user supprimer'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%")
                        ->orWhere('type','LIKE',"%$search%");
            })->paginate(5);
        }else {
            $users = User::latest()->paginate(5);
        }

        return $users;
    }

    public function count(){
        $users = DB::table('users')->count();
        $cars = DB::table('cars')->count();
        $operations = DB::table('operations')->count();
        $achats = DB::table('achats')->count();
        $photos = DB::table('photos')->count();
        $sumHT = DB::table('cars')->sum('ht');

        $venduCars = DB::table('cars')->where('statut', 'vendu')->count();
        $acquisCars = DB::table('cars')->where('statut', 'en stock')->count();
        $carsDeleted = DB::table('deletecars')->count();

        $chartjs = array($venduCars, $acquisCars, $carsDeleted);

        $invoices = intval($venduCars)*2 + (intval($acquisCars));

        $countMarque = DB::table('cars')
            ->select(DB::raw('marque,count(marque) as marque_count'))
            ->groupBy('marque')
            ->get();

        return [
            'users' => $users, 
            'cars' => $cars, 
            'operations' => $operations, 
            'achats' => $achats,
            'photos' => $photos,
            'sumht' => $sumHT,
            'invoices' => $invoices,
            'acquisCars' => $acquisCars,
            'countMarque' => $countMarque,
            'chartjs' => $chartjs
        ];
    }

}
