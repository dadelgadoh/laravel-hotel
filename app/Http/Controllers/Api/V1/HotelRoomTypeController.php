<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRoomTypeRequest;
use App\Http\Resources\V1\HotelRoomTypeCollection;
use App\Http\Resources\V1\HotelRoomTypeResource;
use App\Models\HotelRoomType;
use Illuminate\Http\Request;

class HotelRoomTypeController extends Controller
{
    public function index()
    {
        // return response()->json("Hotel Room quantity Index");
        return new HotelRoomTypeCollection(HotelRoomType::all());
    }

    
    public function show(HotelRoomType $hotel_room_type)
    {
        return new HotelRoomTypeResource($hotel_room_type);
    }
    public function store(StoreHotelRoomTypeRequest $request)
    {
        HotelRoomType::create($request->validated());
        return response()->json("Hotel room quantity Created");
    }

    public function update(StoreHotelRoomTypeRequest $request, HotelRoomType $hotel_room_type)
    {
        $hotel_room_type->update($request->validated());
        return response()->json("Hotel Updated");
    }

    public function destroy(HotelRoomType $hotel_room_type)
    {
        $hotel_room_type->delete();
        return response()->json("Hotel room quantity Deleted");
    }
}
