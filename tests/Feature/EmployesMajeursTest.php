<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployesMajeursTest extends TestCase
{

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

    public function test_index_list_show_an_employee(): void
    {
        $response = $this->get('/employes-majeurs');
        $response->assertSee('Agent Smith');
    }
}
