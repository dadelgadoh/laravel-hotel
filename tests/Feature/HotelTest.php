<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Database\Eloquent\Factories\Factory; 
use Tests\TestCase;

class HotelTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    // use  WithFaker;

    public function testIndexOfHotels()
    {
        $numInsertions = 5;
        for ($i = 0; $i < $numInsertions; $i++) {
            $hotel = $this->createTestHotel();
            $data = [
                'name' => $hotel->name,
                'address' => $hotel->address,
                'city' => $hotel->city,
                'nit' => $hotel->nit,
                'no_rooms' => $hotel->no_rooms,
            ];
            $this->storeHotel($data);
        }

        $response = $this->get('/api/v1/hotels');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [ // '*' significa cualquier índice en este contexto
                    'id',
                    'name',
                    'address',
                    'city',
                    'nit',
                    'no_rooms',
                    'url'
                ],
            ],
        ]);

        $data = json_decode($response->getContent(), true)['data'];
        $this->assertCount($numInsertions, $data);
    }

    public function testShowSpecificHotel()
    {
        $numInsertions = 5;

        for ($i = 0; $i < $numInsertions; $i++) {
            $hotel = $this->createTestHotel();
            $data = [
                'name' => $hotel->name,
                'address' => $hotel->address,
                'city' => $hotel->city,
                'nit' => $hotel->nit,
                'no_rooms' => $hotel->no_rooms,
            ];
            $this->storeHotel($data);

            $response = $this->get('/api/v1/hotels/' . $hotel->id);
            // $response = $this->get('/api/v1/hotels/' . $i + 1);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);
            // $response->assertJson(['data' => $hotel->toArray()]);
        }
    }

    public function testStoreNewHotel()
    {
        $numInsertions = 5;

        for ($i = 0; $i < $numInsertions; $i++) {
            $data = [
                'name' => $this->faker->company,
                'address' => $this->faker->address,
                'city' => $this->faker->city,
                'nit' => $this->faker->regexify('[0-9]{9}-[0-9]{1}'),
                'no_rooms' => $this->faker->numberBetween(10, 100),
            ];

            $response = $this->storeHotel($data);

            $response->assertStatus(200);
            $this->assertDatabaseHas('hotels', $data); // Verificar que se haya creado en la base de datos
        }
    }

    public function testUpdateExistingHotel()
    {
        $numUpdates = 5;

        for ($i = 0; $i < $numUpdates; $i++) {
            $hotel = $this->createTestHotel();
            $data = [
                'name' => $hotel->name,
                'address' => $hotel->address,
                'city' => $hotel->city,
                'nit' => $hotel->nit,
                'no_rooms' => $hotel->no_rooms,
            ];

            $response = $this->updateHotel($hotel->id, $data);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);

            $this->assertDatabaseHas('hotels', [
                'id' => $hotel->id,
                'name' => $data['name'],
                'address' => $data['address'],
                'city' => $data['city'],
                'nit' => $data['nit'],
                'no_rooms' => $data['no_rooms'],
            ]);
        }
    }

    public function testDeleteAnHotel()
    {
        $numInsertions = 5;

        for ($i = 0; $i < $numInsertions; $i++) {
            $hotel = $this->createTestHotel();
            $data = [
                'name' => $hotel->name,
                'address' => $hotel->address,
                'city' => $hotel->city,
                'nit' => $hotel->nit,
                'no_rooms' => $hotel->no_rooms,
            ];
            $this->storeHotel($data);

            $response = $this->delete('/api/v1/hotels/' . $hotel->id);

            $this->assertTrue($response->status() === 200 || $response->status() === 404);
            $this->assertDatabaseMissing('hotels', ['id' => $hotel->id]); 
        }
    }

    // public function testResourseRandom(){
    //     $numInsertions = 5;

    //     for ($i = 0; $i < $numInsertions; $i++) {
    //         $hotel = $this->createTestHotel();
    //         $data = [
    //             'name' => $hotel->name,
    //             'address' => $hotel->address,
    //             'city' => $hotel->city,
    //             'nit' => $hotel->nit,
    //             'no_rooms' => $hotel->no_rooms,
    //         ];
    //         $this->storeHotel($data);

    //         $random_string = $this->faker->randomAscii;
    //         $response = $this->get('/api/v1/hotels/' . $random_string);

    //         $this->assertTrue($response->status() === 200 || $response->status() === 404);
    //     }

    // }

    // public function testCreatingResourceRandomlyValues() {
    //     $numInsertions = 5;

    //     for ($i = 0; $i < $numInsertions; $i++) {
    //         $data = [
    //             'name' => $this->faker->randomAscii,
    //             'address' => $this->faker->randomAscii,
    //             'city' => $this->faker->randomAscii,
    //             'nit' => $this->faker->randomAscii,
    //             'no_rooms' => $this->faker->randomAscii,
    //         ];

    //         $response = $this->storeHotel($data);
    //         $this->assertTrue($response->status() === 200 || $response->status() === 302);
    //         // $response->assertStatus(200);
    //         $this->assertDatabaseHas('hotels', $data); // Verificar que se haya creado en la base de datos
    //     }
    // }

    
    private function createTestHotel()
    {
        return Hotel::create([
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'nit' => $this->faker->regexify('[0-9]{9}-[0-9]{1}'),
            'no_rooms' => $this->faker->numberBetween(10, 100),
        ]);
    }
    private function updateHotel($id, $data)
    {
        return $this->put('/api/v1/hotels/' . $id, $data);
    }
    private function storeHotel($data)
    {
        return $this->post('/api/v1/hotels', $data);
    }
}
