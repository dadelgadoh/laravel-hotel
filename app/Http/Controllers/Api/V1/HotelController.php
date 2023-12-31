<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Resources\V1\HotelCollection;
use App\Http\Resources\V1\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return new HotelCollection(Hotel::all());
    }

    public function show(Hotel $hotel)
    {
        return new HotelResource($hotel);
    }

    public function store(StoreHotelRequest $request)
    {
        Hotel::create($request->validated());
        return response()->json("Hotel Created");
    }

    public function update(StoreHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return response()->json("Hotel Updated");
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json("Hotel Deleted");
    }
}
