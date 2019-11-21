@extends('themes.main-theme.layouts.master')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
@section('title',$title)
@section('content')
    <?php
    if(isset($settings['logo'])) {
        $logo = $settings['logo'];
    }else {
        $logo = "placeholder.jpg";
    }
    if(isset($settings['contact_number'])) {
        $contact_number = $settings['contact_number'];
    }else {
        $contact_number = "111-2222-55555";
    }
    if(isset($settings['facebook_page_url'])) {
        $facebook_page_url = $settings['facebook_page_url'];
    }else {
        $facebook_page_url = "http://www.facebook.com/";
    }
    if(isset($settings['twitter_url'])) {
        $twitter_url = $settings['twitter_url'];
    }else {
        $twitter_url = "http://www.twitter.com/";
    }
    if(isset($settings['linkedin_url'])) {
        $linkedin_url = $settings['linkedin_url'];
    }else {
        $linkedin_url = "http://www.linkedin.com/";
    }
    if(isset($settings['contact_info'])) {
        $contact_info = $settings['contact_info'];
    }else {
        $contact_info = "loading.....";
    }
    if(isset($settings['email'])) {
        $email = $settings['email'];
    }else {
        $email = "loading.....";
    }
    if(isset($settings['get_in_touch'])) {
        $get_in_touch = $settings['get_in_touch'];
    }else {
        $get_in_touch = "loading.....";
    }
    ?>
    <div role="main" class="main">

        <section class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Portfolio</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>Portfolio</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">

            <h2>Portfolio</h2>

            <ul id="portfolioLoadMoreFilter" class="nav nav-pills sort-source" data-sort-id="portfolio" data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
                <li data-option-value="*" class="active"><a href="#">Show All</a></li>

                @foreach($categories as $category)
                    <li data-option-value=".{{ $category->slug }}"><a href="#">{{ $category->name }}</a></li>
                @endforeach

            </ul>

            <hr>

        </div>
        <div class="container">
            <div class="ml-xl mr-xl">

                <div class="row">

                    <div class="sort-destination-loader sort-destination-loader-showing">
                        <ul id="portfolioLoadMoreWrapper" class="portfolio-list sort-destination" data-sort-id="portfolio" load-pages="0" data-total-pages="{{$total_pages}}" style="height: 100%;">
                            <li class="isotope-item" style="display: none" id="0"></li>
                        </ul>
                    </div>
                    <div class="col-md-12">

                        <div id="portfolioLoadMoreLoader" class="portfolio-load-more-loader">
                            <div class="bounce-loader">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>

                        <button id="portfolioLoadMore" style="background-color: #212529;border-color: #212529 #212529 #0a0c0d;color: #FFF;" type="button" class="btn btn-3d btn-default btn-lg btn-block font-size-xs text-uppercase outline-none p-md mb-xl loadmore">Load More...</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop
@section('scripts')
    <script type="text/javascript">
        $( ".loadmore" ).trigger( "click" );
        {{--$('.loadmore').click(function () {--}}
            {{--$(this).hide();--}}
           {{--$(".portfolio-load-more-loader").show();--}}
           {{--var tot_val = $("#portfolioLoadMoreWrapper").attr('data-total-pages');--}}
           {{--var load_pages = $("#portfolioLoadMoreWrapper").attr('load-pages');--}}
           {{--load_pages++;--}}
            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '{{ route('look_portfolio') }}',--}}
                {{--data: {load_pages: load_pages},--}}

                {{--success: function (resp) {--}}
                    {{--// alert(resp);--}}
                    {{--$(".portfolio-load-more-loader").hide();--}}
                    {{--$('.loadmore').show();--}}
                    {{--$(".portfolio-list").append(resp);--}}
                    {{--$("#portfolioLoadMoreWrapper").attr('load-pages',load_pages);--}}
                    {{--$(".portfolio-list").attr("style","height: 100%; position: relative;");--}}


                {{--},--}}

            {{--});--}}
        {{--});--}}
    </script>
@endsection
