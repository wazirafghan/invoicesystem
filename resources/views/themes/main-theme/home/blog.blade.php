@extends('themes.main-theme.layouts.master')
@section('content')
    <section class="section section-tertiary section-no-border pb-md mt-none">
        <div class="container">
            <div class="row mt-xl">
                <div class="col-md-10 col-md-offset-2 pt-xlg mt-xlg align-right">
                    <h1 class="text-uppercase font-weight-light mt-xl text-color-primary">Blog</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="row mb-xl">
            @foreach($posts as $post)

                    <div class="col-md-6">
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
            @endforeach
        </div>

    </div>
@endsection
