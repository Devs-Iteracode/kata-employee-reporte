<?php

namespace Tests\Feature;

use App\Models\Employe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployesMajeursTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_exists(): void
    {
        $response = $this->get('/employes-majeurs');

        $response->assertStatus(200);
    }

    public function test_index_display_a_list(): void
    {
        $response = $this->get('/employes-majeurs');

        $response->assertSee('Liste des employés');
    }

    public function test_index_list_show_two_employes(): void
    {
        Employe::factory()->create([
            'nom' => 'Agent Smith',
            'age' => 42,
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'age' => 16,
        ]);
        $response = $this->get('/employes-majeurs');
        $response->assertSee(['Agent Smith', 'Age : 42']);
        $response->assertSee(['Neo', 'Age : 16']);
    }
}
