<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Invoice</title>
	{{-- <link rel="stylesheet" type="text/css" href="css/style.css"> --}}
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
		<div class="invoice_header">
			{{-- <div class="logo_container">
				<img src="https://webeecafe.com/public/assets/img/wclogo.png">
			</div> --}}
				<h2>Resturent Name</h2>
				<p>
					Resturent Description, Here <br>
					Thanks for the visiting Us<br>
					Or More Detais<br>
				</p>
		</div>
		<div class="customer_container">
			
			<div class="in_details">
				<h1 class="in_head">INVOICE</h1>
				<table class="tables">
					<tr>
						<td>Invoice No</td>
						<td>:</td>
						<td><b>#{{$order->invoice_number}}</b></td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td><b>{{$order->date}}</b></td>
					</tr>
					<tr>
						<td>Time</td>
						<td>:</td>
						<td><b>{{$order->created_at->format('h:i:s')}}</b></td>
					</tr>
					{{-- <tr>
						<td>Bill No</td>
						<td>:</td>
						<td><b>02500</b></td>
					</tr> --}}
				</table>
			</div>
		</div>
        <div class="clearfix"></div>

		<div class="product_container">
			<table class="item_table" border="1" cellspacing="0">
				<tr>
					<th>Sl. No.</th>
					<th>Item Name</th>
					<th>Unit Price</th>
					<th>Qty</th>
					<th>Price</th>
				</tr>
				@foreach ($orderdetials as $key=> $row)
				<tr>
					
					<td>{{++$key}}</td>
					<td>{{$row->item_name}}</td>
					<td>{{$row->unit_price}}</td>
					<td>{{$row->item_quantity}}</td>
					<td >{{$row->price}}</td>
				
				</tr>
				@endforeach

				<tr>
					<th class="borderNone"></th>
					<th class="borderNone"></th>
					<th colspan="2" >Total Amount</th>
					<th>{{$order->total_amount}}</th>
				</tr>
				<tr>
					<th class="borderNone"></th>
					<th class="borderNone"></th>
					<th colspan="2" >VAT(%)</th>
					<th></th>
				</tr>
				<tr>
					<th class="borderNone"></th>
					<th class="borderNone"></th>
					<th colspan="2">Discount Amount</th>
					<th>{{$order->discount_amount}}</th>
				</tr>
				<tr class="borderNone">
					<th class="borderNone"></th>
					<th class="borderNone"></th>
					<th colspan="2">Paid Amount</th>
					<th>{{$order->paid_amount}}</th>
				</tr>
				
			</table>
		</div>
		{{-- <div class="invoice_footer">
			<div class="note">
				<h2>Thank You Message!</h2>
				<p>
					 scrambled it to make a type specimen book.
				</p>
			</div>
			<div class="invoice_footer_amount">
				<table class="amount_table"   cellspacing="0">
					<tr>
						<td>Tax amount</td>
						<td>: <b>6000</b></td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td>: <b>160500</b></td>
					</tr>
					<tr>
						<td>Paid amount</td>
						<td>: <b>156000</b></td>
					</tr>
					<tr>
						<td>Due amount</td>
						<td>: <b>10000</b></td>
					</tr>
				</table>
			</div>
		</div> --}}
	</div>
</body>
</html>