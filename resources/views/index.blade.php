@extends('master')
@section('content')
<header id="header" class="header-area overlay">
    <!-- NAVBAR -->
    <div class="nav">
    <nav class="navbar navbar-expand-md navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">MONTSERRAT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
        </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav ml-auto">
                    <li><a href="{{URL::to('/')}}">HOME</a></li>
                    <li><a href="#highlight">HIGHLIGHT</a></li>
                    <li><a href="#list-product">PRODUCT</a></li>
                </ul>
                <!-- Nav Right -->
              <form class="navbar-form">
                <div class="form-group">
                  <input type="text" name="search" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn"><span class="fa fa-search"></span></button>
              </form>
            </div>
        </div>
    </nav>
    </div>
    
    <!-- BANNER PRODUCT -->
    <div class="product-carousel">
        <div class="carousel__nav">
        <span id="moveLeft" class="carousel__arrow">
              <svg class="carousel__icon" width="24" height="24" viewBox="0 0 24 24">
          <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
      </svg>
          </span>
          <span id="moveRight" class="carousel__arrow" >
            <svg class="carousel__icon"  width="24" height="24" viewBox="0 0 24 24">
        <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
      </svg>    
          </span>
        </div>
        @foreach($products as $product)
        <div class="carousel-item carousel-item--{{$loop->first}}">
          <div class="carousel-item__image" style="background-image: url({{ asset('/storage/'.$product->banner_img)}});"></div>
          <div class="carousel-item__info">
            <div class="carousel-item__container text-center">
            <h1 class="carousel-item__title">{{$product->title}}</h1>
            <h1 class="carousel-item__subtitle">{{$product->umkm}} </h1>
            <a href="#list-product" class="carousel-item__btn">Explore the tour</a>
              </div>
          </div>
        </div>
        @endforeach
      </div>
</header>
      <!-- SLIDER ICON -->
      <div class="slider">
        <div class="slide-track">
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" alt="" />
            </div>
            <div class="slide">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" alt="" />
            </div>
        </div>
    </div>
    <!-- TABS -->
    <section>
      <div id="highlight" class="section-title">
        <div class="container">
        <h1>HIGHLIGHT</h1>
        </div>
      </div>
      <div class="product-tabs d-block">
  <div class="container-fluid mt-5">
    <!-- Nav tabs -->
    <div class="row">
      <div class="col-md-6 col-lg-6">
        <ul class="nav nav-tabs justify-content-center">
        @foreach ($category as $tag)
        @if($tag)
          <li class="nav-item ">
            <a class="nav-link {{ $loop->first ?  'active' : '' }}" href="#{{$tag->category}}">{{$tag->category}}</a>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
    
    <!-- Tab panes -->
    <div class="row">
      <div class="col-lg-12">
        <div class="tab-content mb-3">
        @foreach ($category as $tag)
              <div id="{{$tag->category}}" class="container tab-pane {{ $loop->first ?  'active' : '' }}"><br>
                <div class="detail-product-carousel">
                @foreach ($products as $hl )
                @if ($tag->category == $hl->category)
                  <div class="detail-item">
                    <div class="detail-content">
                      <div class="carousel-item__image" style="background-image: url({{asset('/storage/'.$hl->profile_img)}}); background-size: cover;"></div>
                      <div class="carousel-item__info">
                        <div class="carousel-item__container text-center">
                        <h1 class="carousel-item__subtitle">{{$hl->umkm}} </h1>
                        <h1 class="carousel-item__title">{{$hl->title}}</h1>
                        <p class="carousel-item__description">{{$hl->description}}</p>
                        <a href="#" class="carousel-item__btn">Explore the tour</a>
                          </div>
                    </div>
                  </div>
                  </div>
                  @endif
            @endforeach
            </div>
             <!-- NAV DETAIL PRODUCT -->

              <div class="detail-nav">
              @foreach ($products as $hl )
                @if ($tag->category == $hl->category)
                <div class="detail-nav-item">
                  <div class="nav-image text-center" style="background: url({{asset('/storage/'.$hl->profile_img)}}) no-repeat; background-position: center;">
                  <p> {{$hl->title}}</p>
                  </div>
                </div>
                @endif
            @endforeach
             </div>
          </div>
          @endforeach
        </div>
      </div>
      </div>
    </div>

</div>
    </section>
    <section>
      <div id="list-product" class="section-title">
        <div class="container">
        <h1>PRODUCT</h1>
        </div>
      </div>
      <div class="container">
        <div class="col-lg-12">
          <div class="row">
            @if($cari != null )
            @foreach($cari as $product)
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-6 text-center">
              <div class="list-product">
                <img src="{{ asset('/storage/'.$product->profile_img)}}" alt="" class="img-fluid">
                <h3 class="mt-2">{{$product->title}}</h3>
                <p class="mt-3">{{$product->description}}</p>
              </div>
            </div>
            @endforeach
            @else 
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-6 text-center">
              <div class="list-product">
                <img src="{{ asset('/storage/'.$product->profile_img)}}" alt="" class="img-fluid">
                <h3 class="mt-2">{{$product->title}}</h3>
                <p class="mt-3">{{$product->description}}</p>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
</section>
      <div class="d-flex justify-content-center">
          {!! $products->appends(Request::except('cari'))->links('pagination::bootstrap-4')->withPath('#list-product')->render() !!}
      </div>
@endsection
