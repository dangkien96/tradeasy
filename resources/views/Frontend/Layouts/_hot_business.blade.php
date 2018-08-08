@php
    $businessHots = app('Home')->getBusinessHot();
@endphp
<div class="col-md-4 col-sm-4" style="background: #fff;">
    <aside class="single-widget">
            <h4 class="widget-title">{{ trans('fe_business.hot_business') }}</h4>
            <div class="widget-content">
                <ul class="post-cat-list">
                    @foreach ($businessHots as $key => $businessHot)
                    <li>
                        <a href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}">
                            <i class="fa fa-angle-double-right"> </i> {{ $businessHot->intro_2 }}</a>
                    </li>
                    @endforeach 
                </ul>
            </div>
    </aside>
   <!--  <aside class="single-widget">
        <h4 class="widget-title">{{ trans('fe_business.hot_franchise') }}</h4>
        <div class="widget-content"> 
            <div class="popular-post-widget">

                <div class="widget-single-post clearfix">
                    <div class="post-thumb">
                        <a href="#"><img src="img/blog/s-1.jpg" alt=""></a>
                    </div>
                    <div class="widget-post-content">
                        <p class="widget-post-date">29 March 2016</p>
                        <p><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></p>
                    </div>
                </div>

                <div class="widget-single-post clearfix">
                    <div class="post-thumb">
                        <a href="#"><img src="img/blog/s-2.jpg" alt=""></a>
                    </div>
                    <div class="widget-post-content">
                        <p class="widget-post-date">29 March 2016</p>
                        <p><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></p>
                    </div>
                </div>

                <div class="widget-single-post clearfix">
                    <div class="post-thumb">
                        <a href="#"><img src="img/blog/s-3.jpg" alt=""></a>
                    </div>
                    <div class="widget-post-content">
                        <p class="widget-post-date">29 March 2016</p>
                        <p><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></p>
                    </div>
                </div>

                <div class="widget-single-post clearfix">
                    <div class="post-thumb">
                        <a href="#"><img src="img/blog/s-4.jpg" alt=""></a>
                    </div>
                    <div class="widget-post-content">
                        <p class="widget-post-date">29 March 2016</p>
                        <p><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></p>
                    </div>
                </div>

            </div>
        </div>
    </aside> -->
</div>