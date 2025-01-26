@extends('layouts.navbar.navbar')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white bg-success shadow-sm">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">
                🛒 {{ __('organizer.Recently-Created-Products') }}
            </h1>
            <p class="lead animate__animated animate__fadeInUp">
                {{ __('organizer.Manage-Product') }}
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section py-5">
        <div class="container">
            <!-- Create Product Button -->
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('organizer.create-product') }}" class="btn btn-success btn-lg shadow-sm">
                    <i class="bi bi-plus-circle"></i> {{ __('organizer.Create-Product') }}
                </a>
            </div>

            @if($products->isEmpty())
                <div class="alert alert-warning text-center animate__animated animate__bounceIn">
                    <h4>{{ __('organizer.No-Participants') }}</h4>
                </div>
            @else
                <div class="row g-4 animate__animated animate__fadeInUp">
                    @foreach($products as $product)
                        <!-- Product Card -->
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-img-top-container">
                                    <img 
                                        src="{{ $product->image ? 'data:image/png;base64,' . $product->image : asset('images/placeholder.png') }}" 
                                        class="card-img-top" 
                                        alt="{{ $product->name }}"
                                    >
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                    <p class="card-text text-secondary">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-success fw-bold">
                                            <i class="bi bi-tag-fill text-warning"></i> 
                                            {{ $product->price }} {{ __('organizer.Points') }}
                                        </span>
                                        <span class="badge bg-info text-dark">
                                            {{ __('organizer.Quantity:') }} {{ $product->quantity }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <style>
        .page-header {
            background-color: #28a745;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top-container {
            position: relative;
            width: 100%;
            padding-top: 100%;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 1rem;
            }
        }
    </style>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@endsection
