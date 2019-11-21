<section class="section section-custom-map">
    <section class="section section-default section-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="recent-posts mb-xl">
                        <h2>Latest <strong>Blog</strong> Posts</h2>
                        <div class="row">
                            <div class="owl-carousel owl-theme mb-none" data-plugin-options="{'items': 1}">
                                <div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">15</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">15</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">12</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">11</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">15</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                    <div class="col-md-6">
                                        <article>
                                            <div class="date">
                                                <span class="day">15</span>
                                                <span class="month">Jan</span>
                                            </div>
                                            <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2><strong>What</strong> Client’s Say</h2>
                    <div class="row">
                        <div class="owl-carousel owl-theme mb-none" data-plugin-options="{'items': 1}">

                            @foreach($client_feedbacks as $cf)
                            <div>
                                <div class="col-md-12">
                                    <div class="testimonial testimonial-primary">
                                        <blockquote>
                                            <p>{{ $cf->comment or '' }}</p>
                                        </blockquote>
                                        <div class="testimonial-arrow-down"></div>
                                        <div class="testimonial-author">
                                            <div class="testimonial-author-thumbnail img-thumbnail">

                                                @if(File::exists('uploads/cpic/'.$cf->pic))
                                                    <img src="{{asset('uploads/cpic/'.$cf->pic)}}" alt="" >
                                                @else
                                                    <img src="{{asset('uploads/placeholder.jpg')}}"  alt=""/>
                                                @endif

                                            </div>
                                            <p><strong>{{ $cf->name or '' }}</strong><span>{{ $cf->designation or '' }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>