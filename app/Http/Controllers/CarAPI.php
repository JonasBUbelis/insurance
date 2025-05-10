<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarAPI extends Controller
{
    public function index(){
        return Car::all();
    }

    public function show($id){
        return Car::find($id);
    }

    public function store(Request $request)
    {
        $car = new Car();
        $car->reg_number=$request->reg_number;
        $car->brand=$request->brand;
        $car->model=$request->model;
        $car->owner_id=$request->owner_id;
        $car->save();

        return $car;
    }

    public function update(Request $request,$id){
        $car=Car::find($id);
        $car->reg_number=$request->reg_number;
        $car->brand=$request->brand;
        $car->model=$request->model;
        $car->owner_id=$request->owner_id;
        $car->save();

        return $car;
    }

    public function destroy($id){
        Car::destroy($id);
        return $id;
    }
}
