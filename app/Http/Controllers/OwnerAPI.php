<?php

namespace App\Http\Controllers;

use App\Models\Owners;
use Illuminate\Http\Request;

class OwnerAPI extends Controller
{
    public function index(){
        return Owners::all();
    }

    public function show($id){
        return Owners::find($id);
    }

    public function store(Request $request)
    {
        $owner = new Owners();
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->email=$request->email;
        $owner->phone=$request->phone;
        $owner->address=$request->address;
        $owner->save();

        return $owner;
    }

    public function update(Request $request,$id){
        $owner=Owners::find($id);
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->email=$request->email;
        $owner->phone=$request->phone;
        $owner->address=$request->address;
        $owner->save();

        return $owner;
    }

    public function destroy($id){
        Owners::destroy($id);
        return $id;
    }
}
