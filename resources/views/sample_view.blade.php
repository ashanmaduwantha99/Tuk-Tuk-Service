<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chart with VueJS</title>

</head>
<body>
<div id="app1">
    {!! $chart1->container() !!}
</div>
<div id="app">
    {!! $chart->container() !!}
</div>
<script src="https://unpkg.com/vue"></script>
<script>
    var app1 = new Vue({
        el: '#app1',
    });
    var app = new Vue({
        e2: '#app',
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $chart1->script() !!}
{!! $chart->script() !!}

</body>
</html>
