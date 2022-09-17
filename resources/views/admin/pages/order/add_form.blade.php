@if ( Auth::user()->role == 'admin' || Auth::user()->role == 'buyer')
@extends('admin.layouts.master')
@section('title','Order Invoice')


@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="float-right">Order Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('order_item.view')}}">All Order Invoice</a></li>
              <li class="breadcrumb-item active">Order Invoice</li>
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
                
        <form action="{{route('order_item.store')}}" method="post">
            @csrf
                
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoice_number">Invoice Number</label>
                                <input type="text" readonly id="invoice_number" name="invoice_number" value="{{$invoice_number}}" class="form-control">
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Invoice Date</label>
                                <input type="date" id="date" name="date" readonly value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Table Number:</label>
                                <input type="text" required  name="table_number" class="form-control" placeholder="Type Table Number...">
                                </div>
                        </div>
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
                                    
        
                                    {{-- <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="item_quantity">Item Quantity</label>
                                            <input type="text" id="quantity" name="item_quantity[]" value="{{old('item_quantity')}}" class="form-control">
                                            </div>
                                    </div> --}}

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
                                <div class="col-md-12">
                                  <hr>
                                </div>
                            </div>
                            
                        </div>  
                        
                        <div class="row mt-3">
                            <div class="col-md-6"> </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="totalamounval">Total Amount</label>
                                    <input type="text" readonly id="totalamounval" name="total_amount" class="form-control">
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
                                        <label for="paid_amount">Paid Amount</label>
                                        <input type="text" readonly name="paid_amount" id="paid_amount" class="form-control">
                                    </div>
                            </div>

                           
                        </div>
                        
                        
                    </div>
                <div class="modal-footer text-center">
                <button type="submit" id="redirectOrderList" data-target="https://stackoverflow.com/"  class="btn btn-primary">Submit</button>
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
		});
		$('#totalamounval').val(total);
		$('#paid_amount').val(total);
	}

     /** due amount*/
     $(document).ready(function() {
    $(function() {
    $("#totalamounval, #discount_amount").on("keydown keyup", sub);
    function sub() {
    $("#paid_amount").val(Number($("#totalamounval").val()) - Number($("#discount_amount").val()));
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
//     $('#redirectOrderList').submit(function() {
//         window.location.href = "https://stackoverflow.com/";

// });


$('#redirectOrderList').on('submit', function(event) {
    
    window.location.href = 'https://www.google.com';
    event.preventDefault(); 
    var url = $(this).data('target');
    location.replace('https://www.google.com');
});
</script>


    {{-- <script type="text/javascript">

$(document).ready(function(){


    $("#redirectOrderList").on('click', function (e) {
        e.preventDefault();
        $.ajax({
            
    
    url:'{{route('order_item.view')}}';

    type: 'GET',

    dataType: "json",


  }); --}}
{{-- //    window.location.href = '{{route('order_item.view')}}';
   //stop form submission
//    e.preventDefault();
// });



    //         $(document).on("click", "#redirectOrderList", function() {
    //             if ($('#test2').is(':visible')) {
    //                 $('#test2').hide();
    //             } else {
    //                 $('#test2').show();
    //             };
    //         });
    //     });



    //     $('#redirectOrderList').submit(function() {
    // window.location.href = '{{route('order_item.view')}}';
    // return false;
// });
// </script> --}}




@endsection
@endif