$(document).ready(function(){

    var DOMAIN = "http://localhost/inv/public_html/";

    $('#reg_form').on('submit', function(){
        status = false;
        var name = $('#username');
        var email = $('#email');
        var pass1 = $('#pass');
        var pass2 = $('#re_pass');
        var type = $('#u_type');

        var n_pat = new RegExp(/^[A-Z a-z]+$/);
        var e_pat = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);

        if(name.val() == '' || name.val().lenght > 6){
            name.addClass('border-danger');
            $('#u_error').html('<span class = text-danger>Please enter your name more than 6 character long</span>');
            var status = false;
        }else{
            name.removeClass('border-danger');
            $('#u_error').html('');
            var status = true;
        }

        if(email.val() == '' || !e_pat.test(email.val())){
            email.addClass('border-danger');
            $('#e_error').html('<span class = text-danger>Please enter valid email address</span>');
            var status = false;
        }else{
            email.removeClass('border-danger');
            $('#e_error').html('');
            var status = true;
        }

        if(pass1.val() == '' || pass1.val().lenght > 9){
            pass1.addClass('border-danger');
            $('#p1_error').html('<span class = text-danger>Please enter more than 9 digit password</span>');
            var status = false;
        }else{
            pass1.removeClass('border-danger');
            $('#p1_error').html('');
            var status = true;
        }

        if(pass2.val() == '' || pass2.val().lenght > 9){
            pass2.addClass('border-danger');
            $('#p2_error').html('<span class = text-danger>Please enter more than 9 digit password</span>');
            var status = false;
        }else{
            pass2.removeClass('border-danger');
            $('#p2_error').html('');
            var status = true;
        }

        if((pass1.val() == pass2.val()) && status == true){
            $.ajax({
                url: DOMAIN + "includes/process.php",
                method: "POST",
                data: $("#reg_form").serialize(),
                success: function(data){
                    if(data == "Email_Already_Exists"){
                        alert("you typed an existing email");
                    }else if(data == "Error_Occured"){
                        alert('Error happaned');
                    }else{
                        window.location.href = encodeURI(DOMAIN + "index.php?msg=you are registered, now you can login");
                    }
                }
            })
        }else{
            pass2.addClass('border-danger');
            $('#p2_error').html("<span class = text-danger>Password doesn't matched</span>");
            var status = false;
        }

        if(type.val() == '' || type.val() <= 0){
            type.addClass('border-danger');
            $('#t_error').html('<span class = text-danger>Please choose user type</span>');
            var status = false;
        }else{
            type.removeClass('border-danger');
            $('#t_error').html('');
            var status = true;
        }
    })


    //login form
    $('#log_form').on('submit', function(){
        var email = $("#log_email");
        var pass = $("#log_pass");
        status = false;

        if(email.val() == ""){
            email.addClass('border-danger');
            $('#e_error').html('<span class = text-danger>Please enter valid email address</span>');
            var status = false;
        }else{
            email.removeClass('border-danger');
            $('#e_error').html('');
            var status = true;
        }
        
        if(pass.val() == ''){
            pass.addClass('border-danger');
            $('#p_error').html('<span class = text-danger>Please enter your password</span>');
            var status = false;
        }else{
            pass.removeClass('border-danger');
            $('#p_error').html('');
            var status = true;
        }

        if(status){
            $.ajax({
                url: DOMAIN + "includes/process.php",
                method: "POST",
                data: $("#log_form").serialize(),
                success: function(data){
                    if(data == "Not Registered"){
                        email.addClass('border-danger');
                        $('#e_error').html('<span class = text-danger>Seems you are not registered</span>');
                    }else if(data == "Password do not matched"){
                        pass.addClass('border-danger');
                        $('#p_error').html('<span class = text-danger>Please enter correct password</span>');
                        var status = false;
                    }else{
                        window.location.href = DOMAIN + "dashboard.php";
                    }
                }
            })
        }
    })

    //Fatch Category
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN+'includes/process.php',
            method: 'POST',
            data: {getCategory:1},
            success: function(data){
                var root = "<option value='0'>Root</option>";
                var choose = "<option>Choose Category</option>";
                $('#parent').html(root+data);
                $('#categ').html(choose+data);
            }
        })
    }

    //Fatch Brands
    fetch_brands();
    function fetch_brands(){
        $.ajax({
            url: DOMAIN+'includes/process.php',
            method: 'POST',
            data: {getBrands:1},
            success: function(data){
                var choose = "<option>Choose Brand</option>";
                $('#brand1').html(choose+data);
            }
        })
    }

    //Insert Category
    $('#form_cat').on('submit', function(){
        if($('#cate').val() == ''){
            $('#cate').addClass('border-danger');
            $('#cate_error').html('<span class="text-danger">Please Write Category Name</span>');
        }else{
            $.ajax({
                url:DOMAIN + 'includes/process.php',
                method: 'POST',
                data: $('#form_cat').serialize(),
                success:function(data){
                    if (data == 'CATEGORY_ADDED') {
                        $('#cate').val('');
                        $('#cate').removeClass('border-danger');
                        $('#cate_error').html('<span class="text-success">New category added successfully!!!</span>');
                        fetch_category();
                    }else{
                        $('#cate').val('');
                        $('#cate_error').html('<span class="text-danger">Duplicate entry not allowed!!!</span>');
                    }
                }
            })
        }
    })

    //add brands
    $('#form_brand').on('submit', function(){
        var brand = $('#brand').val();

        if(brand == ''){
            $('#brand').addClass('border-danger');
            $('#b_error').html('<span class="text-danger">Please Write Brand Name</span>');
        }else{
            $.ajax({
                url: DOMAIN + 'includes/process.php',
                method: 'POST',
                data: $('#form_brand').serialize(),
                success: function(data){
                    if (data == 'BRAND_ADDED') {
                        $('#brand').val('');
                        $('#brand').removeClass('border-danger');
                        $('#b_error').html('<span class="text-success">New brand added successfully!!!</span>');
                        fetch_brands();
                    }else{
                        $('#brand').val('');
                        $('#b_error').html('<span class="text-danger">Duplicate entry not allowed!!!</span>');
                    }
                }
            })
        }
    })

    //add products
    $('#form_prod').on('submit', function(){
        var date = $('#date').val();
        var pName = $('#pName').val();
        var categ = $('#categ').val();
        var brand1 = $('#brand1').val();
        var price = $('#price').val();
        var qty = $('#qty').val();


        $.ajax({
            url: DOMAIN + 'includes/process.php',
            method: 'POST',
            data: $('#form_prod').serialize(),
            success:function(data){
                if (data == "PRODUCTS_ADDED") {
                    $('#pName').val("");
                    $('#price').val("");
                    $('#qty').val("");

                    $("#mesg").append('<span class="text-success">New Products added successfully!!!</span>');
                }
            }
        })
    })
})