@extends('layouts.app')

@push('styles')
    <style>
    .product-img{
        height: 50px;
        width: 50px;
    }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Stock Send List') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @forelse ($ProductStockSendList as $ProductStockSend)
                            <tr>
                            <td>{{$ProductStockSend->date}}</td>
                                <td><img class="product-img" src="{{ $ProductStockSend->product->image ? asset('storage/backend/images/product/'.$ProductStockSend->product->image) : asset('images/product_demo_img.png') }}" alt=""></td>
                                <td>{{ $ProductStockSend->product->name  }}</td>
                                <td>{{ $ProductStockSend->unit }}</td>
                                <td>{!! $ProductStockSend->is_received == 1 ? '<span class="badge badge-success">Received</span>' : '<span class="badge badge-danger">Pending</span>' !!}</td>
                                <td>
                                    @if($ProductStockSend->is_received == 0)
                                        <a class="btn btn-sm btn-warning" href="{{ route('product-sends.edit',$ProductStockSend->id) }}">Edit</a>

                                        <form onclick="return confirm('Are you sure want to delete ?')" action="{{ route('product-sends.destroy',$ProductStockSend->id) }}" style="display: inline-block;" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-warning">Not Available</button>
                                    @endif

                                </td>
                            </tr>
                         @empty
                            <tr>
                                <td colspan="6">Data Not Available</td>
                            </tr>
                         @endforelse
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
