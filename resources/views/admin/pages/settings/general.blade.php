@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('settings.index') }}">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                                </ol>
                            </nav>
                            <h4 class="card-title mb-0">General Settings</h4>
                        </div>
                        <a href="{{ route('settings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Settings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.general.update') }}" method="POST">
                        @csrf

                        <!-- Site Information -->
                        <div class="mb-4">
                            <h5 class="mb-3">
                                <i class="fas fa-globe me-2"></i>Site Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="site_title" class="form-label required">Site Title</label>
                                        <input type="text" class="form-control @error('site_title') is-invalid @enderror"
                                               id="site_title" name="site_title"
                                               value="{{ old('site_title', $settings['site_title']->value ?? '') }}" required>
                                        @error('site_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="site_tagline" class="form-label">Site Tagline</label>
                                        <input type="text" class="form-control @error('site_tagline') is-invalid @enderror"
                                               id="site_tagline" name="site_tagline"
                                               value="{{ old('site_tagline', $settings['site_tagline']->value ?? '') }}">
                                        @error('site_tagline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="store_url" class="form-label">Store URL</label>
                                <input type="url" class="form-control @error('store_url') is-invalid @enderror"
                                       id="store_url" name="store_url"
                                       value="{{ old('store_url', $settings['store_url']->value ?? '') }}"
                                       placeholder="https://yourstore.com">
                                @error('store_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <h5 class="mb-3">
                                <i class="fas fa-address-book me-2"></i>Contact Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_email" class="form-label">Contact Email</label>
                                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                               id="contact_email" name="contact_email"
                                               value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}">
                                        @error('contact_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_phone" class="form-label">Contact Phone</label>
                                        <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror"
                                               id="contact_phone" name="contact_phone"
                                               value="{{ old('contact_phone', $settings['contact_phone']->value ?? '') }}">
                                        @error('contact_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="mb-4">
                            <h5 class="mb-3">
                                <i class="fas fa-share-alt me-2"></i>Social Media Links
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="facebook_url" class="form-label">
                                            <i class="fab fa-facebook me-1"></i>Facebook URL
                                        </label>
                                        <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                               id="facebook_url" name="facebook_url"
                                               value="{{ old('facebook_url', $settings['facebook_url']->value ?? '') }}">
                                        @error('facebook_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="twitter_url" class="form-label">
                                            <i class="fab fa-twitter me-1"></i>Twitter URL
                                        </label>
                                        <input type="url" class="form-control @error('twitter_url') is-invalid @enderror"
                                               id="twitter_url" name="twitter_url"
                                               value="{{ old('twitter_url', $settings['twitter_url']->value ?? '') }}">
                                        @error('twitter_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="instagram_url" class="form-label">
                                            <i class="fab fa-instagram me-1"></i>Instagram URL
                                        </label>
                                        <input type="url" class="form-control @error('instagram_url') is-invalid @enderror"
                                               id="instagram_url" name="instagram_url"
                                               value="{{ old('instagram_url', $settings['instagram_url']->value ?? '') }}">
                                        @error('instagram_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="linkedin_url" class="form-label">
                                            <i class="fab fa-linkedin me-1"></i>LinkedIn URL
                                        </label>
                                        <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror"
                                               id="linkedin_url" name="linkedin_url"
                                               value="{{ old('linkedin_url', $settings['linkedin_url']->value ?? '') }}">
                                        @error('linkedin_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="youtube_url" class="form-label">
                                    <i class="fab fa-youtube me-1"></i>YouTube URL
                                </label>
                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror"
                                       id="youtube_url" name="youtube_url"
                                       value="{{ old('youtube_url', $settings['youtube_url']->value ?? '') }}">
                                @error('youtube_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-goglary">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                            <a href="{{ route('settings.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
