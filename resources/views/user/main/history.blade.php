@extends('user.layouts.master')

@section('contents')

    <!-- Cart Start -->
    <div class="container-fluid" style="height:400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <thead>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </thead>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class=" align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class=" align-middle">{{ $o->order_code }}</td>
                                <td class=" align-middle">{{ $o->total_price }}</td>
                                <td class=" align-middle">
                                    @if ($o->status == 0)
                                        <button class="btn btn-sm btn-warning disabled"><i class="fa-regular fa-clock me-2"></i>Pending</button>
                                    @elseif($o->status == 1)
                                        <button class="btn btn-sm btn-success disabled"><i class="fa-solid fa-square-check me-2"></i>Success</button>
                                    @elseif($o->status == 2)
                                        <button class="btn btn-sm btn-danger disabled"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
