<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_public_information_pages_render_successfully(): void
    {
        foreach (['pages.about', 'pages.reports', 'pages.branches', 'blog.index'] as $routeName) {
            $this->get(route($routeName))->assertStatus(200);
        }
    }
}
