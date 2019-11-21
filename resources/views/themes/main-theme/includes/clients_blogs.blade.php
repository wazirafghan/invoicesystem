<section class="pt-md section-custom-construction-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 center">
                <div class="owl-carousel owl-theme stage-margin rounded-nav" data-plugin-options="{'margin': 10, 'loop': false, 'nav': true, 'dots': false, 'stagePadding': 40, 'items': 6, 'autoplay': true, 'autoplayTimeout': 3000}">
                    @foreach($clients as $client)
                    <div>
                        <img class="img-responsive" src="{{asset("uploads/clients/$client->pic")}}" alt="">
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 center mt-xl">
                <hr class="solid mt-none mb-xl">
            </div>
        </div>
        <div class="row pt-xl">
            <div class="col-md-12">
                <h2 class="mb-none text-color-dark">Recent Blog</h2>
                <p class="lead mb-sm">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="row">
            <?php $sn= 0;?>
            @foreach($posts as $post)
                <?php $sn= 0;?>
                @if($sn<=3)
                <div class="col-md-4">
                    <div class="recent-posts mt-xl">
                        <a href="{{url('blog/'.$post->slug)}}">
                            <img class="img-responsive pb-md" src="{{asset("uploads/post/$post->featured_image")}}" alt="Blog">
                        </a>
                        <article class="post">
                            <div class="date">
                                <span class="day">{{$post->created_at->format('d')}}</span>
                                <span class="month">{{$post->created_at->format('M')}}</span>
                            </div>
                            <h4 class="pt-md pb-none mb-none"><a class="text-color-dark" href="{{url('blog/'.$post->slug)}}">Lorem ipsum dolor sit amet</a></h4>
                            <p>By {{ $post->admin->name }}</p>
                            <p>{{$post->content}}</p>
                            <a class="mt-md" href="{{url('blog/'.$post->slug)}}">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </article>
                    </div>
                </div>
                @endif
            @endforeach

        </div>
    </div>
</section>
