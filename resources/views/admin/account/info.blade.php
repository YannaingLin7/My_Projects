@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row col-3 offset-7 mb-2">
            @if (session('updateSuccess'))
                        <div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('updateSuccess') }} <i class="fa-solid fa-octagon-minus"></i>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
            @endif
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2 fw-bold">Account Info</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        {{-- for image --}}
                                        <div class="col-3 offset-1">
                                            <div class="image">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('images/default-user.jpg') }}" class="shadow rounded"
                                                        alt="default-user img">
                                                @else
                                                    <img src="{{ asset('storage/'.Auth::user()->image) }}"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>
                                        {{-- for details --}}
                                        <div class="col-7">
                                            <div class=" p-2">
                                                <h4 class="mb-3"> <i class="fa-solid fa-user me-2"></i> {{ Auth::user()->name }} </h4>
                                                <h4 class="mb-3"> <i class="fa-solid fa-envelope me-2"></i> {{ Auth::user()->email }}</h4>
                                                <h4 class="mb-3"> <i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}</h4>
                                                <h4 class="mb-3"> <i class="fa-solid fa-map-location-dot me-2"></i> {{ Auth::user()->address }}</h4>
                                                <h4 class="mb-3"> <i class="fa-solid fa-venus-mars me-2"></i> {{ Auth::user()->gender}}</h4>
                                                <h4 class="mb-3"> <i class="fa-solid fa-user-clock me-2"></i> {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-3 offset-1">
                                            <a href="{{ route('admin#editProfile') }}">
                                                <button class=" col-12 btn btn-dark text-white rounded-2 me-4 "> <i class="fa-solid fa-user-pen me-2"></i> Edit Your Profile </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
