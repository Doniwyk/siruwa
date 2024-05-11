<?php

namespace Tests\Feature;

use App\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ResidentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function canStoreResident(){
        $resident = UserModel::factory(1)->create();
        $request = Request::create(route('admin.data-dasawisma.store'), 'POST', );
        $response = $this->actingAs($resident)->post(route('admin.data-dasawisma.store'), $request->all());
        $this->assertDatabaseHas('users', [
            'id_penduduk' => $resident->id,
        ]);
    }
}
