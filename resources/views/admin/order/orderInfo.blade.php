@extends('admin.layout.master')

@section('title', 'Product List Page')

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

                    <a href="{{ route('order#list') }}"><button class=" btn btn-dark text-white"><i class="fa-solid fa-arrow-left"></i></button></a>
                    <div class="col-5">
                        <div class="card mt-5 rounded">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-file me-2"></i>Order Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-coins me-2"></i>Total Amount</div>
                                    <div class="col">{{ $order->total_price}}_MMK</div>
                                </div>
                                <div class="row">
                                    <div class="col"><i class="fa-regular fa-calendar me-2"></i>Order Date</div>
                                    <div class="col">{{ $orderList[0]->created_at->format('F-j-Y')}}</div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h5 class=" text-warning"><i class="fa-solid fa-circle-dot me-2"></i>Already included delivery charges.</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o )
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td> {{ $o->id }} </td>
                                    <td class=" col-2">
                                        <img src="{{ asset('storage/'.$o->product_image) }}" class=" img-thumbnail shadow-sm">
                                    </td>
                                    <td> {{ $o->product_name }}</td>
                                    <td> {{ $o->qty }}</td>
                                    <td> {{ $o->total }}</td>
                                    <td> {{ $o->created_at->format('F-j-Y') }} </td>
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
