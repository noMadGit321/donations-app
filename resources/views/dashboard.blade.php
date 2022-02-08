<x-header></x-header>
<div class="container">
    <div class="d-flex justify-content-between mt-5">
        <div class="card w-30">
            <div class="card-body bg bg-warning p-5 shadow-lg rounded">
                <h3 class="card-title">Highest donation</h3>
                <hr>
                <div class="card-text fs-5">
                    @if(!empty($maxDonationName) && !empty($maxDonation))
                        {{$maxDonationName}} -  {{$maxDonation}}$
                    @endif
                </div>
            </div>
        </div>
        <div class="card w-30">
            <div class="card-body bg bg-warning p-5 shadow-lg rounded">
                <h3 class="card-title">Current day</h3>
                <hr>
                <div class="card-text fs-5">
                    @isset($sumCurrentDay)
                        {{$sumCurrentDay}}$
                    @endisset
                </div>
            </div>
        </div>
        <div class="card w-30">
            <div class="card-body bg bg-warning p-5 shadow-lg rounded">
                <h3 class="card-title">Last month</h3>
                <hr>
                <div class="card-text fs-5">
                    @isset($sumLastMonth)
                        {{$sumLastMonth}}$
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div id="chart_div" class="d-flex justify-content-center mt-5 mb-5"></div>
    <div class="mb-2">
        <div class="row justify-content-center border-bottom border-3 border-secondary">
            <div class="col">Donator name</div>
            <div class="col">Donator email</div>
            <div class="col">Donation</div>
            <div class="col">Message</div>
            <div class="col">Date</div>
        </div>
        @foreach ($allItems as $item)
            <div class="row justify-content-center border-bottom @if($loop->last) border-3 @else border-1 @endif border-secondary">
                <div class="col">{{$item->name}}</div>
                <div class="col">{{$item->email}}</div>
                <div class="col">{{$item->donation}}$</div>
                <div class="col">{{$item->message}}</div>
                <div class="col">{{$item->created_at}}</div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{$allItems->links()}}
    </div>
</div>
<script> var data = @json($sumByDays)</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/googleChart.js') }}"></script>
