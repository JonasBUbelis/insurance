<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Owners;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller {
    public function index()
    {
        $user = Auth::user();

        if(!$user) {$owners = collect();$cars = collect();}
        else if ($user->type === 'admin' || $user->type === 'read_only') {$owners = Owners::all(); $cars = Car::all();}
        else if ($user->type === 'regular'){$owners = Owners::where('user_id', $user->id)->get();
        $cars = Car::whereIn('owner_id', $owners->pluck('id'))->get();}

        return view('cars.index', ['cars' => $cars]);
    }

    public function create() {
        $user = Auth::user();

        if(!$user) {$owners = collect();}
        else if ($user->type === 'admin' || $user->type === 'read_only') {$owners = Owners::all();}
        else if ($user->type === 'regular') {$owners = Owners::where('user_id', $user->id)->get();}

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

    public function edit(Car $car, Request $request) {
        if (! $request->user()->can('EditCars', $car) ){
            return redirect()->route('cars.index');
        }
        $user = Auth::user();

        if(!$user) {$owners = collect();}
        else if ($user->type === 'admin' || $user->type === 'read_only') {$owners = Owners::all();}
        else if ($user->type === 'regular') {$owners = Owners::where('user_id', $user->id)->get();}

        return view('cars.edit', compact('car', 'owners'));
    }

    public function update(Request $request, Car $car) {
        if (! $request->user()->can('EditCars', $car) ){
            return redirect()->route('cars.index');
        }
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
    public function destroy(Car $car, Request $request) {
        if (! $request->user()->can('DeleteCars', $car) ){
            return redirect()->route('cars.index');
        }
        $car->delete();
        return redirect()->route('cars.index');
    }
}
