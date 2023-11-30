@php $editing = isset($kiosk) @endphp

<div class="flex flex-wrap">

    <x-inputs.group class="w-full">

        @php
            function getKioskNumber()
            {
                $nextId = \App\Models\Kiosk::max('id') + 1;
                $kioskNumber = 'FKK' . str_pad($nextId, 2, '0', STR_PAD_LEFT);

                return $kioskNumber;
            }
        @endphp

        <x-inputs.text name="kiosk_id" label="Kiosk Number" :value="getKioskNumber()" disabled
            style="background-color: #f5f5f5; color: #999;">
        </x-inputs.text>

    </x-inputs.group>

    <x-inputs.group class="w-full" style="display: none;">
        <x-inputs.text name="name" label="Name" :value="old('name', $editing ? $kiosk->name : 'Kiosk for Rent')" maxlength="255" placeholder="Name" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="location" label="Kiosk Location" :value="old('location', $editing ? $kiosk->location : '')" maxlength="255"
            placeholder="Short explanation about the location" required>
        </x-inputs.text>
    </x-inputs.group>

</div>
