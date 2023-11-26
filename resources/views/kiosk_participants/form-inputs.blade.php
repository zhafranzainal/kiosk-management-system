@php $editing = isset($kioskParticipant) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $kioskParticipant->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="kiosk_id" label="Kiosk" required>
            @php $selected = old('kiosk_id', ($editing ? $kioskParticipant->kiosk_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kiosk</option>
            @foreach($kiosks as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="bank_id" label="Bank">
            @php $selected = old('bank_id', ($editing ? $kioskParticipant->bank_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Bank</option>
            @foreach($banks as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="account_no"
            label="Account No"
            :value="old('account_no', ($editing ? $kioskParticipant->account_no : ''))"
            maxlength="255"
            placeholder="Account No"
        ></x-inputs.text>
    </x-inputs.group>
</div>
