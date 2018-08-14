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
                            <h1 class="homepage-three-title">{!! @$slide->title !!}<span>.</span></h1>
                            <h3>{!! @$slide->description !!}.</h3>
                            <div class="slider-content-btn">
                                <a class="button button-color active margin-right-15" href="{!! @$slide->url_link !!}">{{ trans('fe_business.get_started') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>