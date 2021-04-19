<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Photo;
use App\Models\Operation;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarResource::collection(Car::with('photos', 'operations')->paginate(5));
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
            'numserie' =>  'required|string|',
            'marque' => 'required|string|',
            'type' => 'required|string|',
            'annee' => 'required|integer|min:1900|max:2022',
            'dedouaner' => 'required',
            'prixDedouanement' => 'required|numeric',
            'ht' => 'required|numeric',
            'tva' => 'required|integer',
        ]);

        \DB::table('cars')->insertGetId(array(
            'numserie' => $request['numserie'],
            'user_id' => $request['user_id'],
            'marque' => $request['marque'],
            'type' => $request['type'],
            'annee' => $request['annee'],
            'description' => $request['description'],
            'statut' => $request['statut'],
            'dedouaner' => $request['dedouaner'],
            'prixDedouanement' => $request['prixDedouanement'],
            'ht' => $request['ht'],
            'tva' => $request['tva'],
        ));

        
        $images = $request->images;
        if($images){
            \File::makeDirectory(public_path('img/cars/').$car_id);
            for($i=0;$i < count($images);$i++){
                $name = time().$i.'.' . explode('/', explode(':', substr($images[$i]['path'], 0, strpos($images[$i]['path'], ';')))[1])[1];
                \Image::make($images[$i]['path'])->save(public_path('img/cars/').$car_id.'/'.$name);
                Photo::create([
                    'car_id' => $car_id,
                    'photo' => $name
                ]);
            }
        }
        return ['car_id' => $car_id, 'user_id' => $request['user_id']];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CarResource::collection(Car::with('photos', 'operations')->paginate(5))->where('user_id', $id);
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
        $car = Car::findOrFail($id);
        $car->delete();

        \File::deleteDirectory(public_path('img/cars/').$id);

        $photos = Photo::where('car_id', $id)->delete();

        $ops = Operation::where('car_id', $id)->delete();
    }

    public function getCar($id){
        return CarResource::collection(Car::with('operations')->paginate(10))->where('id', $id);
    }
}
