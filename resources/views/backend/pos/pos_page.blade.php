@php
    use Gloudemans\Shoppingcart\Facades\Cart;
@endphp
@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                        </ol>
                                    </div>
                                    <h4 class="page-title" style="font-weight: bold;">POINT OF SALE</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    <div class="col-lg-6 col-xl-6">
        <div class="card text-center">
            <div class="card-body"> 

<div class="table-responsive">
<table class="table table-bordered mb-0" style="border: 1px solid black;">
            <thead>
                <tr>
                <th style="font-weight: bold; color: black;">Name</th>
<th style="font-weight: bold; color: black;">Quantity</th>
<th style="font-weight: bold; color: black;">Price</th>
<th style="font-weight: bold; color: black;">Total</th>
<th style="font-weight: bold; color: black;">Action</th>

                </tr>
            </thead>
@php
$allcart = Cart::content();
@endphp
<tbody>
<tbody>
    @foreach($allcart as $cart)
    <tr>
        <td style="color: black;"><strong>{{ $cart->name }}</strong></td>
        <td style="font-weight: bold; color: black;">
            <form method="post" action="{{ url('/cart-update/'.$cart->rowId) }}">
                @csrf
                <input type="number" name="qty" value="{{ $cart->qty }}" style="width:40px;" min="1">
                <input type="hidden" name="product_store" value="{{ $cart->options->product_store }}"> <!-- Available stock -->
                <button type="submit" class="btn btn-sm" style="margin-top:-2px; background-color: black; color: white;"> 
                    <i class="fas fa-check"></i> 
                </button>
            </form> 
        </td>
        <td style="font-weight: bold; color: black;">{{ $cart->price }}</td>
        <td style="font-weight: bold; color: black;">{{ $cart->price * $cart->qty }}</td>
        <td> <a href="{{ url('/cart-remove/'.$cart->rowId) }}"><i class="fas fa-trash-alt" style="color:black"></i></a> </td>
    </tr>
    @endforeach
</tbody>

</tbody>
</table>
</div>


    <div class="bg-primary" style="background-color: #D50000 !important;">
    <br>
        <p style="font-size:18px; color:#fff"> Quantity : {{ Cart::count() }} </p>
        <p style="font-size:18px; color:#fff"> Total : {{ Cart::subtotal() }} </p>
        <p style="font-size:18px; color:#fff"> TVA : {{ Cart::tax() }} </p>
        <p><h2 class="text-white"> Total </h2> <h1 class="text-white"> {{ Cart::total() }}</h1>   </p>
         <br>
    </div>
 <br>
    <form id="myForm" method="post" action="{{ url('/create-invoice') }}">
        @csrf
     
        <div class="form-group mb-3">
            <label for="firstname" class="form-label"><strong>All Customers </strong></label>



            <select name="customer_id" class="form-select" id="example-select">
                    <option selected disabled >Select Customer </option>
                    @foreach($customer as $cus)
        <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                     @endforeach
                </select>
           
        </div>
    
        <button class="btn btn-primary rounded-pill waves-effect waves-light" style="background-color: #1c1c1c; border-color: #1c1c1c; color: white;">
    <i class="fas fa-file-invoice-dollar"></i> Create Invoice
</button>

    </form>

            </div>                                 
        </div> <!-- end card -->

                            </div> <!-- end col-->

                            <div class="col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body"> 
                                    
    <!-- end timeline content-->

    <div class="tab-pane" id="settings">

           <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th> 
                                 <th> </th> 
                            </tr>
                        </thead>
                        <tbody>
    @foreach($product as $key => $item)
        @if($item->product_store > 0)
        <tr>
            <form method="post" action="{{ url('/add-cart') }}">
                @csrf

                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="name" value="{{ $item->product_name }}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="price" value="{{ $item->selling_price }}">

                <td>{{ $key+1 }}</td>
                <td><img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"></td>
                <td>{{ $item->product_name }}</td>
                <td><button type="submit" style="font-size: 20px; color: #000;"><i class="fas fa-plus-square"></i></button></td> 
            </form>
        </tr>
        @endif
    @endforeach
</tbody>

                    </table>

    </div>
    <!-- end settings content-->
    
                                       
                                    </div>
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                customer_id: {
                    required : true,
                }, 
                
            },
            messages :{
                customer_id: {
                    required : 'Please Select Customer',
                }, 
               

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            var isValid = true; // To track if everything is valid

            // Loop through each row of the cart table
            $('tbody tr').each(function() {
                var qty = $(this).find('input[name="qty"]').val(); // Get quantity from the form
                var productStore = $(this).find('input[name="product_store"]').val(); // Get available stock

                // Compare ordered quantity with available stock
                if (parseInt(qty) > parseInt(productStore)) {
                    isValid = false; 
                    toastr.error('Quantity for ' + $(this).find('strong').text() + ' exceeds available stock!');
                    e.preventDefault(); // Prevent form submission
                    return false; // Stop the loop if validation fails
                }
            });

            if (isValid) {
                this.submit(); // If everything is valid, submit the form
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>



@endsection