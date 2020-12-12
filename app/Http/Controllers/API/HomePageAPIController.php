<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHomePageAPIRequest;
use App\Http\Requests\API\UpdateHomePageAPIRequest;
use App\Http\Requests\CustomSearchRequest;
use App\Http\Requests\searchRequest;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\MostRequiredResource;
use App\Http\Resources\SliderResource;
use App\Models\HomePage;
use App\Models\Product;
use App\Repositories\HomePageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HomePageController
 * @package App\Http\Controllers\API
 */

class HomePageAPIController extends AppBaseController
{
    /** @var  HomePageRepository */
    private $homePageRepository;

    public function __construct(HomePageRepository $homePageRepo)
    {
        $this->homePageRepository = $homePageRepo;
    }

    /**
     * Display a listing of the HomePage.
     * GET|HEAD /homePages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $homePages = $this->homePageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($homePages->toArray(), 'Home Pages retrieved successfully');
    }

    /**
     * Store a newly created HomePage in storage.
     * POST /homePages
     *
     * @param CreateHomePageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHomePageAPIRequest $request)
    {
        $input = $request->all();

        $homePage = $this->homePageRepository->create($input);

        return $this->sendResponse($homePage->toArray(), 'Home Page saved successfully');
    }

    /**
     * Display the specified HomePage.
     * GET|HEAD /homePages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HomePage $homePage */
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            return $this->sendError('Home Page not found');
        }

        return $this->sendResponse($homePage->toArray(), 'Home Page retrieved successfully');
    }

    /**
     * Update the specified HomePage in storage.
     * PUT/PATCH /homePages/{id}
     *
     * @param int $id
     * @param UpdateHomePageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHomePageAPIRequest $request)
    {
        $input = $request->all();

        /** @var HomePage $homePage */
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            return $this->sendError('Home Page not found');
        }

        $homePage = $this->homePageRepository->update($input, $id);

        return $this->sendResponse($homePage->toArray(), 'HomePage updated successfully');
    }

    /**
     * Remove the specified HomePage from storage.
     * DELETE /homePages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HomePage $homePage */
        $homePage = $this->homePageRepository->find($id);

        if (empty($homePage)) {
            return $this->sendError('Home Page not found');
        }

        $homePage->delete();

        return $this->sendSuccess('Home Page deleted successfully');
    }


    public function slider()
    {
        $sliders =  $this->homePageRepository->slider(5);

        if (count($sliders) > 0)
        {
            return $this->sendResponse(SliderResource::collection($sliders), 'Sliders retrieved successfully');

        }
        return $this->sendError('No sliders in the app');

    } // End of slider

    public function feature()
    {
        $feature = $this->homePageRepository->feature(4);

        if (count($feature) > 0)
        {
            return $this->sendResponse(FeatureResource::collection($feature), 'Sliders retrieved successfully');
        }

        return $this->sendError('No feature in the app');

    } // End of feature

    public function bestSeller()
    {
        $best = $this->homePageRepository->bestSeller(4);

        if (count($best) > 0)
        {
            return $this->sendResponse(MostRequiredResource::collection($best), 'Sliders retrieved successfully');

        }
        return $this->sendError('No products in the app');

    } // end of best seller [most required]

    public function allProducts()
    {

        $allProducts = Product::paginate(30);
        if($allProducts)
        {
            return $this->sendResponse($allProducts, 'Sliders retrieved successfully');

        }
        return $this->sendError('No products retrieved');
    } // End of all products

    public function search(searchRequest $request)
    {

        $result = $this->homePageRepository->search($request);
        if($result)
        {
            return $this->sendResponse($result, 'search retrieved successfully');

        }

        return $this->sendError('No products retrieved');

    }// End of search

    // return select options
    public function customSearch()
    {
        $result = $this->homePageRepository->CustomSearch();
        if($result)
        {
            return $this->sendResponse($result, 'search retrieved successfully');

        }

        return $this->sendError('No products retrieved');
    } // End of custom search

    // return products from deep searching
    public function customSearching(CustomSearchRequest $request)
    {

        $result = $this->homePageRepository->customSearching($request);
        if($result)
        {
            return $this->sendResponse($result, 'search retrieved successfully');

        }

        return $this->sendError('No products retrieved');
    } // end of custom searching

}
