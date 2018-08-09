@php
    $businessHots = app('Home')->getBusinessHot();

    $hotF = new App\Http\Controllers\Frontend\FranchiseController();
    $hotFranchises = $hotF->hotFranchise();
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

    <aside class="single-widget" >
        <h4 class="widget-title">{{ trans('fe_business.hot_franchise') }}</h4>
        <div class="widget-content">
            <div class="popular-post-widget">
                @foreach ($hotFranchises as $key => $hotFranchise)
                    <div class="widget-single-post clearfix">
                        <div class="post-thumb">
                            <a href="{{ route('fe.franchise_detail', [@$hotFranchise['id'], @$hotFranchise['slug'] ]) }}"><img src="{{ @$hotFranchise['image'] }}" alt=""></a>
                        </div>
                        <div class="widget-post-content">
                            <p>
                                <p  class="widget-post-date">{{ $hotFranchise['title'] }}</p>
                                <a href="{{ route('fe.business_detail', [@$hotFranchise['id'], @$hotFranchise['intro_2']]) }}">
                                {!! str_limit(@$hotFranchise['description'], $limit = 70, $end = '...') !!}</a>
                            </p>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
    </aside>
</div>