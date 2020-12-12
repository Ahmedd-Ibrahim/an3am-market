<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Basket;

class BasketApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_basket()
    {
        $basket = factory(Basket::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/baskets', $basket
        );

        $this->assertApiResponse($basket);
    }

    /**
     * @test
     */
    public function test_read_basket()
    {
        $basket = factory(Basket::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/baskets/'.$basket->id
        );

        $this->assertApiResponse($basket->toArray());
    }

    /**
     * @test
     */
    public function test_update_basket()
    {
        $basket = factory(Basket::class)->create();
        $editedBasket = factory(Basket::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/baskets/'.$basket->id,
            $editedBasket
        );

        $this->assertApiResponse($editedBasket);
    }

    /**
     * @test
     */
    public function test_delete_basket()
    {
        $basket = factory(Basket::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/baskets/'.$basket->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/baskets/'.$basket->id
        );

        $this->response->assertStatus(404);
    }
}
