<?php

namespace App\Http\Controllers;

use App\DataTables\SettingsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Repositories\SettingsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SettingsController extends AppBaseController
{
    /** @var  SettingsRepository */
    private $settingsRepository;

    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settingsRepository = $settingsRepo;
    }

    /**
     * Display a listing of the Settings.
     *
     * @param SettingsDataTable $settingsDataTable
     * @return Response
     */
    public function index(SettingsDataTable $settingsDataTable)
    {
        return $settingsDataTable->render('settings.index');
    }

    /**
     * Show the form for creating a new Settings.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created Settings in storage.
     *
     * @param CreateSettingsRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingsRequest $request)
    {
        $input = $request->all();

        $settings = $this->settingsRepository->create($input);

        Flash::success('Settings saved successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified Settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $settings = $this->settingsRepository->find($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('settings', $settings);
    }

    /**
     * Show the form for editing the specified Settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $settings = $this->settingsRepository->find($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('settings', $settings);
    }

    /**
     * Update the specified Settings in storage.
     *
     * @param  int              $id
     * @param UpdateSettingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSettingsRequest $request)
    {
        $settings = $this->settingsRepository->find($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $settings = $this->settingsRepository->update($request->all(), $id);

        Flash::success('Settings updated successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified Settings from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $settings = $this->settingsRepository->find($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $this->settingsRepository->delete($id);

        Flash::success('Settings deleted successfully.');

        return redirect(route('settings.index'));
    }
}
