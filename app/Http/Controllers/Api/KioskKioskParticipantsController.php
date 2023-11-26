<?php

namespace App\Http\Controllers\Api;

use App\Models\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KioskParticipantResource;
use App\Http\Resources\KioskParticipantCollection;

class KioskKioskParticipantsController extends Controller
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

        $kioskParticipants = $kiosk
            ->kioskParticipants()
            ->search($search)
            ->latest()
            ->paginate();

        return new KioskParticipantCollection($kioskParticipants);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kiosk $kiosk
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kiosk $kiosk)
    {
        $this->authorize('create', KioskParticipant::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'bank_id' => ['nullable', 'exists:banks,id'],
            'account_no' => ['nullable', 'max:255', 'string'],
        ]);

        $kioskParticipant = $kiosk->kioskParticipants()->create($validated);

        return new KioskParticipantResource($kioskParticipant);
    }
}
