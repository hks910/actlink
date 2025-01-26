@extends('layouts.navbar.navbar')
@section('content')
<div id="app">
    <div class="container">
        <!-- Page Title -->
        <h1 class="page-title text-center mt-5">@lang('organizer.Recently-Created-Events')</h1>

        <!-- Search and Filter Section -->
        <section class="search-filter py-4 bg-light">
            <div class="container">
                <form method="GET" action="{{ route('organizer.home') }}" class="d-flex justify-content-between align-items-center">
                    <!-- Search Input -->
                    <div class="d-flex w-50 align-items-center">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control me-2" 
                            placeholder="@lang('Search events...')" 
                            value="{{ request()->get('search') }}"
                        >
                        <button 
                            type="submit" 
                            class="btn btn-success d-flex justify-content-center align-items-center p-0" 
                            style="width: 40px; height: 40px;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Category Filter -->
                    <div class="filter-group ms-3">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">@lang('All Categories')</option>
                            <option value="Environment" {{ request()->get('category') == 'Environment' ? 'selected' : '' }}>@lang('Environment')</option>
                            <option value="Healthcare" {{ request()->get('category') == 'Healthcare' ? 'selected' : '' }}>@lang('Healthcare')</option>
                            <option value="Social" {{ request()->get('category') == 'Social' ? 'selected' : '' }}>@lang('Social')</option>
                        </select>
                    </div>
                </form>
            </div>
        </section>

        <!-- Events Section -->
        <section class="latest-events py-5">
            <div class="container text-center">
                <div class="row">
                    @forelse($events as $event)
                    <div class="col-md-4">
                        <div class="event-card p-4 mb-4">
                            <!-- Event Image -->
                            <img src="data:image/png;base64,{{ $event->eventImage }}" alt="Event Image" class="event-image img-fluid mb-3">
                            
                            <!-- Event Details -->
                            <h5 class="event-title">{{ $event->eventName }}</h5>
                            <p class="event-date">
                                <i class="bi bi-calendar3"></i> 
                                {{ \Carbon\Carbon::parse($event->eventDate)->format('d M, Y') }}
                            </p>
                            <p class="event-location">
                                <i class="bi bi-geo-alt"></i> 
                                {{ $event->eventLocation }}
                            </p>
                            <p class="event-description text-muted">
                                {{ str($event->eventDescription)->limit(100) }}
                            </p>
                            <p class="event-organizer">
                                @lang('organizer.Organized-by'): <strong>{{ $event->organizer->user->userName }}</strong>
                            </p>
                            
                            <!-- Details Button -->
                            <a href="{{ route('event.detail', ['id' => $event->eventId, 'from' => 'events']) }}" class="btn btn-success w-100">
                                @lang('View Details')
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">@lang('No events found')</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    /* Page Title */
    .page-title {
        font-family: 'Roboto', sans-serif;
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    /* Search & Filter Section */
    .search-filter {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 1.5rem;
        background-color: white;
    }

    .search-filter .form-control, .search-filter .form-select {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Event Cards */
    .event-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 380px; /* Set a minimum height */
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .event-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 0.5rem;
    }

    .event-date, .event-location, .event-description {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .event-organizer {
        font-size: 1rem;
        color: #343a40;
        font-weight: 500;
        margin-top: auto; /* Push to the bottom */
    }

    /* Image Styling */
    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    /* Pagination Styling */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #28a745;
        color: white;
        border-color: #218838;
    }

    .pagination .page-item.active .page-link {
        background-color: #28a745;
        color: white;
        border-color: #28a745;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .event-card {
            margin-bottom: 20px;
        }

        .search-filter {
            padding: 15px;
        }
    }
</style>
@endsection
