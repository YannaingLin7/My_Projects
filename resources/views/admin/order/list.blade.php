@extends('admin.layout.master')

@section('title', 'Order List Page')

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
                                <h2 class="title-1">Order List</h2>
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

                    <div class="row mt-2">
                        <form action="{{ route('order#changeStatus') }}" method="GET" class="col-4">
                            @csrf
                            <div class="input-group mb-3">
                                <button class=" btn btn-dark disabled text-white input-group-text">
                                    <i class="fa-solid fa-folder-open"></i> - {{ count($order)}}
                                </button>
                                <select name="orderStatus" class="form-select" id="inputGroupSelect02">
                                    <option value="">All</option>
                                    <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-dark text-white input-group-text ms-3" for="inputGroupSelect02">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o )
                                <tr class="tr-shadow">
                                    <input type="hidden" class="orderId" value="{{ $o->id }}">
                                    <td class="col-2"> {{ $o->user_id }} </td>
                                    <td class="col-2"> {{ $o->user_name }}</td>
                                    <td class="col-2"> {{ $o->created_at->format('F-j-Y') }} </td>
                                    <td class="col-2">
                                        <a href="{{ route('admin#orderInfo',$o->order_code) }}"> {{ $o->order_code}} </a>
                                    </td>
                                    <td class="col-2"> {{ $o->total_price}} MMK</td>
                                    <td class="col-2">
                                        <select name="status" class=" form-control changeStatus">
                                            <option value="0" @if($o->status==0) selected @endif>Pending</option>
                                            <option value="1" @if($o->status==1) selected @endif>Accept</option>
                                            <option value="2" @if($o->status==2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
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
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type : 'get',
            //         url : 'http://localhost:8000/order/ajax/status',
            //         data : {
            //             'status' : $status,
            //         } ,
            //         dataType : 'json',
            //         success : function (response) {
            //             $list = '';
            //                 for ($i = 0; $i < response.length; $i++) {

            //                     $months = ['January' , 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            //                     $dbDate = new Date(response[$i].created_at);
            //                     $uiDate = $months[$dbDate.getMonth()] +"-"+ $dbDate.getDate()+"-"+ $dbDate.getFullYear();

            //                     if( response[$i].status == 0 ){
            //                         $statusMessage = `
            //                                             <select name="status" class=" form-control changeStatus">
            //                                                 <option value="0" selected>Pending</option>
            //                                                 <option value="1">Accept</option>
            //                                                 <option value="2">Reject</option>
            //                                             </select>`;
            //                     } else if ( response[$i].status == 1 ) {
            //                         $statusMessage = ` <select name="status" class=" form-control changeStatus">
            //                                             <option value="0">Pending</option>
            //                                             <option value="1" selected>Accept</option>
            //                                             <option value="2">Reject</option>
            //                                            </select> `;
            //                     } else if ( response[$i].status == 2) {
            //                         $statusMessage = ` <select name="status" class=" form-control changeStatus">
            //                                             <option value="0">Pending</option>
            //                                             <option value="1">Accept</option>
            //                                             <option value="2" selected>Reject</option>
            //                                            </select> `;
            //                     }

            //                     $list += `
            //                         <tr class="tr-shadow">
            //                             <input type="hidden" class="orderId" value="${response[$i].id}">
            //                             <td class="col-2"> ${response[$i].user_id}</td>
            //                             <td class="col-2"> ${response[$i].user_name }</td>
            //                             <td class="col-2"> ${$uiDate} </td>
            //                             <td class="col-2"> ${response[$i].order_code} </td>
            //                             <td class="col-2"> ${response[$i].total_price} MMK</td>
            //                             <td class="col-2"> ${$statusMessage}</td>
            //                         </tr>
            //                     `;
            //                 }
            //                 $('#dataList').html($list);
            //         }
            //     })
            // })


            // changing order status
            $('.changeStatus').change(function (){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus,
                    'orderId' : $orderId
                };

                console.log($data);
                $.ajax({
                    type : 'get',
                    url : '/order/ajax/change/status',
                    data : $data,
                    dataType : 'json',
                })
            })
        })
    </script>
@endsection
