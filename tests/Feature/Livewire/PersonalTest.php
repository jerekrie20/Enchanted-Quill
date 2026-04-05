<?php

namespace Tests\Feature\Livewire;

use App\Livewire\General\Settings\PersonalSettings;
use Livewire\Livewire;
use Tests\TestCase;

class PersonalTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(PersonalSettings::class)
            ->assertStatus(200);
    }
}
