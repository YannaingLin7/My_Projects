@extends('admin.layout.master')

@section('title', 'Category List Page')

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
                                        <a href="{{ route("admin#list") }}">
                                            <i class="fa-solid fa-arrow-left text-dark"></i>
                                        </a>
                                        <h3 class="text-center title-2 fw-bold">Change Account Role</h3>
                                    </div>

                                    <hr>

                                    <form action="{{ route('admin#change',$account->{'id'}) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if ($account->image == null)
                                                    <img src="{{ asset('images/default-user.jpg') }}" class="shadow rounded " alt="default-user img">
                                                @else
                                                    <img src="{{ asset('storage/'.$account->image) }}"alt="">
                                                @endif

                                                <div class="mt-3">
                                                    <button class="btn btn-dark text-white col-12" type="submit">Change <i class="fa-solid fa-circle-up ms-1"></i> </button>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" disabled name="name" type="text" value=" {{ old('name',$account->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Admin Name">
                                                    @error('name')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="role" id="" class=" form-control">
                                                        <option value="admin" @if($account->role == 'admin') selected @endif >Admin</option>
                                                        <option value="user"  @if($account->role == 'user') selected @endif >User</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" disabled name="email" type="email" value=" {{ old('email',$account->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Admin Email">
                                                    @error('email')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" disabled name="phone" type="number" value=" {{ old('phone',$account->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Admin Phone">
                                                    @error('phone')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" disabled class=" form-control @error('gender') is-invalid @enderror" id="">
                                                        <option value="">Choose your gender...</option>
                                                        <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                                        <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" placeholder="Enter Admin Address" cols="30" rows="10">{{ old('address',$account->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback"> {{ $message }} </div>
                                                    @enderror
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
