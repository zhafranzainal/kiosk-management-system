<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.applications.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-partials.card>

                <div class="mb-5 mt-4">

                    <div class="flex flex-wrap justify-between">

                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">

                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off">
                                    </x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Application::class)
                                <a href="{{ route('applications.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>

                    </div>

                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">

                        <thead class="text-gray-700">
                            <tr>

                                <th class="px-4 py-3 text-left">
                                    No.
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Applied Date and Time
                                </th>

                                <th class="px-4 py-3 text-left">
                                    @lang('crud.applications.inputs.user_id')
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Kiosk Number
                                </th>

                                <th class="px-4 py-3 text-left">
                                    @lang('crud.applications.inputs.kiosk_id')
                                </th>

                                <th class="px-4 py-3 text-left">
                                    @lang('crud.business_types.inputs.name')
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Business Period
                                </th>

                                <th class="px-4 py-3 text-left">
                                    @lang('crud.applications.inputs.status')
                                </th>

                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody class="text-gray-600">

                            @forelse($applications as $application)
                                <tr class="hover:bg-gray-50">

                                    <td class="px-4 py-3 text-left">
                                        {{ $application->id }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ \Carbon\Carbon::parse($application->created_at)->isoFormat('D MMMM YYYY HH:mm') }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ optional($application->user)->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        FKK{{ str_pad(optional($application->kiosk)->id, 2, '0', STR_PAD_LEFT) }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ optional($application->kiosk)->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ optional(optional($application->kiosk)->businessType)->name ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-left">
                                        {{ optional($application->start_date)->format('j F Y') ?? '-' }}
                                        -
                                        {{ optional($application->end_date)->format('j F Y') ?? '-' }}
                                    </td>


                                    <td class="px-4 py-3 text-left">
                                        {{ $application->status ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="relative inline-flex align-middle">

                                            @can('update', $application)
                                                <a href="{{ route('applications.edit', $application) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('view', $application)
                                                <a href="{{ route('applications.show', $application) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('delete', $application)
                                                <form action="{{ route('applications.destroy', $application) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">

                                                    @csrf @method('DELETE')

                                                    <button type="submit" class="button">
                                                        <i class=" icon ion-md-trash text-red-600"></i>
                                                    </button>

                                                </form>
                                            @endcan

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="mt-10 px-4">
                                        {!! $applications->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </x-partials.card>

        </div>
    </div>

</x-app-layout>
