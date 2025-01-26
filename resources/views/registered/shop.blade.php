@extends('layouts.navbar.navbar')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <section class="page-header py-5 text-center text-white">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">🛒 {{ __('shop.header.title') }}</h1>
            <p class="lead animate__animated animate__fadeInUp">{{ __('shop.header.description') }}</p>
            @guest
                <p class="text-warning fw-bold mt-3 animate__animated animate__fadeInUp">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ __('shop.header.login_prompt') }}
                </p>
            @endguest
            @auth
                <p class="fw-bold mt-3 animate__animated animate__fadeInUp" style="color: #ffdd57;">
                    <i class="bi bi-wallet-fill"></i> {{ __('shop.header.points', ['points' => auth()->user()->member->memberPoints]) }}
                </p>
            @endauth
        </div>
    </section>

    <!-- Shop Items Section -->
    <section class="shop-items py-5">
        <div class="container">
            @if($items->isEmpty())
                <div class="alert alert-warning text-center animate__animated animate__bounceIn">
                    <h4>{{ __('shop.shop.no_items') }}</h4>
                </div>
            @else
                <div class="row g-4 animate__animated animate__fadeInUp">
                    @foreach($items as $item)
                        <!-- Item Card -->
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-img-top-container">
                                <img 
                                    src="{{ $item->image ? 'data:image/png;base64,' . $item->image : asset('images/placeholder.png') }}" 
                                    class="card-img-top" 
                                    alt="{{ $item->name }}"
                                >
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">{{ $item->name }}</h5>
                                    <p class="card-text text-secondary">{{ $item->description }}</p>
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <span class="text-success fw-bold">
                                            <i class="bi bi-tag-fill text-warning"></i> {{ $item->price }} {{ __('shop.shop.price_label') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 text-center">
                                    @auth
                                    <form action="{{ route('shop.claim', $item->itemId) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg w-100">
                                            {{ __('shop.shop.claim_button') }}
                                        </button>
                                    </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm fw-bold" disabled>
                                            {{ __('shop.shop.claim_disabled') }}
                                        </button>
                                    @endauth
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
            background: #28a745;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            padding-top: 100%; /* Ensures a square aspect ratio */
            overflow: hidden;
            background-color: #f8f9fa; /* Light gray background for loading images */
        }

        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain; /* Ensures the entire image fits within the square */
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .card-footer button {
            padding: 8px 15px;
            font-size: 0.9rem;
            transition: background-color 0.2s ease;
        }

        .card-footer button:disabled {
            background-color: #6c757d; /* Gray for disabled button */
            cursor: not-allowed;
        }

        .card-footer button:hover:disabled {
            background-color: #6c757d;
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