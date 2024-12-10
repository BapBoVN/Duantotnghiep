<style>
    .shopping-list {
        max-height: 300px;
        overflow-y: auto;
        scrollbar-width: thin; /* Cho Firefox */
        scrollbar-color: #888 #f1f1f1; /* Cho Firefox */
    }

    /* Tùy chỉnh thanh cuộn cho Chrome, Edge, và Safari */
    .shopping-list::-webkit-scrollbar {
        width: 6px;
    }

    .shopping-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .shopping-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .shopping-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Theo dõi đơn hàng</a></li>
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Quản lý Admin</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}"  target="_blank">Xin chào {{Auth::user()->name}}</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Đăng xuất</a></li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Đăng nhập /</a> <a href="{{route('register.form')}}">Đăng kí</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo"  alt="logo" 
                        style=" width: 90px; height: auto; margin-left: 100px; margin-top: -30px;">
                    </a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >Danh mục</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input name="search" placeholder="Tìm kiếm tên sản phẩm" type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php 
                                $total_prod=0;
                                $total_amount=0;
                            @endphp
                           @if(session('wishlist'))
                                @foreach(session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod+=$wishlist_items['quantity'];
                                        $total_amount+=$wishlist_items['amount'];
                                    @endphp
                                @endforeach
                           @endif
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">{{Helper::wishlistCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromWishlist())}} Sản phẩm</span>
                                        <a href="{{route('wishlist')}}">Yêu thích</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach(Helper::getAllProductFromWishlist() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Xóa"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}" style="width: 70px; height: auto; max-height: 70px; object-fit: contain;"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price)}} VND</span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Tổng cộng</span>
                                            <span class="total-amount">{{number_format(Helper::totalWishlistPrice())}} VND</span>
                                        </div>
                                        <div class="button-group">
                                            @if(count(Helper::getAllProductFromWishlist()) > 0)
                                                <a href="{{route('wishlist-delete-all')}}" 
                                                   class="btn animate btn-danger" 
                                                   onclick="return confirm('Bạn có chắc muốn xóa tất cả sản phẩm yêu thích?')">
                                                    <i class="fa fa-trash"></i> Xóa tất cả
                                                </a>
                                                <a href="{{route('add-all-to-cart')}}" 
                                                   class="btn animate">
                                                    <i class="fa fa-shopping-cart"></i> Thêm tất cả vào giỏ
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} Sản phẩm</span>
                                        <a href="{{route('cart')}}">Xem giỏ hàng</a>
                                       
                                    </div>
                                    <br>
                                    <ul class="shopping-list" style="max-height: 300px; overflow-y: auto;">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                        @foreach(Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Xóa"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{$photo[0]}}" alt="{{$photo[0]}}" style="width: 70px; height: auto; max-height: 70px; object-fit: contain;"></a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">{{number_format($data->price)}} VND</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Tổng cộng</span>
                                            <span class="total-amount">{{number_format(Helper::totalCartPrice())}} VND</span>
                                        </div>
                                        @if(count(Helper::getAllProductFromCart()) > 0)
                                            <a href="{{route('cart-delete-all')}}" 
                                               class="btn animate btn-danger" 
                                               onclick="return confirm('Bạn có chắc muốn xóa tất cả sản phẩm?')">
                                                <i class="fa fa-trash"></i> Xóa tất cả
                                            </a>
                                        @endif
                                        <a href="{{route('checkout')}}" class="btn animate">Thanh toán</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Trang chủ</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">Chúng tôi</a></li>
                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Sản phẩm</a><span class="new">New</span></li>												
                                                {{Helper::getHeaderCategory()}}
                                            <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Tin tức</a></li>									
                                               
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>