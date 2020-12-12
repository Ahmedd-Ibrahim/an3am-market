<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CategoryProduct;

class CategoryProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/category_products', $categoryProduct
        );

        $this->assertApiResponse($categoryProduct);
    }

    /**
     * @test
     */
    public function test_read_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/category_products/'.$categoryProduct->id
        );

        $this->assertApiResponse($categoryProduct->toArray());
    }

    /**
     * @test
     */
    public function test_update_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();
        $editedCategoryProduct = factory(CategoryProduct::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/category_products/'.$categoryProduct->id,
            $editedCategoryProduct
        );

        $this->assertApiResponse($editedCategoryProduct);
    }

    /**
     * @test
     */
    public function test_delete_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/category_products/'.$categoryProduct->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/category_products/'.$categoryProduct->id
        );

        $this->response->assertStatus(404);
    }
}
