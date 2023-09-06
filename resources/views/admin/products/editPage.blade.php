@extends('admin.layout.master')

@section('title', 'Product Edit Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                        <h3 class="text-center title-2 fw-bold"> Edit Your Product</h3>
                                    </div>

                                    <hr>

                                    <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <input type="hidden" name="productId" value="{{$pizza->id}}">
                                                <img src="{{ asset('storage/'.$pizza->image) }}" class=" img-thumbnail shadow-sm" alt="">

                                                <div class="">
                                                    <input type="file" name="productImage" id="" class="form-control rounded mt-3 @error('productImage') is-invalid @enderror">
                                                    @error('productImage')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit">Update <i class="fa-solid fa-circle-up ms-1"></i> </button>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="productName" type="text" value=" {{ old('productName',$pizza->name) }}" class="form-control @error('productName') is-invalid @enderror" placeholder="Enter Product Name">
                                                    @error('productName')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                    <select name="productCategory" class=" form-control @error('productCategory') is-invalid @enderror" id="">
                                                        <option value="Choose category" class=" bg-secondary text-white" disabled>Choose Category</option>
                                                        @foreach ( $categories as $c )
                                                            <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('productCategory')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" placeholder="Enter Product Description" cols="30" rows="10">{{ old('productDescription',$pizza->description) }}</textarea>
                                                    @error('productDescription')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="productPrice" type="number" value="{{ old('productPrice',$pizza->price) }}" class="form-control @error('productPrice') is-invalid @enderror" placeholder="Enter Price">
                                                    @error('productPrice')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Waiting Time</label>
                                                    <input id="cc-pament" name="productWaitingTime" type="number" value="{{ old('productWaitingTime',$pizza->waiting_time) }}" class="form-control @error('productWaitingTime') is-invalid @enderror">
                                                    @error('productWaitingTime')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">View Count</label>
                                                    <input id="cc-pament" name="viewCount" type="number" value="{{ old('viewCount',$pizza->view_count) }}" class="form-control" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Created at</label>
                                                    <input id="cc-pament" name="created_at" type="text" value="{{ $pizza->created_at->format('j-F-Y') }}" value="{{ old('created_at') }}" class="form-control" disabled>
                                                </div>
                                            </div>
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
