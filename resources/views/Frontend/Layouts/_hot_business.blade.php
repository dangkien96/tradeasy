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

    <!-- <aside class="single-widget" >
        <h4 class="widget-title">{{ trans('fe_business.hot_business') }}</h4>
        <div class="widget-content">
            <div class="popular-post-widget">
                @foreach ($businessHots as $key => $businessHot)
                    <div class="widget-single-post clearfix">
                        <div class="post-thumb">
                            <a href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}"><img src="https://www.profidelta.com.hk/data/tbl_opportunities_4/org/{{ @$businessHot->photo_1 }}" alt=""></a>
                        </div>
                        <div class="widget-post-content">
                            <p><a class="widget-post-date" href="{{ route('fe.business_detail', [@$businessHot->id, @$businessHot->intro_2]) }}">{{ $businessHot->intro_2 }}</a></p>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </aside> -->
</div>