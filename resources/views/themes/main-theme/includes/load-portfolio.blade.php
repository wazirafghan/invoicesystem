@foreach($portfolios as $portfolio)
    @foreach($portfolio->categories as $category)
        <li class="col-md-3 isotope-item {{ $category->slug }}" id="{{$portfolio->id}}">
            <div class="portfolio-item">
                <a href="{{ $portfolio->url }}" target="_blank">
                    <span class="thumb-info">
                        <span class="thumb-info-wrapper">
                            <img src="{{ asset('uploads/portfolios/'.$portfolio->pic) }}" class="img-responsive" alt="">
                            <span class="thumb-info-title">
                                <span class="thumb-info-inner">{{ $portfolio->title }}</span>
                                <span class="thumb-info-type">{{ $category->name }}</span>
                            </span>
                            <span class="thumb-info-action">
                                <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                            </span>
                        </span>
                    </span>
                </a>
            </div>
        </li>
    @endforeach
@endforeach
