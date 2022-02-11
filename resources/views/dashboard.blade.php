<x-header></x-header>
<div class="container">
    <div class="d-flex justify-content-between mt-5">
        @livewire('widget',['data' => ['name' => $maxDonationName, 'donation' => $maxDonation], 'type' => 1])
        @livewire('widget',['data' => $sumCurrentDay, 'type' => 2])
        @livewire('widget',['data' => $sumLastMonth, 'type' => 3])
    </div>
    <div id="chart_div" class="d-flex justify-content-center mt-5 mb-5"></div>
    @livewire('table', ['size' => $paginationSize])
</div>
@livewireScripts
<script> var data = @json($sumByDays)</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/googleChart.js') }}"></script>
