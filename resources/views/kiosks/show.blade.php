<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.kiosks.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-partials.card>

                <x-slot name="title">
                    <a href="{{ route('kiosks.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>

                <div class="mt-4 px-4">

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.business_type_id')
                        </h5>
                        <span>{{ optional($kiosk->businessType)->name ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.name')
                        </h5>
                        <span>{{ $kiosk->name ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.location')
                        </h5>
                        <span>{{ $kiosk->location ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.suggested_action')
                        </h5>
                        <span>{{ $kiosk->suggested_action ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.comment')
                        </h5>
                        <span>{{ $kiosk->comment ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kiosks.inputs.status')
                        </h5>
                        <span>{{ $kiosk->status ?? '-' }}</span>
                    </div>

                </div>

                <div class="mt-10">

                    <a href="{{ route('kiosks.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Kiosk::class)
                        <a href="{{ route('kiosks.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                    @endcan

                </div>

            </x-partials.card>

        </div>
    </div>

</x-app-layout>
