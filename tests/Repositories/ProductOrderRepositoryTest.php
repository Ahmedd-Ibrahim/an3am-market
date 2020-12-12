<?php namespace Tests\Repositories;

use App\Models\ProductOrder;
use App\Repositories\ProductOrderRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductOrderRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductOrderRepository
     */
    protected $productOrderRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productOrderRepo = \App::make(ProductOrderRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_order()
    {
        $productOrder = factory(ProductOrder::class)->make()->toArray();

        $createdProductOrder = $this->productOrderRepo->create($productOrder);

        $createdProductOrder = $createdProductOrder->toArray();
        $this->assertArrayHasKey('id', $createdProductOrder);
        $this->assertNotNull($createdProductOrder['id'], 'Created ProductOrder must have id specified');
        $this->assertNotNull(ProductOrder::find($createdProductOrder['id']), 'ProductOrder with given id must be in DB');
        $this->assertModelData($productOrder, $createdProductOrder);
    }

    /**
     * @test read
     */
    public function test_read_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();

        $dbProductOrder = $this->productOrderRepo->find($productOrder->id);

        $dbProductOrder = $dbProductOrder->toArray();
        $this->assertModelData($productOrder->toArray(), $dbProductOrder);
    }

    /**
     * @test update
     */
    public function test_update_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();
        $fakeProductOrder = factory(ProductOrder::class)->make()->toArray();

        $updatedProductOrder = $this->productOrderRepo->update($fakeProductOrder, $productOrder->id);

        $this->assertModelData($fakeProductOrder, $updatedProductOrder->toArray());
        $dbProductOrder = $this->productOrderRepo->find($productOrder->id);
        $this->assertModelData($fakeProductOrder, $dbProductOrder->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_order()
    {
        $productOrder = factory(ProductOrder::class)->create();

        $resp = $this->productOrderRepo->delete($productOrder->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductOrder::find($productOrder->id), 'ProductOrder should not exist in DB');
    }
}
