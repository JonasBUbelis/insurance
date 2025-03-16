<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Owners;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller {
    public function index()
    {
        $cars = Car::with('owner')
            ->whereHas('owner', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

        return view('cars.index', compact('cars'));
    }

    public function create() {
        // Get only the owners that belong to the logged-in user
        $owners = Owners::where('user_id', Auth::id())->get();

        return view('cars.create', compact('owners'));
    }

    // Store a new car
    public function store(Request $request) {
        $request->validate([
            'reg_number' => 'required|unique:cars',
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required|exists:owners,id'
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index');
    }

    // Show form to edit a car
    public function edit(Car $car) {
        $owners = Owners::all();
        return view('cars.edit', compact('car', 'owners'));
    }

    // Update a car
    public function update(Request $request, Car $car) {
        $request->validate([
            'reg_number' => 'required|unique:cars,reg_number,' . $car->id,
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required|exists:owners,id'
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index');
    }
    public function destroy(Car $car) {
        $car->delete();
        return redirect()->route('cars.index');
}}
