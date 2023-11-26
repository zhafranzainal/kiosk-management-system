<?php

namespace App\Http\Controllers\Api;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KioskParticipantResource;
use App\Http\Resources\KioskParticipantCollection;

class BankKioskParticipantsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Bank $bank)
    {
        $this->authorize('view', $bank);

        $search = $request->get('search', '');

        $kioskParticipants = $bank
            ->kioskParticipants()
            ->search($search)
            ->latest()
            ->paginate();

        return new KioskParticipantCollection($kioskParticipants);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bank $bank)
    {
        $this->authorize('create', KioskParticipant::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'kiosk_id' => ['required', 'exists:kiosks,id'],
            'account_no' => ['nullable', 'max:255', 'string'],
        ]);

        $kioskParticipant = $bank->kioskParticipants()->create($validated);

        return new KioskParticipantResource($kioskParticipant);
    }
}
