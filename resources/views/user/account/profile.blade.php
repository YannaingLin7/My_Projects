@extends('user.layouts.master')
@section('contents')
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
                                        <h3 class="text-center title-2 fw-bold text-white bg-dark rounded">Your Profile</h3>
                                    </div>

                                    <hr>
                                    @if (session('updateSuccess'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('updateSuccess') }} <i class="fa-solid fa-check"></i>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('user#editProfile',Auth::user()->{'id'}) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-5">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('images/default-user.jpg') }}" class="rounded img-thumbnail shadow-sm" alt="default-user img">
                                                @else
                                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded img-thumbnail shadow-sm" alt="">
                                                @endif

                                                <div class="">
                                                    <input type="file" name="image" id="" class="form-control rounded mt-3 @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit">Update <i class="fa-solid fa-circle-up ms-1"></i> </button>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="name" type="text" value=" {{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Admin Name">
                                                    @error('name')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Email</label>
                                                    <input id="cc-pament" name="email" type="email" value=" {{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Admin Email">
                                                    @error('email')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone" type="number" value=" {{ old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Admin Phone">
                                                    @error('phone')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Gender</label>
                                                    <select name="gender" class=" form-control @error('gender') is-invalid @enderror" id="">
                                                        <option value="">Choose your gender...</option>
                                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Address</label>
                                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address" cols="30" rows="10">{{ old('address',Auth::user()->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Role</label>
                                                    <input id="cc-pament" name="role" type="text" value=" {{ old('role',Auth::user()->role) }}" value="{{ old('categoryName') }}" class="form-control" disabled>
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
