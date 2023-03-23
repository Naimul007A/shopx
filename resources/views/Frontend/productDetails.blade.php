@extends('Frontend.layouts.master')
@section('main')
    <div class="container">
        <div class="py-4">
            <h3 class="text-center">Product Details</h3>
            <hr>
        </div>
        <div class="row pt-5">
            @foreach ($product as $data)
                <div class="col-12 col-md-6">
                    <img src="{{ $data->getFirstMediaUrl('default') }}" alt="Product">
                </div>
                <div class="col-12 col-md-6">

                    <h3>{{ $data->title }}</h3>



                    <p class="text-muted">
                        {{ $data->short_description }}
                    </p>
                    <div class="py-2">
                        <small class="text-muted">
                            @if ($data->sale_price !== null)
                                <span><strike>BDT.{{ $data->price }}</strike></span>
                                <span>BDT. {{ $data->sale_price }}</span>
                            @else
                                BDT. {{ $data->price }}
                            @endif
                        </small>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('Frontend.addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-md btn-outline-info">
                                Add to cart
                            </button>

                        </form>
                    </div>
                </div>


        </div>
        <div>
            <p>{{ $data->description }}</p>
        </div>
        @endforeach
    </div>
@endsection
