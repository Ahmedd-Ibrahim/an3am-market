<?php namespace Tests\Repositories;

use App\Models\CategoryProduct;
use App\Repositories\CategoryProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CategoryProductRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CategoryProductRepository
     */
    protected $categoryProductRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryProductRepo = \App::make(CategoryProductRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->make()->toArray();

        $createdCategoryProduct = $this->categoryProductRepo->create($categoryProduct);

        $createdCategoryProduct = $createdCategoryProduct->toArray();
        $this->assertArrayHasKey('id', $createdCategoryProduct);
        $this->assertNotNull($createdCategoryProduct['id'], 'Created CategoryProduct must have id specified');
        $this->assertNotNull(CategoryProduct::find($createdCategoryProduct['id']), 'CategoryProduct with given id must be in DB');
        $this->assertModelData($categoryProduct, $createdCategoryProduct);
    }

    /**
     * @test read
     */
    public function test_read_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();

        $dbCategoryProduct = $this->categoryProductRepo->find($categoryProduct->id);

        $dbCategoryProduct = $dbCategoryProduct->toArray();
        $this->assertModelData($categoryProduct->toArray(), $dbCategoryProduct);
    }

    /**
     * @test update
     */
    public function test_update_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();
        $fakeCategoryProduct = factory(CategoryProduct::class)->make()->toArray();

        $updatedCategoryProduct = $this->categoryProductRepo->update($fakeCategoryProduct, $categoryProduct->id);

        $this->assertModelData($fakeCategoryProduct, $updatedCategoryProduct->toArray());
        $dbCategoryProduct = $this->categoryProductRepo->find($categoryProduct->id);
        $this->assertModelData($fakeCategoryProduct, $dbCategoryProduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_category_product()
    {
        $categoryProduct = factory(CategoryProduct::class)->create();

        $resp = $this->categoryProductRepo->delete($categoryProduct->id);

        $this->assertTrue($resp);
        $this->assertNull(CategoryProduct::find($categoryProduct->id), 'CategoryProduct should not exist in DB');
    }
}
