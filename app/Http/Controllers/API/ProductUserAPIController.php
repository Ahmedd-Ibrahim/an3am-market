<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductUserAPIRequest;
use App\Http\Requests\API\UpdateProductUserAPIRequest;
use App\Http\Resources\FavouriteResource;
use App\Models\ProductUser;
use App\Repositories\ProductUserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductUserController
 * @package App\Http\Controllers\API
 */

class ProductUserAPIController extends AppBaseController
{
    /** @var  ProductUserRepository */
    private $productUserRepository;

    public function __construct(ProductUserRepository $productUserRepo)
    {
        $this->productUserRepository = $productUserRepo;
    }

    /**
     * Display a listing of the ProductUser.
     * GET|HEAD /productUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $productUsers = $this->productUserRepository->favourite();

        if(!$productUsers || count($productUsers) <= 0 )
        {
            return $this->sendError('no favourite!');
        }
        return $this->sendResponse(FavouriteResource::collection($productUsers), 'Product Users retrieved successfully');
    }

    /**
     * Store a newly created ProductUser in storage.
     * POST /productUsers
     *
     * @param CreateProductUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductUserAPIRequest $request)
    {
        $input = $request->all();

        $productUser = $this->productUserRepository->create($input);

        if(!$productUser  || $productUser == null)
        {
            return $this->sendError('check product id something wrong!');
        }
        return $this->sendResponse($productUser, 'Product User saved successfully');
    }


    public function show($id)
    {
        /** @var ProductUser $productUser */
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            return $this->sendError('Product User not found');
        }

        return $this->sendResponse($productUser->toArray(), 'Product User retrieved successfully');
    }


    public function update($id, UpdateProductUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductUser $productUser */
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            return $this->sendError('Product User not found');
        }

        $productUser = $this->productUserRepository->update($input, $id);

        return $this->sendResponse($productUser->toArray(), 'ProductUser updated successfully');
    }

    /**
     * Remove the specified ProductUser from storage.
     * DELETE /productUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductUser $productUser */
        $productUser = $this->productUserRepository->delete($id);

        if (empty($productUser) || $productUser == null) {
            return $this->sendError('Product User not found');
        }

        return $this->sendSuccess('favourite removed successfully');
    }
}
