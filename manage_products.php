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
<br>
    <div class="container">
    	<table class="table table-hover">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Product Name</th>
              <th scope="col">Category</th>
		      <th scope="col">Brand</th>
              <th scope="col">Price</th>
              <th scope="col">Stock</th>
              <th scope="col">Added Date</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody id="get_product">
<!-- 		  	<tr>
			  	<td>1</td>
			  	<td>Electronics</td>
			  	<td>Root</td>
			  	<td><a href="" class="btn btn-success btn-sm">Active</a></td>
			  	<td>
			  		<a href="" class="btn btn-sm btn-primary">Edit</a>
			  		<a href="" class="btn btn-sm btn-danger">Delete</a>
			  	</td>
		  	</tr> -->
		  </tbody>
		</table>
    </div>

    <?php
        include_once("templates/update_product.php");
    ?>

    <!-- jquery-3 -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>

    <!-- bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
            crossorigin="anonymous">
    </script>

    <!-- default -->
    <script src="assets/js/mngProducts.js"></script>
</body>
</html>
