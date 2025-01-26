@extends('layouts.navbar.navbar')

@section('content')
<section class="edit-profile py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center py-4">
                        <h2 class="mb-0">{{ __('Edit Profile') }}</h2>
                        <p class="small mt-2">{{ __('Update your personal information and preferences.') }}</p>
                    </div>
                    <div class="card-body p-4">
                        <!-- Back Button -->
                        <div class="mb-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>{{ __('Back') }}
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif
                        
                        <form action="{{ route('member.profile.update', ['userId' => $user->userId]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->userName) }}" placeholder="{{ __('Enter your full name') }}" required>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-4">
                                <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->userEmail) }}" placeholder="{{ __('Enter your email address') }}" required>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group mb-4">
                                <label for="phoneNumber" class="form-label fw-bold">{{ __('Phone Number') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $user->userPhoneNumber) }}" placeholder="{{ __('e.g., +123456789') }}">
                                </div>
                            </div>

                            <!-- Birthdate -->
                            <div class="form-group mb-4">
                                <label for="birthdate" class="form-label fw-bold">{{ __('Birthdate') }}</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" value="{{ old('userBirthdate', $user->member->memberDOB) }}">
                            </div>

                            <!-- Profile Picture -->
                            <div class="form-group mb-4">
                                <label for="userImage" class="form-label fw-bold">{{ __('Profile Picture') }}</label>
                                <div class="d-flex align-items-center mb-3">
                                    @if($user->userImage)
                                        <img src="data:image/png;base64,{{ $user->userImage }}" 
                                             alt="Current Profile Picture" 
                                             class="rounded-circle shadow-sm me-3" 
                                             width="80" height="80">
                                    @else
                                        <img src="https://via.placeholder.com/80" 
                                             alt="Default Profile Picture" 
                                             class="rounded-circle shadow-sm me-3" 
                                             width="80" height="80">
                                    @endif
                                    <div>
                                        <small class="text-muted d-block">{{ __('Current Picture') }}</small>
                                        <small>{{ __('Upload a new one if you wish to change.') }}</small>
                                    </div>
                                </div>
                                <input type="file" id="userImage" name="userImage" class="form-control">
                                <small class="text-muted">{{ __('Max size: 2MB | Formats: JPG, PNG') }}</small>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-save me-2"></i>{{ __('Save Changes') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
