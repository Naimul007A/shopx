@extends('Frontend.layouts.master')
@section('main')
    <div class="container">
        <div class="py-5">
            <h2 class="fs-3 text-center">Cart</h2>
            <hr>
            <div>
                @if ($cart !== null && $cart !== [])
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($cart as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $product['title'] }}</td>
                                    <td>BDT {{ $product['price'] }}</td>
                                    <td>
                                        @if ($product['quantity'] <= 1)
                                            <span id="cart-decrease" style="pointer-events: none;"
                                                data-id="{{ $product['product_id'] }}">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                        @else
                                            <span id="cart-decrease" data-id="{{ $product['product_id'] }}">
                                                <i class="fa-solid fa-minus"></i>
                                            </span>
                                        @endif

                                        {{ $product['quantity'] }}
                                        <span id="cart-increase" data-id="{{ $product['product_id'] }}">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </td>
                                    <td>BDT. {{ number_format($product['sub_total'], 2) }}</td>
                                    <td><a href="javascript:void(0)" id="Removetocart"
                                            data-id="{{ $product['product_id'] }}">remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <td>BDT. {{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="float-end">
                        <a href="{{ route('Frontend.home') }}/" class="btn btn-md btn-info">Back to shop</a>
                        <a href="{{ route('Frontend.Checkout') }}/" class="btn btn-md btn-info">Ckeckout</a>
                    </div>
                @else
                    <h3>NO Products Found!</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
