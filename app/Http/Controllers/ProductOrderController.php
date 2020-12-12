<?php

namespace App\Http\Controllers;

use App\DataTables\ProductOrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductOrderRequest;
use App\Http\Requests\UpdateProductOrderRequest;
use App\Repositories\ProductOrderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductOrderController extends AppBaseController
{
    /** @var  ProductOrderRepository */
    private $productOrderRepository;

    public function __construct(ProductOrderRepository $productOrderRepo)
    {
        $this->productOrderRepository = $productOrderRepo;
    }

    /**
     * Display a listing of the ProductOrder.
     *
     * @param ProductOrderDataTable $productOrderDataTable
     * @return Response
     */
    public function index(ProductOrderDataTable $productOrderDataTable)
    {
        return $productOrderDataTable->render('product_orders.index');
    }

    /**
     * Show the form for creating a new ProductOrder.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_orders.create');
    }

    /**
     * Store a newly created ProductOrder in storage.
     *
     * @param CreateProductOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateProductOrderRequest $request)
    {
        $input = $request->all();

        $productOrder = $this->productOrderRepository->create($input);

        Flash::success('Product Order saved successfully.');

        return redirect(route('productOrders.index'));
    }

    /**
     * Display the specified ProductOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            Flash::error('Product Order not found');

            return redirect(route('productOrders.index'));
        }

        return view('product_orders.show')->with('productOrder', $productOrder);
    }

    /**
     * Show the form for editing the specified ProductOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            Flash::error('Product Order not found');

            return redirect(route('productOrders.index'));
        }

        return view('product_orders.edit')->with('productOrder', $productOrder);
    }

    /**
     * Update the specified ProductOrder in storage.
     *
     * @param  int              $id
     * @param UpdateProductOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductOrderRequest $request)
    {
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            Flash::error('Product Order not found');

            return redirect(route('productOrders.index'));
        }

        $productOrder = $this->productOrderRepository->update($request->all(), $id);

        Flash::success('Product Order updated successfully.');

        return redirect(route('productOrders.index'));
    }

    /**
     * Remove the specified ProductOrder from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productOrder = $this->productOrderRepository->find($id);

        if (empty($productOrder)) {
            Flash::error('Product Order not found');

            return redirect(route('productOrders.index'));
        }

        $this->productOrderRepository->delete($id);

        Flash::success('Product Order deleted successfully.');

        return redirect(route('productOrders.index'));
    }
}
