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
        <div class="card w-50 mx-auto">
            <div class="card-header">
                Register
            </div>
            <div class="card-body">
                <form id="reg_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="username" id= "username" class="form-control" placeholder="Enter Name">
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        <small id="e_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="pass-re">Password Re-Type</label>
                        <input type="password" name="re_pass" id="re_pass" class="form-control" placeholder="Password">
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="pass-re">Select User Type</label>
                        <select class="form-control form-control-sm" name="u_type" id = "u_type">
                            <option value="0">Choose User Type</option>
                            <option value="1">Admin</option>
                            <option value="2">Other</option>
                        </select>
                        <small id="t_error" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <p class="text-center">Already have an account? <a href="#" class="card-link">Login</a> Here</p>
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