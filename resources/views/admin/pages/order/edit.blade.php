@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Edit Order')

<meta name="csrf-token" content="{{ csrf_token() }}">


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">Edit Order Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('order_item.view')}}">All Order Invoice</a></li>
              <li class="breadcrumb-item active">Edit Order Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Error Massage -->
    <div class="container">
      <div class="row d-flex justify-content-center">
          <div class="col-6">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </div>
      </div>
  </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">

            <div class="card">
                @foreach($editData as $index => $row)
                    @if($index == 0)
                    <form action="{{route('order_item.update',$row->invoice_number)}}" method="post">
                    @endif
                @endforeach
                
        
            @csrf
                
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="invoice_number">Invoice Number</label>
                                @foreach($editData as $index => $row)
                                    @if($index == 0)
                                    <input type="text" readonly id="invoice_number" name="invoice_number" value="{{$row->invoice_number}}" class="form-control">
                                    @endif
                                @endforeach
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Invoice Date</label>
                                @foreach($editData as $index => $row)
                                @if($index == 0)
                                <input type="date" id="date" name="date" readonly value="{{$row->date}}" class="form-control" required>
                                @endif
                                @endforeach
                               
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cus_contact_number">Contact Number</label>
                                @foreach($editData as $index => $row)
                                @if($index == 0)
                                <input type="text" id="cus_contact_number" name="cus_contact_number" value="{{$row->cus_contact_number}}" class="form-control" readonly>
                                @endif
                                @endforeach
                                
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Table Number:</label>
                                @foreach($editData as $index => $row)
                                @if($index == 0)
                                <input type="text" required  name="table_number" class="form-control" value="{{$row->table_number}}" readonly>
                                @endif
                                @endforeach
                               
                                </div>
                        </div>
                    </div>

                        <div class="row add_item">
                            <div class="col-md-12">

                                <div class="row" >
                                    @foreach ($editData as $row)
                                        
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <label type="text" readonly  class="form-control typeahead"> {{$row->item_name}}</label>
                                            </div> 
                                        </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Unit Price</label>
                                            <label type="text" readonly   class="form-control">{{$row->unit_price}}</label>
                                        </div>  
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <label type="text" readonly  class="form-control">{{$row->item_quantity}}</label>
                                        </div>  
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <label type="text" readonly class="form-control subtotal">{{$row->price}}</label>
                                        </div>  
                                    </div> 

                                    

                                    {{-- <div class="col-md-1">
                                        <div class="form-group">
                                            <div for="inputprice" class="text-center mt-2">Add More</div>
                                            <a href="" class="btn btn-primary form-control addrow"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>  --}}
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <div for="inputprice" class="text-center mt-2">Delele</div>
                                            <a  data-id="{{ $row->id }}" class="btn btn-danger form-control deleteRecord"><i class="fa fa-minus"></i></a>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>

                                <div class="row add_item">
                                    <div class="col-md-12">
        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="typeahead_1">Item Name</label>
                                                    <input type="text" id="typeahead_1" onkeyup="return autocompletess(1)" name="item_name[]"   class="form-control typeahead">
                                                    </div> 
                                                </div>
        
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="price_1">Unit Price</label>
                                                    <input type="text" id="price_1" onkeyup="return price(1)" name="unit_price[]"  class="form-control">
                                                </div>  
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="text" id="qty_1" onkeyup="return qty(1)" name="item_quantity[]"  class="form-control ">
                                                </div>  
                                            </div>
        
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" id="subtotal_1" name="price[]" class="form-control subtotal">
                                                </div>  
                                            </div> 
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <div for="inputprice" class="text-center mt-2">Add More</div>
                                                    <a href="" class="btn btn-primary form-control addrow"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div> 
                                        </div>
        
                                        <div id="showItem"></div>
                                        
                                    </div>
                                    
                                </div>  


                                
                            </div>
                            
                        </div>  
                        
                        <div class="row mt-3">
                            <div class="col-md-6"> </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="totalamounval">Total Amount</label>
                                    <input type="text" readonly id="totalamounval" name="total_amount" value="{{$total}}"  class="form-control">
                                    </div>
                            </div>
                            <div class="col-md-2"> </div>

                            <div class="col-md-6"> </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount_amount">Discount Amount</label>
                                        <input type="text" name="discount_amount" id="discount_amount" value="0" class="form-control">
                                    </div>
                            </div>

                            <div class="col-md-6"> </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="delivery_charge">Delivery Charge</label>
                                        <input type="text" name="delivery_charge" id="delivery_charge" value="0" class="form-control">
                                    </div>
                            </div>

                            <div class="col-md-6"> </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paid_amount">Grand Total</label>
                                        <input type="text" readonly name="paid_amount" id="paid_amount" value="{{$total}}" class="form-control">
                                    </div>
                            </div>

                           
                        </div>
                        
                        
                    </div>
                <div class="modal-footer text-center">
                <button type="submit" id="redirectOrderList"  class="btn btn-primary">Order Update</button>
                <a id="receptOrder"  class="btn btn-primary">Recept</a>
                </div>
            </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



  {{-- recept order --}}
  <script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#receptOrder").click(function(e){

        e.preventDefault();

        
        var invoice_number = $("input[name=invoice_number]").val();
        var discount_amount = $("input[name=discount_amount]").val();
        var delivery_charge = $("input[name=delivery_charge]").val();
        var url = '{{ url('order_item_receptsss') }}';

        $.ajax({
           url:url,
           type:"POST",

           data:{
            "_token": "{{ csrf_token() }}",
            invoice_number:invoice_number, 
            discount_amount:discount_amount, 
            delivery_charge:delivery_charge,
                },
           success:function(response){
              if(response.success){
                window.location.href = '{{ route('order_item.view') }}';
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
	});

</script>




  <script type="text/javascript">

    function autocompletess(id){
        var path = "{{ route('autocomplete.item') }}";
    
        $( "#typeahead_"+id ).autocomplete({
    
    source: function( request, response ) {
    
      $.ajax({
    
        url: path,
    
        type: 'GET',
    
        dataType: "json",
    
        data: {
    
           search: request.term
    
        },
    
        success: function( data ) {
    
           response( data );
    
        }
    
      });
    
    },
    
    select: function (event, ui) {
    
       $('#typeahead_'+id).val(ui.item.label);
       $('#price_'+id).val(ui.item.price);
    
       console.log(ui.item); 
    
       return false;
    
    }
    
    });
    
    }
    
    </script>



<script>
    $(".deleteRecord").click(function(e){
        e.preventDefault;
    var id = $(this).data("id");
    
   
    $.ajax(
    {
        url: '{{url('order_item_delete')}}/'+id,
        type: 'DELETE',
        data: {
            "id": id,
            _token: '{!! csrf_token() !!}',
        },
        success: function (){
           window.location = window.location
        }
    });
   
});
</script>


  <script>

    	/**When keyup qty Field this function Run*/
	function qty(id)

	{
		var qty = $('#qty_'+id).val();
		var price = $('#price_'+id).val();
		var total = $('#totalamounval').val();
		var result = Number(qty)*Number(price);
		$('#subtotal_'+id).val(result);
		total_price();
	}
	/**When keyup price Field this function Run*/
	function price(id)

	{

		var qty = $('#qty_'+id).val();
		var price = $('#price_'+id).val();
		var total = $('#totalamounval').val();
		var result = Number(qty)*Number(price);
		$('#subtotal_'+id).val(result);
		var totalamount = Number(result)+Number(total);
		$('#totalamounval').val(totalamount);
		total_price();
	}
	/**call every keyup from any function*/
	function total_price()
	{
		var total = 0;
		$('input.subtotal').each(function() {
				total +=Number($(this).val()); 
                total +={{$total}};
		});
		$('#totalamounval').val(total);
		$('#paid_amounts').val(total);
	}

     /** due amount*/
     $(document).ready(function() {
    $(function() {
    $("#totalamounval, #discount_amount").on("keydown keyup", sub);
    function sub() {
    $("#paid_amount").val(Number($("#totalamounval").val()) - Number($("#discount_amount").val()) + Number($("#delivery_charge").val()));
    }
    });    

    });

     /** Delevery Charge amount*/
     $(document).ready(function() {
    $(function() {
    $("#delivery_charge").on("keydown keyup", subss);
    function subss() {
    $("#paid_amount").val(Number($("#totalamounval").val()) - Number($("#discount_amount").val()) + Number($("#delivery_charge").val()));
    }
    });    

    });


	/*Add Row Item*/
	$(document).ready(function(){                      
		var i = 1;
		$('.addrow').click(function()
			{
                i++;
				html ='';
				html +='<div id="remove_'+i+'" class="row">';
	            html +='<div class="col-md-3"><div class="form-group"><label for="product_name">Item Name</label><input type="text" id="typeahead_'+i+'" onkeyup="return autocompletess('+i+')" name="item_name[]"  class="form-control"></div></div>';
	            // html +='<div class="col-md-2"><div class="form-group"><label for="quantity">Item Quantity</label><input type="text" id="quantity" name="item_quantity[]" class="form-control"></div></div>';
	            html +='<div class="col-md-3"><div class="form-group"><label for="price_1">Unit Price</label><input type="text" id="price_'+i+'" onkeyup="return price('+i+')" name="unit_price[]"  class="form-control"></div></div>';
                html +='<div class="col-md-3"><div class="form-group"><label>Quantity</label><input type="text" id="qty_'+i+'" onkeyup="return qty('+i+')" name="item_quantity[]" class="form-control"></div></div>';
                html +='<div class="col-md-2"><div class="form-group"><label>Price</label><input type="text" id="subtotal_'+i+'" name="price[]" class="form-control subtotal"></div>  </div> ';
                html +='<div class="col-md-1"><div class="form-group"><div for="inputprice" class="text-center mt-2">remove</div><a href="" onclick="return remove('+i+')" class="btn btn-danger form-control "><i class="fa fa-minus"></i></a></div>';
	            html +='</div>';
	            $('#showItem').append(html);

                event.preventDefault();
			});
            
	});
	function remove(id)

	{
        event.preventDefault();
		$('#remove_'+id).remove();
		total_price();
	}
  </script>


<script>



$('#redirectOrderList').on('submit', function(event) {
    
    window.location.href = 'https://www.google.com';
    event.preventDefault(); 
    var url = $(this).data('target');
    location.replace('https://www.google.com');
});
</script>







@endsection
@endif