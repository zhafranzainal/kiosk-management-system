<?php

namespace App\Http\Controllers\Api;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KioskResource;
use App\Http\Resources\KioskCollection;

class BusinessTypeKiosksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BusinessType $businessType)
    {
        $this->authorize('view', $businessType);

        $search = $request->get('search', '');

        $kiosks = $businessType
            ->kiosks()
            ->search($search)
            ->latest()
            ->paginate();

        return new KioskCollection($kiosks);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BusinessType $businessType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BusinessType $businessType)
    {
        $this->authorize('create', Kiosk::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
            'suggested_action' => [
                'nullable',
                'in:No Action,Terminate,Suspend,Reassign',
            ],
            'comment' => ['nullable', 'max:255', 'string'],
            'status' => ['required', 'in:Inactive,Active,Warning,Repair'],
        ]);

        $kiosk = $businessType->kiosks()->create($validated);

        return new KioskResource($kiosk);
    }
}
