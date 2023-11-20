<?php

namespace Tests\Feature;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Collection;
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

    public function test_index_list_show_employes_at_least_18(): void
    {
        Employe::factory()->create([
            'nom' => 'Agent Smith',
            'age' => 42,
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'age' => 16,
        ]);
        Employe::factory()->create([
            'nom' => 'Trinity',
            'age' => 18,
        ]);
        $response = $this->get('/employes-majeurs');
        $response->assertSee(['AGENT SMITH', 'Age : 42']);
        $response->assertDontSee(['NEO', 'Age : 16']);
        $response->assertSee(['TRINITY', 'Age : 18']);
    }

    public function test_index_list_is_ordered(): void
    {
        Employe::factory()->create([
            'nom' => 'Trinity',
            'age' => 18,
        ]);
        Employe::factory()->create([
            'nom' => 'Smith',
            'age' => 42,
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'age' => 26,
        ]);

        $response = $this->get('/employes-majeurs');
        $response->assertSeeTextInOrder([
            "NEO",
            "SMITH",
            "TRINITY",
        ]);
    }

    public function test_index_list_variable_is_ordered(): void
    {
        Employe::factory()->create([
            'nom' => 'Trinity',
            'age' => 18,
        ]);
        Employe::factory()->create([
            'nom' => 'Smith',
            'age' => 42,
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'age' => 26,
        ]);

        $response = $this->get('/employes-majeurs');
        $this->assertEquals(
            ['Neo', 'Smith', 'Trinity'],
            $response->viewData('employes')->pluck('nom')->toArray(),
        );
    }

    public function test_get_employes_majeurs_par_ordre_alphabetique(): void
    {
        Employe::factory()->create([
            'nom' => 'Trinity',
            'age' => 18,
        ]);
        Employe::factory()->create([
            'nom' => 'Smith',
            'age' => 42,
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'age' => 26,
        ]);

        $employes = Employe::getEmployesMajeursParOrdreAlphabetique();

        $this->assertEquals(
            ['Neo', 'Smith', 'Trinity'],
            $employes->pluck('nom')->toArray(),
        );
    }

    public function test_should_see_employes_name_in_uppercase(): void
    {
        Employe::factory()->create(
            [
                'nom' => 'Neo',
                'age' => 23
            ]
        );
        $response = $this->get('/employes-majeurs');
        $response->assertSee('NEO');
    }
}
