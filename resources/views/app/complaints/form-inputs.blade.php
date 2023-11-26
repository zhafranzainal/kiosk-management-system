@php $editing = isset($complaint) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="kiosk_participant_id"
            label="Kiosk Participant"
            required
        >
            @php $selected = old('kiosk_participant_id', ($editing ? $complaint->kiosk_participant_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kiosk Participant</option>
            @foreach($kioskParticipants as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $complaint->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $complaint->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $complaint->status : 'Pending')) @endphp
            <option value="Pending" {{ $selected == 'Pending' ? 'selected' : '' }} >Pending</option>
            <option value="In Progress" {{ $selected == 'In Progress' ? 'selected' : '' }} >In progress</option>
            <option value="Completed" {{ $selected == 'Completed' ? 'selected' : '' }} >Completed</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
