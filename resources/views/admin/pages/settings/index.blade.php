@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Settings Management</h4>
                </div>
                <div class="card-body">
                    <!-- Settings Navigation -->
                    <div class="settings-navigation">
                        <div class="row g-4 justify-content-center">
                            <!-- General Settings -->
                            <div class="col-md-6 col-lg-4 d-flex">
                                <a href="{{ route('settings.general') }}" class="settings-card-link w-100">
                                    <div class="settings-card w-100">
                                        <div class="settings-card-icon">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <div class="settings-card-content">
                                            <h5 class="settings-card-title">General Settings</h5>
                                            <p class="settings-card-description">Manage site title, tagline, contact info, and social media links</p>
                                        </div>
                                        <div class="settings-card-arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- FAQs Management -->
                            <div class="col-md-6 col-lg-4 d-flex">
                                <a href="{{ route('settings.faqs') }}" class="settings-card-link w-100">
                                    <div class="settings-card w-100">
                                        <div class="settings-card-icon">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <div class="settings-card-content">
                                            <h5 class="settings-card-title">FAQs Management</h5>
                                            <p class="settings-card-description">Add, edit, and manage frequently asked questions</p>
                                        </div>
                                        <div class="settings-card-arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Roles & Permissions -->
                            <div class="col-md-6 col-lg-4 d-flex">
                                <a href="{{ route('settings.roles') }}" class="settings-card-link w-100">
                                    <div class="settings-card w-100">
                                        <div class="settings-card-icon">
                                            <i class="fas fa-user-shield"></i>
                                        </div>
                                        <div class="settings-card-content">
                                            <h5 class="settings-card-title">Roles & Permissions</h5>
                                            <p class="settings-card-description">Manage user roles and their permissions</p>
                                        </div>
                                        <div class="settings-card-arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Groups Overview -->
                    @if($settings->count() > 0)
                    <div class="mt-5">
                        <h5 class="mb-4">Settings Overview</h5>
                        <div class="row">
                            @foreach($settings as $group)
                                <div class="col-md-6 col-lg-3 mb-3">
                                    <div class="settings-overview-card">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-capitalize">{{ $group }}</h6>
                                                <small class="text-muted">
                                                    {{ \App\Models\Setting::where('group', $group)->count() }} settings
                                                </small>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-cogs text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.settings-navigation {
    margin-bottom: 2rem;
}

.settings-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: all 0.3s ease;
}

.settings-card-link:hover {
    text-decoration: none;
    color: inherit;
}

.settings-card {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 24px;
    height: 100%;
    min-height: 140px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.settings-card-link:hover .settings-card {
    border-color: #59ab6e;
    box-shadow: 0 8px 25px rgba(89, 171, 110, 0.15);
    transform: translateY(-4px);
}

.settings-card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.settings-card-content {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.settings-card-title {
    font-size: 18px;
    font-weight: 600;
    color: #212934;
    margin-bottom: 8px;
}

.settings-card-description {
    font-size: 14px;
    color: #6c757d;
    margin: 0;
    line-height: 1.4;
}

.settings-card-arrow {
    color: #adb5bd;
    font-size: 16px;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.settings-card-link:hover .settings-card-arrow {
    color: #59ab6e;
    transform: translateX(4px);
}

.settings-overview-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 16px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.settings-overview-card:hover {
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .settings-card {
        padding: 20px;
        gap: 12px;
    }

    .settings-card-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    .settings-card-title {
        font-size: 16px;
    }

    .settings-card-description {
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .settings-card {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }

    .settings-card-arrow {
        position: absolute;
        top: 16px;
        right: 16px;
    }
}
</style>
@endpush
@endsection
