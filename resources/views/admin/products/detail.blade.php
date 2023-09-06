@extends('admin.layout.master')

@section('title', 'Product Detail Page')

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

                                <div class=" card-header">
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                    <h3 class="text-center title-2 fw-bold">Product Details</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        {{-- for image --}}
                                        <div class="col-3 offset-1">
                                            <img src="{{ asset('storage/'.$pizzas->image)}}" class="img-thumbnail shadow-sm"alt="">
                                        </div>
                                        {{-- for details --}}
                                        <div class="col-7">
                                            <div class=" p-2">
                                                <div class="mb-3 btn bg-success text-white me-2 text-bold d-block w-32"> <i class="fa-regular fa-note-sticky me-2"></i> {{ $pizzas->name }} </div>

                                                <div class="ms-1 row">
                                                <span class=" col mb-3 btn bg-dark text-white me-2 text-bold"> <i class="fa-solid fa-coins me-2"></i> {{ $pizzas->price }} | MMK</span>
                                                <span class=" col mb-3 btn bg-dark text-white me-2 text-bold"> <i class="fa-solid fa-stopwatch-20 me-2"></i> {{$pizzas->waiting_time }} mins</span>
                                                <span class=" col mb-3 btn bg-dark text-white me-2 text-bold"> <i class="fa-solid fa-arrow-up-wide-short me-2"></i> {{ $pizzas->view_count }}</span>
                                                </div>
                                                <span class="mb-3 btn bg-dark text-white me-2 text-bold"> <i class="fa-regular fa-calendar-days me-2"></i> {{ $pizzas->created_at->format('j-F-Y') }}</span>
                                                <span class="mb-3 btn bg-dark text-white me-2 text-bold"> <i class="fa-solid fa-certificate me-2"></i> {{ $pizzas->category_name }}</span>
                                                <h4 class=""> <i class="fa-solid fa-circle-info me-2"></i> Description</h4>
                                                <div class=" mb-3"> {{ $pizzas->description }} </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-3 offset-1">
                                            <a href="{{ route('product#editPage',$pizzas->id) }}">
                                                <button class=" col-12 btn btn-dark text-white rounded-2 me-4 "> <i class="fa-solid fa-user-pen me-2"></i> Edit Your Product </button>
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
