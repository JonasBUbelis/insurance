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
        $user = Auth::user();

        if(!$user) {$owners = collect();}
        else if($user->type === 'admin' || $user->type === 'read_only') {$owners = Owners::all();}
        else if($user->type === 'regular'){$owners = Owners::where('user_id', $user->id)->get();}
        else{$owners = collect();}

        return view('owners.index', compact('owners'));
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
            'address' => 'required'],
            ['name.required'=>  __('Name is required'),
            'surname.required'=> __('Surname is required'),
            'phone.required'=> __('Phone is required'),
            'email.required'=> __('Email is required'),
            'address.required'=> __('Address is required')
        ]);
        $data['user_id'] = Auth::id();

        Owners::create($data);

        return redirect()->route('owners.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owners $owner, Request $request){
        if (! $request->user()->can('EditOwners', $owner) ){
            return redirect()->route('owners.index');
        }
        if (! $request->user()->can('EditOwners', $owner) ){
        return redirect()->route('owners.index');
    }
        return view('owners.edit', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owners $owner)
    {
        if (! $request->user()->can('EditOwners', $owner) ){
            return redirect()->route('owners.index');
        }
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|integer',
            'email' => 'required',
            'address' => 'required'],
            ['name.required'=>  __('Name is required'),
             'surname.required'=> __('Surname is required'),
             'phone.required'=> __('Phone is required'),
             'email.required'=> __('Email is required'),
             'address.required'=> __('Model is required')
        ]);

        $owner->update($data);

        return redirect()->route('owners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owners $owner, Request $request){
        if (! $request->user()->can('DeleteOwners', $owner) ){
            return redirect()->route('owners.index');
        }
        $owner->delete();

        return redirect()->route('owners.index');
    }
}
