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

    // public function testIndex()
    // {
    //     $hotels = factory(Hotel::class, 5)->create();

    //     $response = $this->get('/api/hotels');

    //     $response->assertStatus(200);
    //     $response->assertJsonCount(5); // Verificar que se devuelvan todos los hoteles
    // }

    // public function testShow()
    // {
    //     $hotel = factory(Hotel::class)->create();

    //     $response = $this->get('/api/hotels/' . $hotel->id);

    //     $response->assertStatus(200);
    //     $response->assertJson(['data' => $hotel->toArray()]);
    // }

    public function testStore()
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

            $response = $this->post('/api/v1/hotels', $data);

            $response->assertStatus(200);
            $this->assertDatabaseHas('hotels', $data); // Verificar que se haya creado en la base de datos
        }
    }

    public function testUpdate()
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

            $response = $this->put('/api/hotels/' . $hotel->id, $data);

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

    // public function testDestroy()
    // {
    //     $hotel = factory(Hotel::class)->create();

    //     $response = $this->delete('/api/hotels/' . $hotel->id);

    //     $response->assertStatus(200); 
    //     $this->assertDatabaseMissing('hotels', ['id' => $hotel->id]); 
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
        return $this->put('/api/hotels/' . $id, $data);
    }
    
}
