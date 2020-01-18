@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send Product Stock Update') }}</div>

                <div class="card-body">
                   @if(Session::has('success'))
                   <div class="alert alert-success">
                        <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('product-sends.update',$ProductStockSend->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date',$ProductStockSend->date) }}" required autocomplete="date" autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12"><h5 class="text-center">Product Details</h5></div>
                        </div>

                        <div class="form-group row">
                            <label for="product_id" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="product_id" class="form-control" id="">
                                        <option value="">Select One</option>
                                    @foreach ($ProductList as $Product)
                                        <option value="{{ $Product->id }}" {{ $Product->id  == old('product_id',$ProductStockSend->product_id) ? 'selected' : '' }} >{{ $Product->name}}</option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input id="unit" type="number" min="1" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit',$ProductStockSend->unit) }}" required autocomplete="name" autofocus>

                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
       $(document).ready(function(){
            $('#date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
       });
    </script>
@endpush
