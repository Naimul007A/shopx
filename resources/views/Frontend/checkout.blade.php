@extends('Frontend.layouts.master')
@section('main')
    <div class="container">
        @auth

            <div class="py-5">
                <div class="alert alert-info">
                    You cannot be checkout without login. <a href="">Please login </a>!
                </div>
            </div>
        @endauth
        @guest


            <div class="py-5 text-center">

                <h2>Checkout form</h2>
                <p class="lead">Please Full fill all correct data.</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($cart as $data)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $data['title'] }}</h6>
                                    <small class="text-danger">X {{ $data['quantity'] }}</small>
                                </div>
                                <span class="text-muted">BDT. {{ number_format($data['sub_total'], 2) }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BDT)</span>
                            <strong>{{ number_format($total, 2) }}</strong>
                        </li>

                    </ul>

                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate action="" method="POST">
                        <div class="row g-3">
                            <div class="">
                                <label for="name" class="form-label">Your name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter your name">
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="Enter your number..">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control disabled" id="email" value="">
                                <input type="hidden" name="email" value="">

                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St">

                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span
                                        class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div>


                            <div class="col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input type="text" name="state" class="form-control" placeholder="Your state ..">
                            </div>

                            <div class="col-md-6">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="Your zip code ...">
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue To Order</button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
@endsection
