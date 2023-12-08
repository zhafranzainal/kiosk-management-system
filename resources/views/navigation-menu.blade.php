<x-nav-dropdown title="Manage Users" align="right" width="48">
    @can('view-any', App\Models\User::class)
        <x-dropdown-link href="{{ route('users.index') }}">
            All Users
        </x-dropdown-link>
    @endcan
    @can('view-any', App\Models\KioskParticipant::class)
        <x-dropdown-link href="{{ route('kiosk-participants.index') }}">
            Kiosk Participants
        </x-dropdown-link>
    @endcan
    @can('view-any', App\Models\Student::class)
        <x-dropdown-link href="{{ route('students.index') }}">
            Students
        </x-dropdown-link>
    @endcan
</x-nav-dropdown>

<li class="side-nav-item">
    <a href="{{ route('dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        {{ __('Dashboard') }}
    </a>
</li>

@can('view-any', App\Models\Kiosk::class)
    <li class="side-nav-item">
        <a href="{{ route('kiosks.index') }}" class="side-nav-link">
            <i class="dripicons-shopping-bag"></i>
            <span> Manage Kiosks </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Application::class)
    <li class="side-nav-item">
        <a href="{{ route('applications.index') }}" class="side-nav-link">
            <i class="dripicons-shopping-bag"></i>
            <span> Kiosk Applications </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Sale::class)
    <li class="side-nav-item">
        <a href="{{ route('sales.index') }}" class="side-nav-link">
            <i class="dripicons-tags"></i>
            <span> Kiosk Sales </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Transaction::class)
    <li class="side-nav-item">
        <a href="{{ route('transactions.index') }}" class="side-nav-link">
            <i class="uil-money-stack"></i>
            <span> Kiosk Payments </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Complaint::class)
    <li class="side-nav-item">
        <a href="{{ route('complaints.index') }}" class="side-nav-link">
            <i class="dripicons-document-edit"></i>
            <span> Kiosk Complaints </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Bank::class)
    <li class="side-nav-item">
        <a href="{{ route('banks.index') }}" class="side-nav-link">
            <i class="dripicons-document-edit"></i>
            <span> Banks</span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\BusinessType::class)
    <li class="side-nav-item">
        <a href="{{ route('business-types.index') }}" class="side-nav-link">
            <i class="dripicons-document-edit"></i>
            <span> Business Types </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Course::class)
    <li class="side-nav-item">
        <a href="{{ route('courses.index') }}" class="side-nav-link">
            <i class="dripicons-document-edit"></i>
            <span> Courses </span>
        </a>
    </li>
@endcan
