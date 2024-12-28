<?php

namespace Tests\Feature\Livewire;

use App\Livewire\General\Personal;
use Livewire\Livewire;
use Tests\TestCase;

class PersonalTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Personal::class)
            ->assertStatus(200);
    }
}
