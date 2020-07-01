@extends('fontend.layout.admin')
@section('content')
<div class="span9">
    {{-- nhung the nay chi de DOM lay gia tri cho js ve bieu do, khong hien thi len trang --}}
    {{-- nam hien tai --}}
    <input readonly style="display: none" id="currentyear" type="text" value="{{$currentYear}}">
    <input readonly style="display: none" id="revenue1" type="text" value="{{$revenue[0]}}">
    <input readonly style="display: none" id="revenue2" type="text" value="{{$revenue[1]}}">
    <input readonly style="display: none" id="revenue3" type="text" value="{{$revenue[2]}}">
    <input readonly style="display: none" id="revenue4" type="text" value="{{$revenue[3]}}">
    <input readonly style="display: none" id="revenue5" type="text" value="{{$revenue[4]}}">
    <input readonly style="display: none" id="revenue6" type="text" value="{{$revenue[5]}}">
    <input readonly style="display: none" id="revenue7" type="text" value="{{$revenue[6]}}">
    <input readonly style="display: none" id="revenue8" type="text" value="{{$revenue[7]}}">
    <input readonly style="display: none" id="revenue9" type="text" value="{{$revenue[8]}}">
    <input readonly style="display: none" id="revenue10" type="text" value="{{$revenue[9]}}">
    <input readonly style="display: none" id="revenue11" type="text" value="{{$revenue[10]}}">
    <input readonly style="display: none" id="revenue12" type="text" value="{{$revenue[11]}}">

    {{-- nam truoc --}}
    <input readonly style="display: none" id="lastyear" type="text" value="{{$lastYear}}">
    <input readonly style="display: none" id="revenuelastyear1" type="text" value="{{$revenueLastYear[0]}}">
    <input readonly style="display: none" id="revenuelastyear2" type="text" value="{{$revenueLastYear[1]}}">
    <input readonly style="display: none" id="revenuelastyear3" type="text" value="{{$revenueLastYear[2]}}">
    <input readonly style="display: none" id="revenuelastyear4" type="text" value="{{$revenueLastYear[3]}}">
    <input readonly style="display: none" id="revenuelastyear5" type="text" value="{{$revenueLastYear[4]}}">
    <input readonly style="display: none" id="revenuelastyear6" type="text" value="{{$revenueLastYear[5]}}">
    <input readonly style="display: none" id="revenuelastyear7" type="text" value="{{$revenueLastYear[6]}}">
    <input readonly style="display: none" id="revenuelastyear8" type="text" value="{{$revenueLastYear[7]}}">
    <input readonly style="display: none" id="revenuelastyear9" type="text" value="{{$revenueLastYear[8]}}">
    <input readonly style="display: none" id="revenuelastyear10" type="text" value="{{$revenueLastYear[9]}}">
    <input readonly style="display: none" id="revenuelastyear11" type="text" value="{{$revenueLastYear[10]}}">
    <input readonly style="display: none" id="revenuelastyear12" type="text" value="{{$revenueLastYear[11]}}">

    {{-- het --}}

    <div class="content">
        <!--/.module-->
        <figure class="highcharts-figure">
        <div id="chart"></div>
        <p class="highcharts-description">
            This chart shows how data labels can be added to the data series. This
            can increase readability and comprehension for small datasets.
        </p>
        </figure>
    </div>
    <!--/.content-->
</div>
<!--/.span9-->
<script src="{{ asset('fontend/assets/js/highcharts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/exporting.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/export-data.js') }}" type="text/javascript"></script>
        <script src="{{ asset('fontend/assets/js/accessibility.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    //so lieu nam nay
    var currentYear = document.getElementById("currentyear").value;
    var revenue1 = document.getElementById("revenue1").value/1000000;
    var revenue2 = document.getElementById("revenue2").value/1000000;
    var revenue3 = document.getElementById("revenue3").value/1000000;
    var revenue4 = document.getElementById("revenue4").value/1000000;
    var revenue5 = document.getElementById("revenue5").value/1000000;
    var revenue6 = document.getElementById("revenue6").value/1000000;
    var revenue7 = document.getElementById("revenue7").value/1000000;
    var revenue8 = document.getElementById("revenue8").value/1000000;
    var revenue9 = document.getElementById("revenue9").value/1000000;
    var revenue10 = document.getElementById("revenue10").value/1000000;
    var revenue11 = document.getElementById("revenue11").value/1000000;
    var revenue12 = document.getElementById("revenue12").value/1000000;

    //so lieu nam truoc
    var lastYear = document.getElementById("lastyear").value;
    var revenueLastYear1 = document.getElementById("revenuelastyear1").value/1000000;
    var revenueLastYear2 = document.getElementById("revenuelastyear2").value/1000000;
    var revenueLastYear3 = document.getElementById("revenuelastyear3").value/1000000;
    var revenueLastYear4 = document.getElementById("revenuelastyear4").value/1000000;
    var revenueLastYear5 = document.getElementById("revenuelastyear5").value/1000000;
    var revenueLastYear6 = document.getElementById("revenuelastyear6").value/1000000;
    var revenueLastYear7 = document.getElementById("revenuelastyear7").value/1000000;
    var revenueLastYear8 = document.getElementById("revenuelastyear8").value/1000000;
    var revenueLastYear9 = document.getElementById("revenuelastyear9").value/1000000;
    var revenueLastYear10 = document.getElementById("revenuelastyear10").value/1000000;
    var revenueLastYear11 = document.getElementById("revenuelastyear11").value/1000000;
    var revenueLastYear12 = document.getElementById("revenuelastyear12").value/1000000;

    Highcharts.chart('chart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Revenue'
        },
        subtitle: {
            text: 'Source: SoftMart'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Revenue (million vnd)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: lastYear,
            data: [revenueLastYear1, revenueLastYear2, revenueLastYear3, revenueLastYear4, revenueLastYear5, revenueLastYear6, revenueLastYear7, revenueLastYear8, revenueLastYear9, revenueLastYear10, revenueLastYear11, revenueLastYear12]
        },
        {
            name: currentYear,
            data: [revenue1, revenue2, revenue3, revenue4, revenue5, revenue6, revenue7, revenue8, revenue9, revenue10, revenue11, revenue12]
        }]
    });
</script>
@endsection
