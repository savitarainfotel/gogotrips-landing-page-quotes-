<?php

namespace App\Http\Controllers;

use App\DataTables\BookingsDataTable;
use App\Models\Booking;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with bookings datatable.
     */
    public function index(Request $request, BookingsDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }

        return view('dashboard', [
            'dataTable' => $dataTable->html(),
        ]);
    }
}