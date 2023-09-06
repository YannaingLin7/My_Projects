@extends('admin.layout.master')

@section('title', 'Product Create Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('product#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                        <h3 class="text-center title-2">Create Your Product</h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('product#create') }}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="productName" type="text" value="{{ old('productName') }}" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Product Name...">
                                                @error('productName')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select class=" form-control @error('productCategory') is-invalid @enderror" name="productCategory" id="">
                                                <option value="">Choose Your Category</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                                @error('productCategory')
                                                    <div class=" invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter Description..."> {{ old('productDescription') }}</textarea>
                                            @error('productDescription')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Image</label>
                                            <input type="file" class=" form-control @error('productImage') is-invalid @enderror" name="productImage" id="">
                                            @error('productImage')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="productWaitingTime" type="number" class="form-control @error('productWaitingTime') is-invalid @enderror" value="{{ old('productWaitingTime') }}" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                            @error('productWaitingTime')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="productPrice" type="number" class="form-control @error('productPrice') is-invalid @enderror" value="{{ old('productPrice') }}" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                            @error('productPrice')
                                                <div class=" invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
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
