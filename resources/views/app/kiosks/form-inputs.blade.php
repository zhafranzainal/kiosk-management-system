@php $editing = isset($kiosk) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="business_type_id" label="Business Type" required>
            @php $selected = old('business_type_id', ($editing ? $kiosk->business_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Business Type</option>
            @foreach($businessTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $kiosk->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $kiosk->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="suggested_action" label="Suggested Action">
            @php $selected = old('suggested_action', ($editing ? $kiosk->suggested_action : 'No Action')) @endphp
            <option value="No Action" {{ $selected == 'No Action' ? 'selected' : '' }} >No action</option>
            <option value="Terminate" {{ $selected == 'Terminate' ? 'selected' : '' }} >Terminate</option>
            <option value="Suspend" {{ $selected == 'Suspend' ? 'selected' : '' }} >Suspend</option>
            <option value="Reassign" {{ $selected == 'Reassign' ? 'selected' : '' }} >Reassign</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment"
            label="Comment"
            :value="old('comment', ($editing ? $kiosk->comment : ''))"
            maxlength="255"
            placeholder="Comment"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $kiosk->status : 'Inactive')) @endphp
            <option value="Inactive" {{ $selected == 'Inactive' ? 'selected' : '' }} >Inactive</option>
            <option value="Active" {{ $selected == 'Active' ? 'selected' : '' }} >Active</option>
            <option value="Warning" {{ $selected == 'Warning' ? 'selected' : '' }} >Warning</option>
            <option value="Repair" {{ $selected == 'Repair' ? 'selected' : '' }} >Repair</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
