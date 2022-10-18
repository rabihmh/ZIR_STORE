<x-front-layout title="Checkout">
    <x-slot:breadcrumbs>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Checkout</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-cart"></i> Shop</a></li>
                            <li><a href=""><i class="lni lni-shopping-basket"></i>Checkout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot:breadcrumbs>
    <section class="checkout-wrapper section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <div class="checkout-steps-form-style-1">
                            <ul id="accordionExample">
                                <li>
                                    <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="true" aria-controls="collapseThree">Your Personal Details </h6>
                                    <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                             aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[billing][first_name]"
                                                                          placeholder="First Name"/>
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[billing][last_name]"
                                                                          placeholder="Last Name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][email]" type="email"
                                                                      placeholder="Email"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone Number</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][phone_number]"
                                                                      placeholder="Phone Number"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Mailing Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][street_address]"
                                                                      placeholder="Mailing Address"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][city]" placeholder="City"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][postal_code]"
                                                                      placeholder="Post Code"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Country</label>
                                                    <div class="select-items">
                                                        <x-form.select name="addr[billing][country]"
                                                                       :options="$countries"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Region/State</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[billing][state]" placeholder="State"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-checkbox checkbox-style-3">
                                                    <input type="checkbox" id="checkbox-3">
                                                    <label for="checkbox-3"><span></span></label>
                                                    <p>My delivery and mailing addresses are the same.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form button">
                                                    <button class="btn" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFour" aria-expanded="false"
                                                            aria-controls="collapseFour">next
                                                        step
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                                <li>
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapseFour"
                                             aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>User Name</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[shipping][first_name]"
                                                                          placeholder="First Name"/>
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <x-form.input name="addr[shipping][last_name]"
                                                                          placeholder="Last Name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Email Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][email]" type="email"
                                                                      placeholder="Email"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Phone Number</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][phone_number]"
                                                                      placeholder="Phone Number"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Mailing Address</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][street_address]"
                                                                      placeholder="Mailing Address"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>City</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][city]" placeholder="City"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Post Code</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][postal_code]"
                                                                      placeholder="Post Code"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Country</label>
                                                    <div class="select-items">
                                                        <x-form.select name="addr[shipping][country]"
                                                                       :options="$countries"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Region/State</label>
                                                    <div class="form-input form">
                                                        <x-form.input name="addr[shipping][state]" placeholder="State"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="steps-form-btn button">
                                                    <button class="btn" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">previous
                                                    </button>
                                                        <button type="submit" class="btn">pay now</button>

                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>

                            </ul>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="checkout-sidebar-coupon">
                            <p>Appy Coupon to get discount!</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="button">
                                        <button class="btn">apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="checkout-sidebar-price-table mt-30">
                            <h5 class="title">Pricing Table</h5>
                            <div class="sub-total-price">
                                <div class="total-price">
                                    <p class="value">Subtotal Price:</p>
                                    <p class="price">{{Currency::format($cart->total())}}</p>
                                </div>
                                <div class="total-price shipping">
                                    <p class="value">Subtotal Discount:</p>
                                    <p class="price">{{Currency::format(0)}}</p>
                                </div>
                                <div class="total-price discount">
                                    <p class="value">Subtotal Shipping:</p>
                                    <p class="price">{{Currency::format(10)}}</p>
                                </div>
                            </div>
                            <div class="total-payable">
                                <div class="payable-price">
                                    <p class="value">Subotal Price:</p>
                                    <p class="price">{{Currency::format($cart->total()+10)}}</p>
                                </div>
                            </div>
                            <div class="price-table-btn button">
                                <a href="javascript:void(0)" class="btn btn-alt">Checkout</a>
                            </div>
                        </div>
                        <div class="checkout-sidebar-banner mt-30">
                            <a href="product-grids.html">
                                <img src="assets/images/banner/banner.jpg" alt="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front-layout>
