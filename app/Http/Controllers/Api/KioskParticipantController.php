<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KioskParticipant;
use App\Http\Controllers\Controller;
use App\Http\Resources\KioskParticipantResource;
use App\Http\Resources\KioskParticipantCollection;
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
            ->paginate();

        return new KioskParticipantCollection($kioskParticipants);
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

        return new KioskParticipantResource($kioskParticipant);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('view', $kioskParticipant);

        return new KioskParticipantResource($kioskParticipant);
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

        return new KioskParticipantResource($kioskParticipant);
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

        return response()->noContent();
    }
}
