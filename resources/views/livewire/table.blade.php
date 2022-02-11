<div>
    <div class="row justify-content-center border-bottom border-3 border-secondary">
        <div class="col">Donator name</div>
        <div class="col">Donator email</div>
        <div class="col">Donation</div>
        <div class="col">Message</div>
        <div class="col">Date</div>
    </div>
    <div>
        @foreach ($data as $item)
            <div class="row justify-content-center border-bottom @if($loop->last) border-3 @else border-1 @endif border-secondary">
                <div class="col">{{$item->name}}</div>
                <div class="col">{{$item->email}}</div>
                <div class="col">{{$item->donation}}$</div>
                <div class="col">{{$item->message}}</div>
                <div class="col">{{$item->created_at}}</div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{$data->links()}}
    </div>
</div>
