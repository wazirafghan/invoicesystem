<section class="section section-tertiary section-no-border section-custom-construction" style="margin-top: -15px;margin-top:0px;">
    <div class="container">
        <div class="row pt-xl">
            <div class="col-md-12">
                <h2 class="mb-none text-color-dark">Our Feature</h2>
                <p class="lead">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>

        <div class="row mt-lg">
            @foreach($features->chunk(2) as $feature)
                <div class="col-sm-6">
                    @foreach($feature as $single_feature)
                        <div class="feature-box feature-box-style-2 mb-xl appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                            <div class="feature-box-icon">
                                <i class="fa {{ $single_feature->icon}}"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="heading-primary mb-none">{{ $single_feature->heading }}</h4>
                                <p class="tall">{{ $single_feature->paragraph  }}</p>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endforeach

        </div>


    </div>
</section>
