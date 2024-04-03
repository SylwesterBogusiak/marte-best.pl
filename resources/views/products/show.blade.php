@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('View') }}</div>

                <div class="card-body">
                    @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" maxlength="500" class="form-control" name="name" value="{{ $product->name }}" disabled>

                              
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" maxlength="1500" class="form-control" name="description" disabled>{{ $product->description }}</textarea>

                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="{{ $product->amount }}" disabled>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}" disabled>

                              
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.fields.category') }}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category_id" disabled>
                                @if($product->hasCategory())
                                <option> {{ $product->category->name }}</option>
                                @else
                                <option value="">Brak</option>
                                @endif

                                </select>


                         
                                </div>
                            </div>
                        </div>
                       
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
