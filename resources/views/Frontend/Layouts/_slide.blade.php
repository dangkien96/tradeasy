@php 

    $slides = app('Home')->getSlide();
@endphp

<div class="slider-area">
    <div class="slider-wrapper owl-carousel">
        @foreach ($slides as $key => $slide)
        <div class="slider-item home-one-slider-otem slider-item-four" style="background-image: url({{ url('')  }}/{{ @$slide->url_image }});">
            <div class="container">
                <div class="row">
                    <div class="slider-content-area">
                        <div class="slide-text">
                            <h1 class="homepage-three-title">Welcome to Rumi<span>.</span></h1>
                            <h2>Lorem ipsum is simply dummy text of the printing.</h2>
                            <div class="slider-content-btn">
                                <a class="button button-color active margin-right-15  " href="#">Get Started</a>
                                <a class="button button-transparent slide-right margin-top-20" href="#">Sign Up Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>