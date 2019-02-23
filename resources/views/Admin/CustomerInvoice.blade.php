<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>
<h1><b>Tuk Tuk Service - Invoice</b></h1>
<hr>

<table>
    <tr>
        <th>Item Name</th>
        <th>Item Code</th>
        <th>Item Count</th>
        <th>Item Sale Price</th>
        <th>Bill Description</th>
        <th>Cost</th>
    </tr>
@foreach($invoice_detail as $row)
    <tr>
        <td>{{$row['item_name']}}</td>
        <td>{{$row['item_code']}}</td>
        <td>{{$row['item_count']}}</td>
        <td>{{$row['item_sale_price']}}</td>
        <td>{{$row['invoice_desc']}}</td>
        <td>{{$row['cost']}}</td>

    </tr>

@endforeach

</table>
<h4>Total : {{$full_price}} </h4>

<p style="color: red">*make sure to bring the bill if you wanna return the items</p>
<p><b>Thank you..!</b></p>

</body>
</html>
