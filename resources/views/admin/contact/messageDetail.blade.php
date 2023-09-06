@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>What They Say</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-4">
                                <div class="mb-2">
                                    <label for="name"> Name</label>
                                    <input type="text" id="name" class="form-control" value="{{$message->name}}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="email"> Email</label>
                                    <input type="text" class="form-control" value="{{$message->email}}" disabled>
                                </div>
                            </div>
                            <div class=" col">
                                <textarea name="email" class=" form-control" id="" rows="10" disabled>{{$message->message}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('contact#message')}}"><button class=" btn btn-dark text-white">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
