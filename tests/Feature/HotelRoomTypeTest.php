<?php

namespace Tests\Feature;

use App\Models\HotelRoomType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\RefreshDatabaseExceptTable;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelRoomTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    // use RefreshDatabaseExceptTable, WithFaker;

    use  WithFaker;

    public function testIndexOfHotelRooms()
    {
        $numInsertions = 5;
        for ($i = 0; $i < $numInsertions; $i++) {
            $this->createTestHotelRooms();
        }

        $response = $this->get('/api/v1/hotel-rooms');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [ // '*' significa cualquier índice en este contexto
                    'id',
                    'hotel_id',
                    'room_type_id',
                    'accommodation_id',
                    'quantity'
                ],
            ],
        ]);

        $data = json_decode($response->getContent(), true)['data'];
    }

    public function testShowSpecificHotel()
    {
        $numInsertions = 1;

        for ($i = 0; $i < $numInsertions; $i++) {
            $data = $this->createTestHotelRooms();

            $response = $this->get('/api/v1/hotel-rooms/' . $i + 1);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);

        }
    }

    public function testStoreNewHotelRoom()
    {
        $numInsertions = 5;

        for ($i = 0; $i < $numInsertions; $i++) {
            $data = $this->createRandomHotelRoomType();

            $response = $this->storeHotelRoom($data);

            $this->assertTrue($response->status() === 200 || $response->status() === 302);
        }
    }

    public function testUpdateAnyHotelRoom()
    {
        $numUpdates = 5;

        for ($i = 0; $i < $numUpdates; $i++) {
            $data = $this->createTestHotelRooms();
            $idTest = $this->faker->numberBetween(1, 100);
            $response = $this->updateHotelRoom($idTest, $data);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);
        }
    }

    public function testDeleteAnyHotelRoom()
    {
        $numInsertions = 5;

        for ($i = 0; $i < $numInsertions; $i++) {
            $data = $this->createTestHotelRooms();
            $idTest = $this->faker->numberBetween(1, 100);

            $response = $this->delete('/api/v1/hotel-rooms/' . $idTest);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);
            // $this->assertDatabaseMissing('hotel_rooms', ['id' => $idTest]);
        }
    }

    // // public function testResourseRandom(){
    // //     $numInsertions = 5;

    // //     for ($i = 0; $i < $numInsertions; $i++) {
    // //         $hotel = $this->createTestHotel();
    // //         $data = [
    // //             'name' => $hotel->name,
    // //             'address' => $hotel->address,
    // //             'city' => $hotel->city,
    // //             'nit' => $hotel->nit,
    // //             'no_rooms' => $hotel->no_rooms,
    // //         ];
    // //         $this->storeHotel($data);

    // //         $random_string = $this->faker->randomAscii;
    // //         $response = $this->get('/api/v1/hotels/' . $random_string);

    // //         $this->assertTrue($response->status() === 200 || $response->status() === 404);
    // //     }

    // // }

    // // public function testCreatingResourceRandomlyValues() {
    // //     $numInsertions = 5;

    // //     for ($i = 0; $i < $numInsertions; $i++) {
    // //         $data = [
    // //             'name' => $this->faker->randomAscii,
    // //             'address' => $this->faker->randomAscii,
    // //             'city' => $this->faker->randomAscii,
    // //             'nit' => $this->faker->randomAscii,
    // //             'no_rooms' => $this->faker->randomAscii,
    // //         ];

    // //         $response = $this->storeHotel($data);
    // //         $this->assertTrue($response->status() === 200 || $response->status() === 302);
    // //         // $response->assertStatus(200);
    // //         $this->assertDatabaseHas('hotels', $data); // Verificar que se haya creado en la base de datos
    // //     }
    // // }

    private function createHotelsForTestRooms() {
        $numHotelsCreated = 5;
        for ($i = 0; $i < $numHotelsCreated; $i++) {
            $data = [
                'name' => $this->faker->company,
                'address' => $this->faker->address,
                'city' => $this->faker->city,
                'nit' => $this->faker->regexify('[0-9]{9}-[0-9]{1}'),
                'no_rooms' => $this->faker->numberBetween(10, 100),
            ];

            $response = $this->post('/api/v1/hotels', $data);
        }
        return $numHotelsCreated;
    }
    private function createRandomHotelRoomType()
    {
        $data = [
            'hotel_id' => $this->faker->numberBetween(1, 100),
            'room_type_id' => $this->faker->numberBetween(1, 100),
            'accommodation_id' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 100)
        ];
        return $data;
    }
    private function createTestHotelRooms()
    {
        $data = $this->createRandomHotelRoomType();

        $this->storeHotelRoom($data);
        return $data;
    }
    private function updateHotelRoom($id, $data)
    {
        return $this->put('/api/v1/hotel-rooms/' . $id, $data);
    }
    private function storeHotelRoom($data)
    {
        return $this->post('/api/v1/hotel-rooms', $data);
    }
}
