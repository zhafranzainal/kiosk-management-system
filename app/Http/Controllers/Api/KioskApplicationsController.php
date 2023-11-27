<?php

namespace App\Http\Controllers\Api;

use App\Models\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ApplicationCollection;

class KioskApplicationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Kiosk $kiosk)
    {
        $this->authorize('view', $kiosk);

        $search = $request->get('search', '');

        $applications = $kiosk
            ->applications()
            ->search($search)
            ->latest()
            ->paginate();

        return new ApplicationCollection($applications);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kiosk $kiosk)
    {
        $this->authorize('create', Application::class);

        $validated = $request->validate([
            'transaction_id' => ['required', 'exists:transactions,id'],
            'user_id' => ['required', 'exists:users,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'status' => ['required', 'in:Pending,Accepted,Rejected'],
        ]);

        $application = $kiosk->applications()->create($validated);

        return new ApplicationResource($application);
    }
}
