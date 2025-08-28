<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Hotel;

class SessionCacheController extends Controller
{
    public function storePreferences(Request $request)
    {
        session([
            'username' => $request->input('username', 'Guest'),
            'language' => $request->input('language', 'en'),
        ]);

        return response()->json([
            'message' => 'Preferences saved in session!',
            'session' => session()->all()
        ]);
    }

    public function getPreferences()
    {
        return response()->json([
            'username' => session('username', 'Guest'),
            'language' => session('language', 'en'),
        ]);
    }

    public function getHotels()
    {
        $hotels = Cache::remember('hotels_list', 60, function () {
            return Hotel::all();
        });

        return response()->json($hotels);
    }

    public function addHotel(Request $request)
    {
        $hotel = Hotel::create($request->all());
        Cache::forget('hotels_list');

        return response()->json([
            'message' => 'Hotel added successfully!',
            'hotel' => $hotel
        ]);
    }

    public function updateHotel(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        Cache::forget('hotels_list');

        return response()->json([
            'message' => 'Hotel updated successfully!',
            'hotel' => $hotel
        ]);
    }

    public function deleteHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        Cache::forget('hotels_list');

        return response()->json([
            'message' => 'Hotel deleted successfully!'
        ]);
    }
}
