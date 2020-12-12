<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductOrderAPIRequest;
use App\Http\Requests\API\UpdateProductOrderAPIRequest;
use App\Models\ProductOrder;
use App\Repositories\ProductOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductOrderController
 * @package App\Http\Controllers\API
 */

class ProductOrderAPIController extends AppBaseController
{
    /** @var  ProductOrderRepository */
    private $productOrderRepository;

    public function __construct(ProductOrderRepository $productOrderRepo)
    {
        $this->productOrderRepository = $productOrderRepo;
    }

    /**
     * Display a listing of the ProductOrder.
     * GET|HEAD /productOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productOrders = $this->productOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productOrders->toArray(), 'Product Orders retrieved successfully');
    }

    /**
     * Store a newly created ProductOrder in storage.
     * POST /productOrders
     *
     * @param CreateProductOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductOrderAPIRequest $request)
    {
        $input = $request->all();

        $productOrder = $this->productOrderRepository->create($input);

        return $this->sendResponse($productOrder->toArray(), 'Product Order saved successfully');
    }

    /**
     * Display the specified ProductOrder.
     * GET|HEAD /productOrders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductOrder $productOrder */
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            return $this->sendError('Product Order not found');
        }

        return $this->sendResponse($productOrder->toArray(), 'Product Order retrieved successfully');
    }

    /**
     * Update the specified ProductOrder in storage.
     * PUT/PATCH /productOrders/{id}
     *
     * @param int $id
     * @param UpdateProductOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductOrder $productOrder */
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            return $this->sendError('Product Order not found');
        }

        $productOrder = $this->productOrderRepository->update($input, $id);

        return $this->sendResponse($productOrder->toArray(), 'ProductOrder updated successfully');
    }

    /**
     * Remove the specified ProductOrder from storage.
     * DELETE /productOrders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductOrder $productOrder */
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            return $this->sendError('Product Order not found');
        }

        $productOrder->delete();

        return $this->sendSuccess('Product Order deleted successfully');
    }
}
