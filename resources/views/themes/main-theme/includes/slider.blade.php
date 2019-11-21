<div class="slider-container light rev_slider_wrapper" style="height: 700px;">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 700, 'disableProgressBar': 'on'}">
        <ul>
            @foreach($sliders as $slider)
            <li data-transition="fade">
                <img src="{{asset("uploads/sliders/$slider->pic_link")}}"
                     alt=""
                     data-bgposition="center 100%"
                     data-bgfit="cover"
                     data-bgrepeat="no-repeat"
                     class="rev-slidebg">

                <div class="tp-caption top-label tp-caption-custom-stripe"
                     data-x="right" data-hoffset="100"
                     data-y="bottom" data-voffset="100"
                     data-start="1000"
                     data-transform_in="x:[100%];opacity:0;s:1000;">{{$slider->title}}</div>
            </li>
            @endforeach
            {{--<li data-transition="fade">--}}
                {{--<img src="img/demos/construction/slides/slide-construction-2.jpg"--}}
                     {{--alt=""--}}
                     {{--data-bgposition="center 100%"--}}
                     {{--data-bgfit="cover"--}}
                     {{--data-bgrepeat="no-repeat"--}}
                     {{--class="rev-slidebg">--}}

                {{--<div class="tp-caption top-label tp-caption-custom-stripe"--}}
                     {{--data-x="right" data-hoffset="180"--}}
                     {{--data-y="bottom" data-voffset="100"--}}
                     {{--data-start="1000"--}}
                     {{--data-transform_in="x:[100%];opacity:0;s:1000;">MODERN OFFICES DESIGN</div>--}}
            {{--</li>--}}
        </ul>
    </div>
</div>
