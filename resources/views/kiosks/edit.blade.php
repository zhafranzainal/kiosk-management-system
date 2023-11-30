<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.kiosks.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-partials.card>

                <x-slot name="title">
                    <a href="{{ route('kiosks.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <x-form method="PUT" action="{{ route('kiosks.update', $kiosk) }}" class="mt-4">

                    @php $editing = isset($kiosk) @endphp

                    <div class="flex flex-wrap">

                        <x-inputs.group class="w-full">
                            <h5 class="font-bold">
                                General Info
                            </h5>
                        </x-inputs.group>

                        <x-inputs.group class="w-full">

                            @php
                                function getKioskNumberForEdit($kiosk)
                                {
                                    $kioskNumber = 'FKK' . str_pad($kiosk->id, 2, '0', STR_PAD_LEFT);
                                    return $kioskNumber;
                                }
                            @endphp

                            <x-inputs.text name="kiosk_id" label="Kiosk Number" :value="getKioskNumberForEdit($kiosk)" disabled
                                style="background-color: #f5f5f5; color: #999;">
                            </x-inputs.text>

                        </x-inputs.group>

                        <x-inputs.group class="w-full">
                            <x-inputs.text name="name" label="Kiosk Name" :value="old('name', $editing ? $kiosk->name : 'Kiosk for Rent')" maxlength="255"
                                placeholder="Name" required>
                            </x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="w-full">
                            <x-inputs.text name="location" label="Kiosk Location" :value="old('location', $editing ? $kiosk->location : '')" maxlength="255"
                                placeholder="Short explanation about the location" required>
                            </x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="w-full">
                            <x-inputs.select name="business_type_id" label="Business Type" required>

                                @php $selected = old('business_type_id', ($editing ? $kiosk->business_type_id : '')) @endphp

                                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Business
                                    Type
                                </option>

                                @foreach ($businessTypes as $value => $label)
                                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach

                            </x-inputs.select>
                        </x-inputs.group>

                        <x-inputs.group class="w-full">
                            <x-inputs.select name="status" label="Kiosk Status">

                                @php $selected = old('status', ($editing ? $kiosk->status : 'Inactive')) @endphp

                                <option value="Inactive" {{ $selected == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>

                                <option value="Active" {{ $selected == 'Active' ? 'selected' : '' }}>Active
                                </option>

                                <option value="Warning" {{ $selected == 'Warning' ? 'selected' : '' }}>Warning
                                </option>

                                <option value="Repair" {{ $selected == 'Repair' ? 'selected' : '' }}>Repair
                                </option>

                            </x-inputs.select>
                        </x-inputs.group>

                    </div>

                    <div class="mt-10">

                        <a href="{{ route('kiosks.index') }}" class="button">
                            <i class="mr-1 icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('kiosks.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button type="submit" class="button button-primary float-right">
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>

                    </div>

                    <br>
                    @foreach ($errors->all() as $error)
                        <span class="text-red-500 text-sm">{{ $error }}</span><br>
                    @endforeach

                </x-form>

            </x-partials.card>

        </div>
    </div>

</x-app-layout>
