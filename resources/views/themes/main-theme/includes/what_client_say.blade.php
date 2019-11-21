<section class="section section-background mb-xl" style="background-image: url({{asset('uploads/client_bg.jpg')}}); background-position: 50% 100%; min-height: 540px;margin-top: -30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-6">

                <div class="owl-carousel owl-theme nav-bottom rounded-nav mt-xl pt-xl mb-xl pb-xl" data-plugin-options="{'items': 1, 'loop': false}">
                    @foreach($client_feedbacks as $client_feedback)
                    <div>
                        <div class="col-md-12">
                            <div class="testimonial testimonial-style-2 testimonial-with-quotes mb-none">
                                <blockquote>
                                    <p>{{$client_feedback->comment}}</p>
                                </blockquote>
                                <div class="testimonial-author">
                                    <p><strong>{{$client_feedback->name}}</strong><span>{{$client_feedback->designation}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
