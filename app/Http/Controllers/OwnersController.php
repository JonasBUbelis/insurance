<?php

namespace App\Http\Controllers;

use App\Models\Owners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owners::where('user_id', Auth::id())->get(); // Get only the logged-in user's owners

        return view('owners.index', ['owners' => $owners]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|integer',
            'email' => 'required',
            'address' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        Owners::create($data);

        return redirect()->route('owners');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owners $owner)
    {
        return view('owners.edit', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owners $owner)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|integer',
            'email' => 'required',
            'address' => 'required'
        ]);

        $owner->update($data);

        return redirect()->route('owners');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owners $owner)
    {
        $owner->delete();

        return redirect()->route('owners');
    }
}
