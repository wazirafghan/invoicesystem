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

        <div class="row pt-sm">
            <div class="col-md-12">
                <div class="blog-posts single-post mt-xl">

                    <article class="post post-large blog-single-post">

                        <div class="post-date">
                            <span class="day">{{$post->created_at->format('d')}}</span>
                            <span class="month">{{$post->created_at->format('M')}}</span>
                        </div>

                        <div class="post-content">

                            <h1 class="mb-md">{{$post->title}}</h1>

                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> By <a href="#">{{ $post->admin->name }}</a> </span>
                                <span><i class="fa fa-tag"></i> @foreach($tags as $tag)<a href="#">{{$tag->name}}</a>,@endforeach</span>
                                {{--<span><i class="fa fa-comments"></i> <a href="#">12 Comments</a></span>--}}
                            </div>
                            @if(File::exists('uploads/post/'.$post->featured_image))
                                <img src="{{asset('uploads/post/'.$post->featured_image)}}" class="img-responsive pull-right mb-md mb-xs ml-xl" alt="" style="width: 360px;">
                            @else
                                <img class="img-fluid rounded" src="http://placehold.it/750x300" alt="">
                            @endif

                            {{$post->content}}

                            <div class="pt-sm pb-xs">
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style">
                                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                    <a class="addthis_button_tweet"></a>
                                    <a class="addthis_button_pinterest_pinit"></a>
                                    <a class="addthis_counter addthis_pill_style"></a>
                                </div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
                                <!-- AddThis Button END -->
                            </div>

                            {{--<div class="post-block post-author mt-xl clearfix">--}}
                                {{--<h4 class="mt-xl mb-md">Author</h4>--}}
                                {{--<div class="img-thumbnail">--}}
                                    {{--<a href="blog-post.html">--}}
                                        {{--<img src="img/team/team-22.jpg" alt="">--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<p><strong class="name mb-md">John Doe</strong></p>--}}
                                {{--<p class="mt-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat.</p>--}}
                            {{--</div>--}}

                            <div class="post-block post-comments clearfix">
                                <h4 class="mt-xl mb-md">Comments</h4>

                                <ul class="comments">
                                    @foreach($post->comments as $comment)
                                        @if($comment->approved)
                                            <li>

                                            <!-- Single Comment -->
                                                {{--<div class="media mb-4">--}}
                                                    {{--<div class="media-body">--}}
                                                        {{--<h5 class="mt-0">{{ $comment->name or '' }}</h5>--}}
                                                        {{--{{ $comment->comment or '' }}--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="rounded-circle" style="width: 50px" src="{{"https://www.gravatar.com/avatar/". md5(strtolower(trim($comment->email)))}}" alt="">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
																<strong>{{$comment->name}}</strong>
																<span class="pull-right">
																	{{--<span> <a href="#"><i class="fa fa-reply"></i> Reply</a></span>--}}
																</span>
                                                        </span>
                                                        <p>{{$comment->comment}}</p>
                                                        <span class="date pull-right">{{$comment->created_at->format("M-d-Y")}}</span>
                                                    </div>
                                                </div>
                                            </li>

                                        @endif
                                    @endforeach


                                </ul>

                            </div>

                            <div class="post-block post-leave-comment mb-xl">
                                <h4 class="mt-xl mb-md">Leave a Comment</h4>

                                <form action="{{url('comments',$post->id)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Your name *</label>
                                                <input type="text" value="" maxlength="100" class="form-control" name="name" id="name">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Your email address *</label>
                                                <input type="email" value="" maxlength="100" class="form-control" name="email" id="email">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Website *</label>
                                                <input type="text" value="" maxlength="100" class="form-control" name="website" id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Comment *</label>
                                                <textarea maxlength="5000" rows="10" class="form-control" name="comment" id="comment"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Post Comment" class="btn btn-primary btn-lg" data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </article>

                </div>
            </div>
        </div>

    </div>
@endsection
