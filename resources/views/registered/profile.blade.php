@extends('layouts.navbar.navbar')

@section('content')
    <!-- Profile Header -->
    <section class="profile-header py-5 text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">🎭 {{ __('Hello, :userName!', ['userName' => $user->userName]) }}</h1>
            <p class="lead">{{ __('Welcome to your profile dashboard.') }}</p>
        </div>
    </section>

    <!-- Profile Details -->
    <section class="profile-details py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow-lg border-0">
                        <!-- Profile Image and Info -->
                        <div class="profile-header text-center bg-light py-5">
                            @if($user->userImage)
                                <img src="data:image/png;base64,{{ $user->userImage }}" 
                                     alt="Profile Image" 
                                     class="rounded-circle border border-3 border-success shadow-sm" 
                                     width="150" height="150">
                            @else
                                <img src="https://via.placeholder.com/150" 
                                     alt="Default Profile Image" 
                                     class="rounded-circle border border-3 border-success shadow-sm" 
                                     width="150" height="150">
                            @endif
                            <h2 class="mt-3 fw-bold">{{ $user->userName }}</h2>
                            <p class="text-muted">{{ ucfirst($user->userType) }}</p>
                        </div>

                        <!-- Profile Information -->
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="text-success"><i class="bi bi-info-circle"></i> {{ __('Profile Information') }}</h5>
                                <ul class="list-unstyled">
                                    <li><strong>{{ __('Email:') }}</strong> {{ $user->userEmail }}</li>
                                    <li><strong>{{ __('Phone:') }}</strong> {{ $user->userPhoneNumber ?? __('Not Provided') }}</li>
                                </ul>
                            </div>

                            <!-- Member Details -->
                            @if($member)
                                <div class="mb-4">
                                    <h5 class="text-primary"><i class="bi bi-award"></i> {{ __('Membership Details') }}</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>{{ __('Date of Birth:') }}</strong> {{ $member->memberDOB }}</li>
                                        <li><strong>{{ __('Points:') }}</strong> 
                                            <span class="badge bg-success fs-6">{{ $member->memberPoints }} XP</span>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            <!-- Organizer Details -->
                            @if($organizer)
                                <div class="mb-4">
                                    <h5 class="text-warning"><i class="bi bi-briefcase"></i> {{ __('Organizer Details') }}</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>{{ __('Address:') }}</strong> {{ $organizer->organizerAddress }}</li>
                                        <li><strong>{{ __('Social Media:') }}</strong> 
                                            <a href="{{ $organizer->officialSocialMedia }}" target="_blank" class="text-primary">
                                                {{ $organizer->officialSocialMedia }}
                                            </a>
                                        </li>
                                        <li><strong>{{ __('Status:') }}</strong> 
                                            @if($organizer->activeFlag)
                                                <span class="badge bg-success">{{ __('Active') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="card-footer bg-light text-center py-4">
                            <a href="{{ route('member.profile.edit', ['userId' => $user->userId]) }}" class="btn btn-success btn-lg">
                                <i class="bi bi-pencil-square"></i> {{ __('Edit Profile') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        /* Header Section */
        .profile-header {
            background: linear-gradient(135deg, #38c172, #1f9d55);
            color: white;
            padding: 60px 0;
            border-bottom: 5px solid #155724;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Profile Card */
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .profile-header img {
            transition: transform 0.3s ease;
        }

        .profile-header img:hover {
            transform: scale(1.1);
        }

        .card-body ul {
            padding-left: 0;
        }

        .card-body ul li {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn-success {
            font-size: 18px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #1f9d55;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
    </style>
@endsection
