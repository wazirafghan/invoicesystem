<h2 style="text-align: center">{{$service_item->title}}</h2>
<div class="row">
    @foreach($service_item->itemimages as $image)
        <div class="col-sm-3">
            <img src="{{asset("uploads/service/$image->image")}}" alt="" width="100%">
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-sm-12">
        <p>{{$service_item->description}}</p>
        <p><?php echo $service_item->P_description ?></p>

    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        @foreach($service_item->itemquestions as $question)
            <div class="panel panel-default">
                <div class="panel-head">
                    <h5 >{{$question->title}}</h5>
                </div>
                <div class="panel-body" style="display: none">{{$question->description}}</div>
            </div>
        @endforeach


        <a href="{{url('service-item/'.$service_item->slug)}}" class="form-control btn btn-info" style="color: white;margin-top: 15px;">PLACE ORDER</a>
    </div>
</div>
