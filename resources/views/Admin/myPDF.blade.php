<!DOCTYPE html>
<html>
<head>
    <title>TTS Invoice</title>
</head>
<body>
<h1><b>{{ $title }}</b></h1>
<hr>
<table>
    <tr>
        <td>Item Name</td><td>{{$item_name}}</td>
    </tr>
    <tr>
        <td>Item Count</td><td>{{$item_sale_price}}</td>
    </tr>
    <tr>
        <td>Item Sale Price</td><td>{{$item_count}}</td>
    </tr>
    <tr>
        <td>Full Price</td><td>{{$price}}</td>
    </tr>
</table>
<p style="color: red">*make sure to bring the bill if you wanna return the items</p>
<p><b>Thank you..!</b></p>
</body>
</html>
