<?php

namespace App\Http\Controllers;

use App\DataTables\ProductUserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProductUserRequest;
use App\Http\Requests\UpdateProductUserRequest;
use App\Repositories\ProductUserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductUserController extends AppBaseController
{
    /** @var  ProductUserRepository */
    private $productUserRepository;

    public function __construct(ProductUserRepository $productUserRepo)
    {
        $this->productUserRepository = $productUserRepo;
    }

    /**
     * Display a listing of the ProductUser.
     *
     * @param ProductUserDataTable $productUserDataTable
     * @return Response
     */
    public function index(ProductUserDataTable $productUserDataTable)
    {
        return $productUserDataTable->render('product_users.index');
    }

    /**
     * Show the form for creating a new ProductUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_users.create');
    }

    /**
     * Store a newly created ProductUser in storage.
     *
     * @param CreateProductUserRequest $request
     *
     * @return Response
     */
    public function store(CreateProductUserRequest $request)
    {
        $input = $request->all();

        $productUser = $this->productUserRepository->create($input);

        Flash::success('Product User saved successfully.');

        return redirect(route('productUsers.index'));
    }

    /**
     * Display the specified ProductUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            Flash::error('Product User not found');

            return redirect(route('productUsers.index'));
        }

        return view('product_users.show')->with('productUser', $productUser);
    }

    /**
     * Show the form for editing the specified ProductUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            Flash::error('Product User not found');

            return redirect(route('productUsers.index'));
        }

        return view('product_users.edit')->with('productUser', $productUser);
    }

    /**
     * Update the specified ProductUser in storage.
     *
     * @param  int              $id
     * @param UpdateProductUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductUserRequest $request)
    {
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            Flash::error('Product User not found');

            return redirect(route('productUsers.index'));
        }

        $productUser = $this->productUserRepository->update($request->all(), $id);

        Flash::success('Product User updated successfully.');

        return redirect(route('productUsers.index'));
    }

    /**
     * Remove the specified ProductUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productUser = $this->productUserRepository->find($id);

        if (empty($productUser)) {
            Flash::error('Product User not found');

            return redirect(route('productUsers.index'));
        }

        $this->productUserRepository->delete($id);

        Flash::success('Product User deleted successfully.');

        return redirect(route('productUsers.index'));
    }
}
