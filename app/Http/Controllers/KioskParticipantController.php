<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bank;
use App\Models\Kiosk;
use Illuminate\Http\Request;
use App\Models\KioskParticipant;
use App\Http\Requests\KioskParticipantStoreRequest;
use App\Http\Requests\KioskParticipantUpdateRequest;

class KioskParticipantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', KioskParticipant::class);

        $search = $request->get('search', '');

        $kioskParticipants = KioskParticipant::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('kiosk_participants.index', compact('kioskParticipants', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', KioskParticipant::class);

        $users = User::pluck('name', 'id');
        $kiosks = Kiosk::pluck('name', 'id');
        $banks = Bank::pluck('name', 'id');

        return view('kiosk_participants.create', compact('users', 'kiosks', 'banks'));
    }

    /**
     * @param \App\Http\Requests\KioskParticipantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KioskParticipantStoreRequest $request)
    {
        $this->authorize('create', KioskParticipant::class);

        $validated = $request->validated();

        $kioskParticipant = KioskParticipant::create($validated);

        return redirect()
            ->route('kiosk-participants.edit', $kioskParticipant)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('view', $kioskParticipant);

        return view('kiosk_participants.show', compact('kioskParticipant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('update', $kioskParticipant);

        $users = User::pluck('name', 'id');
        $kiosks = Kiosk::pluck('name', 'id');
        $banks = Bank::pluck('name', 'id');

        return view('kiosk_participants.edit', compact('kioskParticipant', 'users', 'kiosks', 'banks'));
    }

    /**
     * @param \App\Http\Requests\KioskParticipantUpdateRequest $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(
        KioskParticipantUpdateRequest $request,
        KioskParticipant $kioskParticipant
    ) {
        $this->authorize('update', $kioskParticipant);

        $validated = $request->validated();

        $kioskParticipant->update($validated);

        return redirect()
            ->route('kiosk-participants.edit', $kioskParticipant)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        KioskParticipant $kioskParticipant
    ) {
        $this->authorize('delete', $kioskParticipant);

        $kioskParticipant->delete();

        return redirect()
            ->route('kiosk-participants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
