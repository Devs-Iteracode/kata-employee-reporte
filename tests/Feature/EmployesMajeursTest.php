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
}
