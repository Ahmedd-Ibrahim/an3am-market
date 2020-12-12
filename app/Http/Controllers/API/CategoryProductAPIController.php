<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryProductAPIRequest;
use App\Http\Requests\API\UpdateCategoryProductAPIRequest;
use App\Models\CategoryProduct;
use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CategoryProductController
 * @package App\Http\Controllers\API
 */

class CategoryProductAPIController extends AppBaseController
{
    /** @var  CategoryProductRepository */
    private $categoryProductRepository;

    public function __construct(CategoryProductRepository $categoryProductRepo)
    {
        $this->categoryProductRepository = $categoryProductRepo;
    }

    /**
     * Display a listing of the CategoryProduct.
     * GET|HEAD /categoryProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categoryProducts = $this->categoryProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categoryProducts->toArray(), 'Category Products retrieved successfully');
    }

    /**
     * Store a newly created CategoryProduct in storage.
     * POST /categoryProducts
     *
     * @param CreateCategoryProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryProductAPIRequest $request)
    {
        $input = $request->all();

        $categoryProduct = $this->categoryProductRepository->create($input);

        return $this->sendResponse($categoryProduct->toArray(), 'Category Product saved successfully');
    }

    /**
     * Display the specified CategoryProduct.
     * GET|HEAD /categoryProducts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CategoryProduct $categoryProduct */
        $categoryProduct = $this->categoryProductRepository->find($id);

        if (empty($categoryProduct)) {
            return $this->sendError('Category Product not found');
        }

        return $this->sendResponse($categoryProduct->toArray(), 'Category Product retrieved successfully');
    }

    /**
     * Update the specified CategoryProduct in storage.
     * PUT/PATCH /categoryProducts/{id}
     *
     * @param int $id
     * @param UpdateCategoryProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategoryProduct $categoryProduct */
        $categoryProduct = $this->categoryProductRepository->find($id);

        if (empty($categoryProduct)) {
            return $this->sendError('Category Product not found');
        }

        $categoryProduct = $this->categoryProductRepository->update($input, $id);

        return $this->sendResponse($categoryProduct->toArray(), 'CategoryProduct updated successfully');
    }

    /**
     * Remove the specified CategoryProduct from storage.
     * DELETE /categoryProducts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CategoryProduct $categoryProduct */
        $categoryProduct = $this->categoryProductRepository->find($id);

        if (empty($categoryProduct)) {
            return $this->sendError('Category Product not found');
        }

        $categoryProduct->delete();

        return $this->sendSuccess('Category Product deleted successfully');
    }
}
