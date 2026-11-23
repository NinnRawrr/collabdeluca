<?php

namespace Tests\Feature;

use App\Models\TipeKamar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KamarIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_available_room_types_in_the_create_form(): void
    {
        TipeKamar::create([
            'nama_tipe' => 'Deluxe',
            'harga_per_malam' => 500000,
        ]);

        $response = $this->get(route('kamar.index'));

        $response->assertOk()
            ->assertSee('Deluxe');
    }
}
