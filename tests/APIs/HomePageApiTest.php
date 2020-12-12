<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HomePage;

class HomePageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_home_page()
    {
        $homePage = factory(HomePage::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/home_pages', $homePage
        );

        $this->assertApiResponse($homePage);
    }

    /**
     * @test
     */
    public function test_read_home_page()
    {
        $homePage = factory(HomePage::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/home_pages/'.$homePage->id
        );

        $this->assertApiResponse($homePage->toArray());
    }

    /**
     * @test
     */
    public function test_update_home_page()
    {
        $homePage = factory(HomePage::class)->create();
        $editedHomePage = factory(HomePage::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/home_pages/'.$homePage->id,
            $editedHomePage
        );

        $this->assertApiResponse($editedHomePage);
    }

    /**
     * @test
     */
    public function test_delete_home_page()
    {
        $homePage = factory(HomePage::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/home_pages/'.$homePage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/home_pages/'.$homePage->id
        );

        $this->response->assertStatus(404);
    }
}
