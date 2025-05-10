<?php

namespace App\Http\Controllers;

use App\Models\CarPhoto;
use Illuminate\Http\Request;
class CarPhotoController extends Controller
{
    public function store(Request $request, $carId){
        $request->validate(['photo' => 'required|image',],
        ['photo.required'=>  __('Photo is required')],
        ['photo.image'=>  __('Photo has to be an image')]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('car_photos', 'public');
            CarPhoto::create([
                'car_id' => $carId,
                'photo' => basename($path)]);
        }
        return redirect()->back();
    }

    public function delete($photoId){
        $carPhoto = CarPhoto::find($photoId);
        if ($carPhoto) {
            $photoPath = storage_path('app/public/car_photos/' . $carPhoto->photo);
            if (file_exists($photoPath)) {unlink($photoPath);}
            $carPhoto->delete();
        }
        return redirect()->back();
    }
}
