<div class="card w-30">
    <div class="card-body bg bg-warning p-5 shadow-lg rounded">
        <h3 class="card-title">{{$message}}</h3>
        <hr>
        <div class="card-text fs-5">
            @if (is_array($data) && count($data) == 2)
                {{$data['name']}} - {{$data['donation']}}$
            @else
                {{$data}}$
            @endif
        </div>
    </div>
</div>
