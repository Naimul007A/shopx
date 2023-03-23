@extends('Frontend.layouts.master')
@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                    entirely.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($Products as $product)
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="{{ route('Frontend.ShowProduct', $product->slug) }}/">
                                <img class="img-fulid" src="{{ $product->getFirstMediaUrl('default') }}"
                                    alt="{{ $product->title }}">
                            </a>
                            <div class="card-body">
                                <a href="{{ route('Frontend.ShowProduct', $product->slug) }}/">
                                    <p class="card-text">{{ $product->title }}</p>
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group py-2">
                                        <form action="{{ route('Frontend.addToCart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                Add to cart
                                            </button>

                                        </form>
                                    </div>
                                    <small class="text-muted">
                                        @if ($product->sale_price !== null)
                                            <span><strike>BDT.{{ $product->price }}</strike></span>
                                            <span>BDT. {{ $product->sale_price }}</span>
                                        @else
                                            BDT. {{ $product->price }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
