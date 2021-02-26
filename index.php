<?php
    include_once('database/constants.php');
    if(isset($_SESSION['user_id'])){
        header("location:".DOMAIN."dashboard.php");
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
        <div class="w-50 mx-auto text-center">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php 
                        echo $_GET['msg'];
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                }
            ?>
        </div>
        <div class="card  mx-auto" style="width: 24rem;">
            <img src="assets/images/login.png" class="card-img-top mx-auto py-4" alt="logo" style="width: 50%;">
            <div class="card-body">
                <p class="card-text">
                    <form id="log_form" onsubmit="return false">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="log_email" name = "email">
                            <small id="e_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="log_pass" name="pass">
                            <small id="p_error" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-unlock"></i> &nbsp Login</button>
                        <span><a href="">Register</a></span>
                        <p class="text-right"><a href="">Forget Password?</a></p>
                    </form>
                </p>
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
    <script src="assets/js/custom.js"></script>
</body>
</html>