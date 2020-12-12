<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ProductOrder;

class ProductOrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_product_order()
    {
        $productOrder = factory(ProductOrder::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/product_orders', $productOrder
        );

        $this->assertApiResponse($productOrder);
    }

    /**
     * @test
     */
    public function test_read_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/product_orders/'.$productOrder->id
        );

        $this->assertApiResponse($productOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();
        $editedProductOrder = factory(ProductOrder::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/product_orders/'.$productOrder->id,
            $editedProductOrder
        );

        $this->assertApiResponse($editedProductOrder);
    }

    /**
     * @test
     */
    public function test_delete_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/product_orders/'.$productOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/product_orders/'.$productOrder->id
        );

        $this->response->assertStatus(404);
    }
}
