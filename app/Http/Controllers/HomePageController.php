<?php

namespace App\Http\Controllers;

use App\DataTables\HomePageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateHomePageRequest;
use App\Http\Requests\UpdateHomePageRequest;
use App\Repositories\HomePageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class HomePageController extends AppBaseController
{
    /** @var  HomePageRepository */
    private $homePageRepository;

    public function __construct(HomePageRepository $homePageRepo)
    {
        $this->homePageRepository = $homePageRepo;
    }

    /**
     * Display a listing of the HomePage.
     *
     * @param HomePageDataTable $homePageDataTable
     * @return Response
     */
    public function index(HomePageDataTable $homePageDataTable)
    {
        return $homePageDataTable->render('home_pages.index');
    }

    /**
     * Show the form for creating a new HomePage.
     *
     * @return Response
     */
    public function create()
    {
        return view('home_pages.create');
    }

    /**
     * Store a newly created HomePage in storage.
     *
     * @param CreateHomePageRequest $request
     *
     * @return Response
     */
    public function store(CreateHomePageRequest $request)
    {
        $input = $request->all();

        $homePage = $this->homePageRepository->create($input);

        Flash::success('Home Page saved successfully.');

        return redirect(route('homePages.index'));
    }

    /**
     * Display the specified HomePage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            Flash::error('Home Page not found');

            return redirect(route('homePages.index'));
        }

        return view('home_pages.show')->with('homePage', $homePage);
    }

    /**
     * Show the form for editing the specified HomePage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            Flash::error('Home Page not found');

            return redirect(route('homePages.index'));
        }

        return view('home_pages.edit')->with('homePage', $homePage);
    }

    /**
     * Update the specified HomePage in storage.
     *
     * @param  int              $id
     * @param UpdateHomePageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHomePageRequest $request)
    {
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            Flash::error('Home Page not found');

            return redirect(route('homePages.index'));
        }

        $homePage = $this->homePageRepository->update($request->all(), $id);

        Flash::success('Home Page updated successfully.');

        return redirect(route('homePages.index'));
    }

    /**
     * Remove the specified HomePage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            Flash::error('Home Page not found');

            return redirect(route('homePages.index'));
        }

        $this->homePageRepository->delete($id);

        Flash::success('Home Page deleted successfully.');

        return redirect(route('homePages.index'));
    }
}
