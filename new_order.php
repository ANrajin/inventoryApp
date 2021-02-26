<?php
    include_once('database/constants.php');
    if(!isset($_SESSION['user_id'])){
        header("location:".DOMAIN);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>

    <!-- bootstarp -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- default -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
    <?php
        //navbar
        require_once('templates/header.php');
    ?>

    <div class="container w-75">
    	<div class="card mx-auto my-4" style="box-shadow: 0 0 25px 0 lightgray;">
		  <div class="card-header">
		    <h3>New Order</h3>
		  </div>
		  <div class="card-body" align="right">
		  	<form onsubmit="return false" id="get_orders">
		  		<div class="form-group row">
		  			<label class="col-md-3">Date</label>
		  			<div class="col-md-6">
		  				<input type="text"  class="form-control form-control-sm" name="date" readonly value="<?php echo date('d-m-Y')?>">
		  			</div>
		  		</div>

		  		<div class="form-group row">
		  			<label class="col-md-3">Customer Name</label>
		  			<div class="col-md-6">
		  				<input type="text"  class="form-control form-control-sm" id="cName" name="cName" value="" required>
		  			</div>
		  		</div>

		  		<div  class="card" align="center" style="box-shadow: 0 0 10px 0 lightgray;">
		  			<div class="card-header">
		  				<h4 align="center">Make Order List</h4>
		  			</div>
		  			<div class="card-body">
		  				<table class="table-bordered">
		  					<thead class="text-center">
		  						<th>#</th>
		  						<th>Item Name</th>
		  						<th>Total Quantity</th>
		  						<th>Quantity</th>
		  						<th>Price</th>
		  						<th>Total</th>
		  					</thead>

		  					<tbody id="invoice-item">

		  					</tbody>
		  				</table>
		  				<div class="py-3">
		  					<button type="button" id = "add" class="btn btn-sm btn-info">Add</button>
		  					<button type="button" id = "remove" class="btn btn-sm btn-danger">Remove</button>
		  				</div>
		  			</div>
		  		</div>

		  				<div class="py-4" align="right">
		  					<div class="form-group row">
					  			<label class="col-md-3">Sub Total</label>
					  			<div class="col-md-6">
					  				<input type="text" id = "sub"  class="form-control form-control-sm" name="sub" value="" readonly>
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Tax(15%)</label>
					  			<div class="col-md-6">
					  				<input type="text" id="tax"  class="form-control form-control-sm" name="tax" value="" readonly>
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Discount</label>
					  			<div class="col-md-6">
					  				<input type="text" id="dis" class="form-control form-control-sm" name="dis" value="">
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Net Total</label>
					  			<div class="col-md-6">
					  				<input type="text" id="net" class="form-control form-control-sm" name="net" value="" readonly>
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Paid</label>
					  			<div class="col-md-6">
					  				<input type="text" id="paid" class="form-control form-control-sm" name="paid" value="">
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Due</label>
					  			<div class="col-md-6">
					  				<input type="text" id="due" class="form-control form-control-sm" name="due" value="" readonly>
					  			</div>
					  		</div>
					  		<div class="form-group row">
					  			<label class="col-md-3">Payment Method</label>
					  			<div class="col-md-6">
		  							<select class="form-control form-control-sm" name="pm" required>
		  								<option>Select Item</option>
		  								<option>Cash</option>
		  							</select>
					  			</div>
					  		</div>
		  				</div>

		  		<center>
		  			<button type="submit" class="btn btn-sm btn-primary" id="order_form">Order</button>
		  			<button type="submit" class="btn btn-sm btn-secondary" id="print_invoice">Print</button>
		  		</center>
		  	</form>
		  </div>
		</div>
    </div>	

    <!-- jquery-3 -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>

    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
            crossorigin="anonymous">
    </script>

    <!-- default -->
    <script src="assets/js/order.js"></script>
</body>
</html>