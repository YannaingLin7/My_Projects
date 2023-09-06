@extends('admin.layout.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    {{-- Category CRUD Message --}}
                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('createSuccess') }} <i class="fa-solid fa-check"></i>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('deleteSuccess') }} <i class="fa-solid fa-octagon-minus"></i>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- Category CRUD Message --}}

                    {{-- Search bar --}}
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Results related with : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                    <button class=" btn btn-dark text-white" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- End of Search bar --}}
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email </th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($admin as $a)
                                        <tr>
                                            <td class="col-2">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('images/default-user-male.jpg') }}" class="img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('images/default-user-female.png') }}" class="img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm">
                                                @endif
                                            </td>

                                            <td>{{$a->name}} <input type="hidden" name="" id="userId" value="{{$a->id}}"></td>
                                            <td>{{$a->email}} </td>
                                            <td>{{$a->gender}}</td>
                                            <td>{{$a->phone}}</td>
                                            <td>{{$a->address}}</td>
                                            <td>
                                                <select name="" class="form-control changeStatus" @if(Auth::user()->id == $a->id) disabled @endif>
                                                    <option value="user" @if($a->role == 'user') selected @endif >User</option>
                                                    <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class=" table-data-feature">
                                                    @if (Auth::user()->id == $a->id)

                                                    @else
                                                        <a href="{{ route('admin#delete',$a->id) }}" class=" mx-2">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-3">
                                {{ $admin->links() }}
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.changeStatus').change(function (){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'role' : $currentStatus,
                    'userId' : $userId
                };
                $.ajax({
                    type : 'get',
                    url : '/admin/change/role',
                    data : $data,
                    dataType : 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
