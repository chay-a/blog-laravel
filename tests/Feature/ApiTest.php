<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_articles()
    {
        $this->seed(DatabaseSeeder::class);
        $client = new Client(['base_uri' => 'http://laravelblog.local']);
        $response = $client->request('GET', '/api/articles');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('data', $data);
        foreach ($data['data'] as $key => $value) {
            $this->assertArrayHasKey('id', $data['data'][$key]);
            $this->assertArrayHasKey('title', $data['data'][$key]);
            $this->assertArrayHasKey('content', $data['data'][$key]);
            $this->assertArrayHasKey('user_id', $data['data'][$key]);
            $this->assertArrayHasKey('published_at', $data['data'][$key]);
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_one_article()
    {
        $this->seed(DatabaseSeeder::class);
        $client = new Client(['base_uri' => 'http://laravelblog.local']);
        $response = $client->request('GET', '/api/articles/105');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('content', $data);
        $this->assertArrayHasKey('user_id', $data);
        $this->assertArrayHasKey('published_at', $data);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_comment()
    {
        $this->seed(DatabaseSeeder::class);
        $data = [
            'content' => 'Contenu de commentaire',
            'pseudo' => 'pseudo',
            'email' => 'email@gmail.com',
            'article_id' => 100
        ];
        $client = new Client(['base_uri' => 'http://laravelblog.local']);
        $response = $client->request('POST', '/api/comments/store', ['json' => json_encode($data)]);

        $this->assertEquals(201, $response->getStatusCode());

    }
}
