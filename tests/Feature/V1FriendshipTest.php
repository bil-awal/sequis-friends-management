<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class V1FriendshipTest extends TestCase
{
    // use RefreshDatabase; <-- Don't use this, it will delete the database

    /**
     * @test
     * Request a friendship
     */
    public function request()
    {
        $response = $this->post('/api/v1/friendship/request', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);

        $response->assertJson([
            'success' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('v1_friendships', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);
    }

    /**
     * @test
     * Accept a friendship
     */
    public function accept()
    {
        $response = $this->post('/api/v1/friendship/accept', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);

        $response->assertJson([
            'success' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('v1_friendships', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);
    }

    /**
     * @test
     * Friend list
     */
    public function friend()
    {
        $response = $this->post('/api/v1/friendship', [
            'email' => 'andy@example.com'
        ]);

        $response->assertJson([
            'friends' => [
                'john@example.com'
            ]
        ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     * Reject a friendship
     */
    public function reject()
    {
        $response = $this->post('/api/v1/friendship/pending', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);

        $response = $this->post('/api/v1/friendship/reject', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);

        $response->assertJson([
            'success' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('v1_friendships', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com'
        ]);
    }

    /**
     * @test
     * Show friendship request list
     */
    public function showRequest()
    {
        $response = $this->post('/api/v1/friendship/request/list', [
            'email' => 'john@example.com'
        ]);

        $response->assertJson([
            'requests' =>  [
                [
                    'requestor' => 'andy@example.com',
                    'status' => 'rejected'
                ]
            ]
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     * Block a friendship request
     */
    public function blockRequest()
    {
        $response = $this->post('/api/v1/friendship/request/block', [
            'requestor' => 'andy@example.com',
            'block' =>  'john@example.com'
        ]);

        $response->assertJson([
            'success' => true
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('v1_friendships', [
            'requestor' => 'andy@example.com',
            'to' => 'john@example.com',
            'status' => 'blocked'
        ]);
    }

}
