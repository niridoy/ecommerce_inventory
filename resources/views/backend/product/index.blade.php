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
                <div class="card-header">{{ __('Product List') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @forelse ($ProductList as $Product)
                            <tr>
                                <td><img class="product-img" src="{{ $Product->image ? asset('storage/backend/images/product/'.$Product->image) : asset('images/product_demo_img.png') }}" alt=""></td>
                                <td>{{ $Product->name }}</td>
                                <td>{!! $Product->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactive</span>' !!}</td>
                                <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('products.edit',$Product->id) }}">Edit</a>

                                <form onclick="return confirm('Are you sure want to delete ?')" action="{{ route('products.destroy',$Product->id) }}" style="display: inline-block;" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                </form>
                                </td>
                            </tr>
                         @empty
                            <tr>
                                <td colspan="4">Data Not Available</td>
                            </tr>
                         @endforelse
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
