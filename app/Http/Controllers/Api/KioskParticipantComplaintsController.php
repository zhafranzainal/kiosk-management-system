<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KioskParticipant;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\ComplaintCollection;

class KioskParticipantComplaintsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('view', $kioskParticipant);

        $search = $request->get('search', '');

        $complaints = $kioskParticipant
            ->complaints()
            ->search($search)
            ->latest()
            ->paginate();

        return new ComplaintCollection($complaints);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KioskParticipant $kioskParticipant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, KioskParticipant $kioskParticipant)
    {
        $this->authorize('create', Complaint::class);

        $validated = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'description' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:Pending,In Progress,Completed'],
        ]);

        $complaint = $kioskParticipant->complaints()->create($validated);

        return new ComplaintResource($complaint);
    }
}
