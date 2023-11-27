<?php

namespace Tests\Feature;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
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
            'date_de_naissance' => Carbon::today()->subYears(43),
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'date_de_naissance' => Carbon::today()->subYears(16),
        ]);
        Employe::factory()->create([
            'nom' => 'Trinity',
            'date_de_naissance' => Carbon::today()->subYears(18),
        ]);
        $response = $this->get('/employes-majeurs');
        $response->assertSee(['AGENT SMITH', 'Age : 43']);
        $response->assertDontSee(['NEO', 'Age : 16']);
        $response->assertSee(['TRINITY', 'Age : 18']);
    }

    public function test_index_list_is_ordered_desc(): void
    {
        Employe::factory()->create([
            'nom' => 'Smith',
            'date_de_naissance' => Carbon::today()->subYears(43),
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'date_de_naissance' => Carbon::today()->subYears(23),
        ]);
        Employe::factory()->create([
            'nom' => 'Trinity',
            'date_de_naissance' => Carbon::today()->subYears(18),
        ]);

        $response = $this->get('/employes-majeurs');
        $response->assertSeeTextInOrder([
            "TRINITY",
            "SMITH",
            "NEO",
        ]);
    }

    public function test_index_list_variable_is_ordered_desc(): void
    {
        Employe::factory()->create([
            'nom' => 'Smith',
            'date_de_naissance' => Carbon::today()->subYears(43),
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'date_de_naissance' => Carbon::today()->subYears(23),
        ]);
        Employe::factory()->create([
            'nom' => 'Trinity',
            'date_de_naissance' => Carbon::today()->subYears(18),
        ]);

        $response = $this->get('/employes-majeurs');
        $this->assertEquals(
            ['Trinity', 'Smith', 'Neo'],
            $response->viewData('employes')->pluck('nom')->toArray(),
        );
    }

    public function test_get_employes_majeurs_par_ordre_alphabetique_desc(): void
    {
        Employe::factory()->create([
            'nom' => 'Smith',
            'date_de_naissance' => Carbon::today()->subYears(43),
        ]);
        Employe::factory()->create([
            'nom' => 'Neo',
            'date_de_naissance' => Carbon::today()->subYears(23),
        ]);
        Employe::factory()->create([
            'nom' => 'Trinity',
            'date_de_naissance' => Carbon::today()->subYears(18),
        ]);

        $employes = Employe::getEmployesMajeursParOrdreAlphabetiqueDesc();

        $this->assertEquals(
            ['Trinity', 'Smith', 'Neo'],
            $employes->pluck('nom')->toArray(),
        );
    }

    public function test_should_see_employes_name_in_uppercase(): void
    {
        Employe::factory()->create([
            'nom' => 'Neo',
            'date_de_naissance' => Carbon::today()->subYears(23),
        ]);

        $response = $this->get('/employes-majeurs');
        $response->assertSee('NEO');
    }

    public function test_get_age(): void
    {
        $employe = Employe::factory()->create([
            'nom' => 'Smith',
            'date_de_naissance' => Carbon::today()->subYears(43),
        ]);

        $this->assertEquals(43, $employe->getAge());
    }
}
