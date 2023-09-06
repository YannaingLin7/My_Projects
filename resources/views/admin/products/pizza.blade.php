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
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Add New Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                            <form action="{{ route('product#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                    <button class=" btn btn-dark text-white" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- End of Search bar --}}

                        @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p )
                                    <tr class="tr-shadow">
                                        <td class=" col-2"> <img src="{{ asset('storage/'.$p->image) }}" class=" img-thumbnail shadow-sm "> </td>
                                        <td class=" col-2"> {{ $p->name }} </td>
                                        <td class=" col-2"> {{ $p->category_name }} </td>
                                        <td class=" col-2"> {{ $p->price }}_MMK</td>
                                        <td class=" col-2"> <i class="fa-solid fa-arrow-up-wide-short"></i> | {{ $p->view_count}} </td>
                                        <td class=" col-2">
                                            <div class="table-data-feature">
                                                <a href="{{ route ('product#detailPage', $p->id) }}" class=" mx-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#editPage', $p->id) }}" class=" mx-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete',$p->id) }}" class=" mx-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class=" mt-3">
                                {{ $pizzas->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>
                        </div>
                        @else
                            <h3 class=" text-center text-danger bold mt-5">There is no product here...</h3>
                        @endif
                        <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
