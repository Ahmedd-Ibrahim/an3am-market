<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBasketAPIRequest;
use App\Http\Requests\API\UpdateBasketAPIRequest;
use App\Http\Resources\BasketResource;
use App\Models\Basket;
use App\Repositories\BasketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BasketController
 * @package App\Http\Controllers\API
 */

class BasketAPIController extends AppBaseController
{
    /** @var  BasketRepository */
    private $basketRepository;

    public function __construct(BasketRepository $basketRepo)
    {
        $this->basketRepository = $basketRepo;
    }

    /**
     * Display a listing of the Basket.
     * GET|HEAD /baskets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $baskets = $this->basketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BasketResource::collection($baskets), 'Baskets retrieved successfully');
    }

    /**
     * Store a newly created Basket in storage.
     * POST /baskets
     *
     * @param CreateBasketAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBasketAPIRequest $request)
    {
        $input = $request->all();

        $basket = $this->basketRepository->create($input);

        if (empty($basket)) {
            return $this->sendError('Out of stock');
        }

        return $this->sendResponse($basket, 'Basket saved successfully');
    }

    /**
     * Display the specified Basket.
     * GET|HEAD /baskets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Basket $basket */
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            return $this->sendError('Basket not found');
        }

        return $this->sendResponse($basket->toArray(), 'Basket retrieved successfully');
    }

    /**
     * Update the specified Basket in storage.
     * PUT/PATCH /baskets/{id}
     *
     * @param int $id
     * @param UpdateBasketAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBasketAPIRequest $request)
    {
        $input = $request->all();

        /** @var Basket $basket */
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            return $this->sendError('Basket not found');
        }

        $basket = $this->basketRepository->update($input, $id);

        return $this->sendResponse($basket->toArray(), 'Basket updated successfully');
    }

    /**
     * Remove the specified Basket from storage.
     * DELETE /baskets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
//        /** @var Basket $basket */
        $basket = $this->basketRepository->delete($id);

        if ($basket != true)
        {
            return $this->sendError('Basket not found');
        }

        return $this->sendSuccess( 'This Product Deleted from Basket');
    }

    public function totalPrice()
    {
        $total = $this->basketRepository->totalPrice();

        if(!$total)
        {
            return $this->sendResponse(0, 'Basket price retrieved successfully');
        }
        return $this->sendResponse($total, 'Basket price retrieved successfully');

    }

    public function testClear()
    {
        $clear = $this->basketRepository->clearBasket();

        return $this->sendResponse($clear, 'Basket Deleted successfully');

    }

    public function reduceProduct($id)
    {
        $reduce = $this->basketRepository->reduce($id);

        if ($reduce == 'not found')
        {
            $this->sendError('product not exists');
        }
        elseif ($reduce == 'success')
        {
            return $this->sendSuccess( 'product reduced successfully');
        }

         return   $this->sendError('can not reduce under one ');

    }
}
