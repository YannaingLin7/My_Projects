@extends('user.layouts.master')

@section('contents')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <thead>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </thead>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/'.$c->product_image) }}" class=" img-thumbnail" alt="" style="width: 80px;"></td>
                                <td class="align-middle">
                                    {{ $c->product_name }}
                                    <input type="hidden" id="orderId" value="{{$c->id}}">
                                    <input type="hidden" id="productId" value="{{$c->product_id}}">
                                    <input type="hidden" id="userId" value="{{ $c->user_id }}">
                                </td>
                                <td class="align-middle" id="productPrice">{{ $c->product_price }} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus text-white"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-white border-0 text-bold text-center" value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{ $c->product_price * $c->qty}} MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary text-white rounded py-1 px-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{$totalPrice}} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Charge</h6>
                            <h6 class="font-weight-medium">3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total Amount</h5>
                            <h5 id="finalAmount">{{$totalPrice+3000}} MMK</h5>
                        </div>
                        <button class="btn btn-block bg-warning text-white font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block bg-danger text-white font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{asset("js/cartManagement.js")}}"></script>

    {{-- Ajax for fetching data from Cart to Order_List(Database) --}}
    <script>
        $('#orderBtn').click(function(){
            $orderList = [];
            $randomNumber = Math.floor(Math.random() * 1000001);
            $('#dataTable tbody tr').each(function(index, row){
                $orderList.push({
                    'user_id' : $(row).find('#userId').val(),
                    'product_id' : $(row).find('#productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace('MMK','')),
                    'order_code' : $randomNumber
                });
            });

            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/user/ajax/order',
                data : Object.assign({},$orderList),
                dataType : 'json',
                success :function (response) {
                    if(response.status == "true"){
                        window.location.href = "http://localhost:8000/user/home";
                    }
                }
            })
        })

        // When Clear Btn Click
        $('#clearBtn').click(function(){
            $('#dataTable tbody tr').remove();
            $('#subtotal').html('0 MMK');
            $('#finalAmount').html('3000 MMK')

            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/user/ajax/clear/cart',
                dataType : 'json',
            })
        })

        // when x button of each product is clicked
        $('.btnRemove').click(function() {
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $orderId = $parentNode.find('#orderId').val();

            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/user/ajax/clear/current/product',
                data : {'productId': $productId , 'orderId' : $orderId },
                dataType : 'json',
            })

            $parentNode.remove();

            $subtotal = 0;
            $("#dataTable tbody tr").each(function(index,row){
                $subtotal += Number($(row).find("#total").text().replace("MMK",""));
            });

            $("#subtotal").html(`${$subtotal} MMK`);
            $("#finalAmount").html(`${$subtotal+3000} MMK`);
        })


    </script>
@endsection
