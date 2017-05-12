<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEndpoint()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    '_id',
                    'name',
                    'dimensions' => [
                        '*' => [
                            '_id',
                            'path'
                        ]
                    ]
                ]
            ]);
    }
}
