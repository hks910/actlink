@extends('layouts.admin.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif
                @if(\Session::has('success_delete'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success_delete') !!}</p>
                    </div>
                @endif

                <h5 class="card-title mb-4">{{ __('admin.events') }}</h5>

                <!-- Language Switcher -->
                <div class="d-flex flex-row-reverse">
                    <div class="dropdown">
                        <a 
                            href="#" 
                            class="d-flex align-items-center text-decoration-none dropdown-toggle" 
                            id="localeDropdown" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                        >
                            <i class="bi bi-globe me-3"></i>
                            <span class="text-dark" style="font-weight: 500;">
                                {{ app()->getLocale() == 'en' ? __('admin.english') : __('admin.indonesia') }}
                            </span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="localeDropdown">
                            <li>
                                <a 
                                    class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" 
                                    href="{{ route('set-locale', 'en') }}"
                                >
                                    {{ __('admin.english') }}
                                </a>
                            </li>
                            <li>
                                <a 
                                    class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}" 
                                    href="{{ route('set-locale', 'id') }}"
                                >
                                    {{ __('admin.indonesia') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Filter By Date -->
                <form method="GET" action="{{ route('admin.events') }}" class="mb-4">
                    <div class="row align-items-center">
                        <!-- Label -->
                        <div class="col-auto">
                            <label for="filter" class="col-form-label">{{ __('admin.filter_events') }}:</label>
                        </div>
                        <!-- Dropdown -->
                        <div class="col-auto">
                            <select name="filter" id="filter" class="form-control">
                                <option value="">{{ __('admin.select_filter') }}</option>
                                <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>{{ __('admin.past') }}</option>
                                <option value="current" {{ request('filter') == 'current' ? 'selected' : '' }}>{{ __('admin.current') }}</option>
                                <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>{{ __('admin.upcoming') }}</option>
                            </select>
                        </div>
                        <!-- Button -->
                        <div class="col-auto">
                            <button type="submit" class="btn btn-info">{{ __('admin.filter') }}</button>
                        </div>
                    </div>
                </form>

                <!-- Create Event Button -->
                <a href="{{ route('admin.createEvent') }}" class="btn btn-primary mb-4">{{ __('admin.create_new_event') }}</a>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.type') }}</th>
                            <th>{{ __('admin.organizer') }}</th>
                            <th>{{ __('admin.date') }}</th>
                            <th>{{ __('admin.location') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->eventId }}</td>
                                <td>{{ $event->eventName }}</td>
                                {{-- <td>{{ $event->eventType }}</td> --}}
                                <td>{{ __('admin.' . strtolower($event->eventType)) }}</td>
                                <td>{{ $event->organizer->user->userName }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}</td>
                                <td>{{ $event->eventLocation }}</td>
                                <td>
                                    @if($event->eventDate < \Carbon\Carbon::now()->toDateString())
                                    <!-- For Past Events -->
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('{{ __('admin.are_you_sure') }}')">{{ __('admin.delete') }}</a>
                                @elseif($event->eventDate >= \Carbon\Carbon::now()->toDateString() && $event->eventDate <= \Carbon\Carbon::now()->addDays(2)->toDateString())
                                    <!-- For Current Events -->
                                    <a class="text-muted">{{ __('admin.on_progress') }}</a>
                                @else
                                    <!-- For Upcoming Events -->
                                    <a href="{{ route('admin.editEvent', $event->eventId) }}" class="btn btn-warning">{{ __('admin.edit') }}</a>
                                    <a href="{{ route('admin.deleteEvent', $event->eventId) }}" class="btn btn-danger" onclick="return confirm('{{ __('admin.are_you_sure') }}')">{{ __('admin.delete') }}</a>
                                @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
