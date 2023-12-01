<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.applications.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-partials.card>

                <x-slot name="title">
                    <a href="{{ route('applications.index') }}" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                </x-slot>

                <div class="mt-4 px-4">

                    <div class="mb-4">
                        <h5 class="font-bold text-xl">
                            Summary
                        </h5>
                    </div>

                    <div class="columns-2">

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                @lang('crud.applications.inputs.user_id')
                            </h5>
                            <span>{{ optional($application->user)->name ?? '-' }}</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Course
                            </h5>
                            <span>
                                {{ $application->user?->kioskParticipant?->student?->course?->name ?? '-' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Year / Semester
                            </h5>
                            <span>
                                Year {{ $application->user?->kioskParticipant?->student?->year ?? '-' }}
                                Semester {{ $application->user?->kioskParticipant?->student?->semester ?? '-' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Contact Number
                            </h5>
                            <span>{{ optional($application->user)->mobile_no ?? '-' }}</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Kiosk Number
                            </h5>
                            <span>FKK{{ str_pad(optional($application->kiosk)->id, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                @lang('crud.applications.inputs.kiosk_id')
                            </h5>
                            <span>{{ optional($application->kiosk)->name ?? '-' }}</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Business Type
                            </h5>
                            <span>{{ optional(optional($application->kiosk)->businessType)->name ?? '-' }}</span>
                        </div>

                        <div class="mb-4">
                            <h5 class="font-medium text-gray-700">
                                Business Period
                            </h5>
                            <span>
                                {{ optional($application->start_date)->format('j F Y') ?? '-' }}
                                -
                                {{ optional($application->end_date)->format('j F Y') ?? '-' }}
                            </span>
                        </div>

                    </div>


                </div>

                <div class="mt-10">

                    <a href="{{ route('applications.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                </div>

            </x-partials.card>

        </div>
    </div>

</x-app-layout>
