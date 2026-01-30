<?php

namespace App\Http\Controllers;

use App\DataTables\VipSignupsDataTable;
use App\Models\VipSignup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VipSignupController extends Controller
{
    /**
     * Display a listing of VIP signups.
     */
    public function index(Request $request, VipSignupsDataTable $dataTable): View|RedirectResponse|JsonResponse
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }

        return view('vip-signups.index', [
            'dataTable' => $dataTable->html(),
        ]);
    }

    /**
     * Remove the specified VIP signup.
     */
    public function destroy(VipSignup $vipSignup): RedirectResponse
    {
        $vipSignup->delete();

        return redirect()
            ->route('vip-signups.index')
            ->with('status', __('VIP signup removed successfully.'));
    }
}
