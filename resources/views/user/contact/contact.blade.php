@extends('user.layouts.master')
@section('contents')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-2">
                            <div class="card w-75">
                                <div class="card-header bg-warning">
                                        <h3 class="text-center title-2 fw-bold rounded">Contact Us</h3>
                                </div>
                                <div class="card-body">
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
                                                    <input id="cc-pament" name="phone" type="number" value=" {{ Auth::user()->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number">
                                                    @error('phone')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="h5 control-label mb-1">Message</label>
                                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address" cols="30" rows="8"> </textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer bg-warning">
                                    <button class="btn btn-dark text-white float-right">Send Message</button>
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

