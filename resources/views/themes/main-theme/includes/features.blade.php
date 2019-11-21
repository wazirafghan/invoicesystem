<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h2>Our <strong>Features</strong></h2>
            <div class="row">

                @foreach($features->chunk(4) as $feature)
                <div class="col-sm-6">
                   @foreach($feature as $single_feature)
                    <div class="feature-box">
                        <div class="feature-box-icon">
                            <i class="fa {{ $single_feature->icon or '' }}"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="heading-primary mb-none">{{ $single_feature->heading or '' }}</h4>
                            <p class="tall">{{ $single_feature->paragraph or '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                 @endforeach

            </div>
        </div>
        <div class="col-md-4">
            <h2>and more...</h2>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <i class="fa fa-usd"></i>
                                Pricing Tables
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse in">
                        <div class="panel-body">
                            Donec tellus massa, tristique sit amet condim vel, facilisis quis sapien. Praesent id enim sit amet odio vulputate eleifend in in tortor.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <i class="fa fa-comment"></i>
                                Contact Forms
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                        <div class="panel-body">
                            Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <i class="fa fa-laptop"></i>
                                Portfolio Pages
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="accordion-body collapse">
                        <div class="panel-body">
                            Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
if(isset($settings['lead_text_customers'])) {
    $lead_text_customers = $settings['lead_text_customers'];
}else {
    $lead_text_customers = "loading text......";
}
?>
    <hr class="tall">

    <div class="row center">
        <div class="col-md-12">
            <h2 class="mb-sm word-rotator-title">
                We're not the only ones
                <strong>
									<span class="word-rotate" data-plugin-options="{'delay': 3500, 'animDelay': 400}">
										<span class="word-rotate-items">
											<span>excited</span>
											<span>happy</span>
										</span>
									</span>
                </strong>
                about  {{ config('app._site_name') }} ...
            </h2>
            <h4 class="heading-primary lead tall">{{ $lead_text_customers }}</h4>
        </div>
    </div>

    <div class="row center">
        <div class="owl-carousel owl-theme" data-plugin-options="{'items': 6, 'autoplay': true, 'autoplayTimeout': 3000}">
            @foreach($clients as $client)
                <div>
                    @if(File::exists('uploads/clients/'.$client->logo))
                        <img class="img-responsive" src="{{asset('uploads/clients/'.$client->logo)}}" alt="" />
                    @else
                        <img class="img-responsive" src="{{asset('uploads/placeholder.jpg')}}" alt="" />
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>