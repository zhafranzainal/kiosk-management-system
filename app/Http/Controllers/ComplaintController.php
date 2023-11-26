<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\KioskParticipant;
use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;

class ComplaintController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Complaint::class);

        $search = $request->get('search', '');

        $complaints = Complaint::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('complaints.index', compact('complaints', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Complaint::class);

        $kioskParticipants = KioskParticipant::pluck('account_no', 'id');
        $users = User::pluck('name', 'id');

        return view('complaints.create', compact('kioskParticipants', 'users'));
    }

    /**
     * @param \App\Http\Requests\ComplaintStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintStoreRequest $request)
    {
        $this->authorize('create', Complaint::class);

        $validated = $request->validated();

        $complaint = Complaint::create($validated);

        return redirect()
            ->route('complaints.edit', $complaint)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Complaint $complaint)
    {
        $this->authorize('view', $complaint);

        return view('complaints.show', compact('complaint'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Complaint $complaint)
    {
        $this->authorize('update', $complaint);

        $kioskParticipants = KioskParticipant::pluck('account_no', 'id');
        $users = User::pluck('name', 'id');

        return view('complaints.edit', compact('complaint', 'kioskParticipants', 'users'));
    }

    /**
     * @param \App\Http\Requests\ComplaintUpdateRequest $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(
        ComplaintUpdateRequest $request,
        Complaint $complaint
    ) {
        $this->authorize('update', $complaint);

        $validated = $request->validated();

        $complaint->update($validated);

        return redirect()
            ->route('complaints.edit', $complaint)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Complaint $complaint)
    {
        $this->authorize('delete', $complaint);

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
