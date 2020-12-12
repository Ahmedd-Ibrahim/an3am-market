<?php namespace Tests\Repositories;

use App\Models\Basket;
use App\Repositories\BasketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BasketRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BasketRepository
     */
    protected $basketRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->basketRepo = \App::make(BasketRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_basket()
    {
        $basket = factory(Basket::class)->make()->toArray();

        $createdBasket = $this->basketRepo->create($basket);

        $createdBasket = $createdBasket->toArray();
        $this->assertArrayHasKey('id', $createdBasket);
        $this->assertNotNull($createdBasket['id'], 'Created Basket must have id specified');
        $this->assertNotNull(Basket::find($createdBasket['id']), 'Basket with given id must be in DB');
        $this->assertModelData($basket, $createdBasket);
    }

    /**
     * @test read
     */
    public function test_read_basket()
    {
        $basket = factory(Basket::class)->create();

        $dbBasket = $this->basketRepo->find($basket->id);

        $dbBasket = $dbBasket->toArray();
        $this->assertModelData($basket->toArray(), $dbBasket);
    }

    /**
     * @test update
     */
    public function test_update_basket()
    {
        $basket = factory(Basket::class)->create();
        $fakeBasket = factory(Basket::class)->make()->toArray();

        $updatedBasket = $this->basketRepo->update($fakeBasket, $basket->id);

        $this->assertModelData($fakeBasket, $updatedBasket->toArray());
        $dbBasket = $this->basketRepo->find($basket->id);
        $this->assertModelData($fakeBasket, $dbBasket->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_basket()
    {
        $basket = factory(Basket::class)->create();

        $resp = $this->basketRepo->delete($basket->id);

        $this->assertTrue($resp);
        $this->assertNull(Basket::find($basket->id), 'Basket should not exist in DB');
    }
}
