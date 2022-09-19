<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Invoice</title>
    
    <style>
        *{
	font-family: arial;
}
.invoice_container{
	padding: 10px 10px;
}
.invoice_header{
	display: flex;
	justify-content: space-between;
	width: 100%;
}
.logo_container{
	margin-top: auto;
	margin-bottom: auto;
	margin-left: 10px;
}
.company_address{
	margin-right: 10px;
    float: right;
}
.invoice_header h2{
	margin-bottom: 0;
}
.invoice_header p{
	margin-top: 10px;
}
.logo_container img{
	height: 60px;
}
.customer_container{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.customer_container h2{
	margin-bottom: 10px;
}
.customer_container h4{
	margin-bottom: 10px;
	margin-top: 0;
}
.customer_container p{
	margin: 0;
}
.in_details{
	margin-top: auto;
	margin-bottom: auto;
	width: 100%;
}
.tables{
    float: right;
}
.clearfix {
  overflow: auto;
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.product_container{
	padding: 0 10px;
	margin-top: 10px;
}
.item_table{
	width: 100%;
    text-align: left;
}
.item_table td,th{
	padding: 5px 10px;
}
.invoice_footer{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
    float: left;
}
.invoice_footer h2{
	margin-bottom: 10px;
}
.note{
	width: 670px;
    float: left;
}
.invoice_footer_amount{
    
	margin-top: 25px;
	background: #e7c9c9;
    float: right;
}
.amount_table td,th{
	padding: 5px 10px;
}
.in_head{
    margin: 0;
    text-align: center;
    background: #e7c9c9;
    padding: 5px;
}
table td{
	text-align: center;
}
.borderNone{

	border: none;
}
    </style>

</head>
<body>
    <div class="invoice_container" style="text-align: center;">
		<div class="customer_container">
			
			<div class="in_details">
				<h1 class="in_head" >
					@foreach($datewiseData as $index => $value) 
					@if ($index == 0) 
						 {{ Carbon\Carbon::parse($value->date)->format('d,M,Y') }} Total Sales
					@endif
				@endforeach
			</h1>
				<table class="tables">
					
				</table>
			</div>
		</div>
        <div class="clearfix"></div>

		<div class="product_container">
			<table class="item_table" border="1" cellspacing="0">
				<tr>
					<th style="text-align:center">Sl. No.</th>
					<th style="text-align:center">Invoice Number</th>
					<th style="text-align:center">Amount</th>
				</tr>
				@foreach ($datewiseData as $key=> $row)
				<tr>
					
					<td>{{++$key}}</td>
					<td>{{$row->invoice_number}}</td>
					<td>{{$row->paid_amount}} tk</td>
				
				</tr>
				@endforeach

				<tr>
					<th class="borderNone"></th>
					<th colspan="1" style="text-align:end">Total Amount:</th>
					<th style="text-align:center">{{$datewiseTotal}} BDT.</th>
				</tr>
				
			</table>
		</div>
	</div>
</body>
</html>