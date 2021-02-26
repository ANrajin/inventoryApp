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

    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-primary mx-auto" style="width: 18rem;">
                    <img class="card-img-top w-50 mx-auto py-3" src="assets/images/user.png" alt="user">
                    <div class="card-body">
                        <h5 class="card-title">Profile Info</h5>
                        <p class="card-text"><i class="fa fa-user">&nbsp</i>Rajin</p>
                        <p class="card-text"><i class="fa fa-user">&nbsp</i>Admin</p>
                        <p class="card-text">Last Login: yyyy-mm-dd</p>
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit">&nbsp</i>Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <h2 class="bg-light w-100 py-3 my-2 text-center">Welcome Admin</h2>
                </div>
                <div class="row">
                    <div class="col-md-6 py-2">
                        <div class="card border-success mx-auto" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Products</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Add or Manage your Products</h6>
                                <a href="#" class="card-link btn btn-primary" data-toggle="modal" data-target="#products"><i class="fa fa-plus">&nbsp</i>Add</a>
                                <a href="manage_products.php" class="card-link btn btn-success"><i class="fa fa-edit">&nbsp</i>Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 py-2">
                        <div class="card border-success mx-auto" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Brands</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Add or Manage your Brands</h6>
                                <a href="#" class="card-link btn btn-primary" data-toggle="modal" data-target="#brands"><i class="fa fa-plus">&nbsp</i>Add</a>
                                <a href="manage_brands.php" class="card-link btn btn-success"><i class="fa fa-edit">&nbsp</i>Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 py-2">
                        <div class="card border-success mx-auto" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Categories</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Add or Manage your Categories</h6>
                                <a href="#" class="card-link btn btn-primary" data-toggle="modal" data-target="#category"><i class="fa fa-plus">&nbsp</i>Add</a>
                                <a href="manage_categories.php" class="card-link btn btn-success"><i class="fa fa-edit">&nbsp</i>Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 py-2">
                        <div class="card border-success mx-auto" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Orders</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Add or Manage your Orders</h6>
                                <a href="new_order.php" class="card-link btn btn-primary"><i class="fa fa-plus">&nbsp</i>New Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        //category
        include_once('templates/category.php');
        include_once('templates/brands.php');
        include_once('templates/products.php');
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
    <script src="assets/js/custom.js"></script>
</body>
</html>