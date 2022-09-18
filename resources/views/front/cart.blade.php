<x-front-layout title="Cart">
    {{--    <x-slot:allCategories>--}}
    {{--        <div class="mega-category-menu">--}}
    {{--            <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>--}}
    {{--            <ul class="sub-category">--}}
    {{--                @foreach($categories as $category)--}}
    {{--                    @php--}}
    {{--                        $sub= \App\Models\Category::where('parent_id',$category->id)->select('name')->get()--}}
    {{--                    @endphp--}}
    {{--                    <li><a href="product-grids.html">{{$category->name}}@if($sub->isNotEmpty())<i--}}
    {{--                                class="lni lni-chevron-right"></i>@endif</a>--}}
    {{--                        @if($sub->isNotEmpty())--}}
    {{--                            <ul class="inner-sub-category">--}}
    {{--                                @foreach($sub as $sub_cat)--}}
    {{--                                    <li><a href="product-grids.html">{{$sub_cat->name}}</a></li>--}}
    {{--                                @endforeach--}}
    {{--                            </ul>--}}
    {{--                        @endif--}}
    {{--                    </li>--}}
    {{--                @endforeach--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </x-slot:allCategories>--}}
    <x-slot:breadcrumbs>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href=""><i class="lni lni-cart"></i>Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-slot:breadcrumbs>

    <!--Start Cart-->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12"></div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                @foreach($cart->get() as $item)
                    <div class="cart-single-list" id="{{$item->id}}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{route('products.show',$item->products->slug)}}"
                                ><img src="{{$item->products->image_url}}" alt="#"
                                    /></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name">
                                    <a href="{{route('products.show',$item->products->slug)}}">
                                        {{$item->products->name}}
                                    </a>
                                </h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control" id="item-quantity" data-id="{{$item->id}}"
                                           value="{{$item->quantity}}"/>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{Currency::format($item->quantity*$item->products->price)}}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{Currency::format(0)}}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" data-id="{{$item->id}}" href="javascript:void(0)"
                                ><i class="lni lni-close"></i
                                    ></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-6 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <input name="Coupon" placeholder="Enter Your Coupon"/>
                                                <div class="button">
                                                    <button class="btn">Apply Coupon</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal<span>{{Currency::format($cart->total())}}</span></li>
                                            <li>Shipping<span>Free</span></li>
                                            <li>You Save<span>$29.00</span></li>
                                            <li class="last">You Pay<span>$2531.00</span></li>
                                        </ul>
                                        <div class="button">
                                            <a href="checkout.html" class="btn">Checkout</a>
                                            <a href="product-grids.html" class="btn btn-alt"
                                            >Continue shopping</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Cart-->

        @push('scripts')
            <script>
                const csrf_token = "{{csrf_token()}}"
            </script>
            <script src="{{asset('assets/js/jquery.js')}}"></script>
            <script src="{{asset('js/cart.js')}}"></script>
    @endpush
</x-front-layout>
