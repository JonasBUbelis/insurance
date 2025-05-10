<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Owners;

class CarController extends Controller {
    public function index(){
        $cars = Car::all();
        return view('cars.index', ['cars' => $cars]);
    }

    public function create() {
        $owners = Owners::all();
        return view('cars.create', compact('owners'));
    }

    public function store(Request $request) {
        $request->validate([
            'reg_number' => 'required|string|size:6|unique:cars,reg_number,',
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required|exists:owners,id'],
            ['reg_number.size'=>  __('Registration number has to be 6 symbols long'),
             'reg_number.unique'=> __('Registration number already Exists'),
             'reg_number.required'=> __('Registration number is required'),
             'brand.required'=> __('Brand is required'),
             'model.required'=> __('Model is required'),
             'owner_id'=> __('Owner ID is required')
         ]);

        Car::create($request->all());
        return redirect()->route('cars.index');
    }

    public function edit(Car $car) {
        $owners = Owners::all();
        return view('cars.edit', compact('car', 'owners'));
    }

    public function update(Request $request, Car $car) {
        $request->validate([
            'reg_number' => 'required|string|size:6|unique:cars,reg_number,' . $car->id,
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required|exists:owners,id'],
            ['reg_number.size'=>  __('Registration number has to be 6 symbols long'),
            'reg_number.unique'=> __('Registration number already Exists'),
            'reg_number.required'=> __('Registration number is required'),
            'brand.required'=> __('Brand is required'),
            'model.required'=> __('Model is required'),
            'owner_id'=> __('Owner ID is required')]);

        $car->update($request->all());
        return redirect()->route('cars.index');
    }
    public function destroy(Car $car) {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
