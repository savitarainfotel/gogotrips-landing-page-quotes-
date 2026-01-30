<?php

namespace App\Http\Controllers;

use App\DataTables\AirportCodesDataTable;
use App\Http\Requests\StoreAirportCodeRequest;
use App\Http\Requests\UpdateAirportCodeRequest;
use App\Models\AirportCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AirportCodeController extends Controller
{
    /**
     * Display a listing of airport codes.
     */
    public function index(Request $request, AirportCodesDataTable $dataTable): View|RedirectResponse|JsonResponse
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }

        return view('airport-codes.index', [
            'dataTable' => $dataTable->html(),
        ]);
    }

    /**
     * Show the form for creating a new airport code.
     */
    public function create(): View
    {
        return view('airport-codes.create');
    }

    /**
     * Store a newly created airport code.
     */
    public function store(StoreAirportCodeRequest $request): RedirectResponse
    {
        AirportCode::create($request->validated());

        return redirect()
            ->route('airport-codes.index')
            ->with('status', __('Airport code created successfully.'));
    }

    /**
     * Show the form for editing the specified airport code.
     */
    public function edit(AirportCode $airportCode): View
    {
        return view('airport-codes.edit', ['airportCode' => $airportCode]);
    }

    /**
     * Update the specified airport code.
     */
    public function update(UpdateAirportCodeRequest $request, AirportCode $airportCode): RedirectResponse
    {
        $airportCode->update($request->validated());

        return redirect()
            ->route('airport-codes.index')
            ->with('status', __('Airport code updated successfully.'));
    }

    /**
     * Remove the specified airport code.
     */
    public function destroy(AirportCode $airportCode): RedirectResponse
    {
        $airportCode->delete();

        return redirect()
            ->route('airport-codes.index')
            ->with('status', __('Airport code deleted successfully.'));
    }
}
