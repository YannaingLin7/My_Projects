@extends('admin.layout.master')

@section('title', 'User List Page')

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
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                        <h3> Total User - {{$users->total()}}</h3>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone No</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $u)
                                    <tr>
                                        <td class="col-2">
                                            @if ($u->image == null)
                                                <img src="{{ asset('images/default-user.jpg') }}" class="shadow rounded"
                                                    alt="default-user img">
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" alt="">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value="{{ $u->id }}">
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>
                                            <select name="" class=" form-control changeStatus">
                                                <option value="user" @if($u->role=='user') selected @endif >User</option>
                                                <option value="admin" @if($u->role=='admin') selected @endif >Admin</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{$users->links()}}
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
            // changing order status
            $('.changeStatus').change(function (){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'role' : $currentStatus,
                    'userId' : $userId
                };

                console.log($data);
                $.ajax({
                    type : 'get',
                    url : '/user/change/role',
                    data : $data,
                    dataType : 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection
