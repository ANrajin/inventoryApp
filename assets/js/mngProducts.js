$(document).ready(function(){

	//manage products
	var DOMAIN = "http://localhost/inv/public_html/";

	mngProducts(1);
	function mngProducts(pn){
		$.ajax({
            url: DOMAIN + 'includes/process.php',
            method: "POST",
            data: {mngProduct:1, pageNo: pn},
            success: function(data){
                $("#get_product").html(data);
                //console.log(data);
            }
        })
	}

	//pagination
	$(document).delegate(".page-link", "click", function(){
        var pn = $(this).attr("pn");
        mngProducts(pn);
    })


    //Delete category
    $(document).delegate(".del_prod", "click", function(){
        var did = $(this).attr("did");
        
        if (confirm("Are sure to delete?")) {
            $.ajax({
                url: DOMAIN + "includes/process.php",
                method:"POST",
                data: {deleteProduct:1, id:did},
                success:function(data){
                    if(data == "DELETED"){
                        alert("Data successfully deleted");
                        mngProducts(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    })


    //update products
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN+'includes/process.php',
            method: 'POST',
            data: {getCategory:1},
            success: function(data){
                var root = "<option value='0'>Root</option>";
                $('#categ').html(root+data);
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

    $(document).delegate(".edit_prod", "click", function(){
        var eid = $(this).attr("eid");

        $.ajax({
            url: DOMAIN + "includes/process.php",
            method: "POST",
            data: {getP_Record: 1, id: eid},
            dataType: "json",
            success: function(data){
                //console.log(data);
                $("#pid").val(data["pid"]);
                $("#pName").val(data["product_name"]);
                $('#categ').val(data["cat_id"]);
                $('#brand1').val(data["bid"]);
                $('#price').val(data["product_price"]);
                $('#qty').val(data["product_stock"]);
            }
        })
    })


    //update products
    $('#form_prod_update').on('submit', function(){
        $.ajax({
            url: DOMAIN + 'includes/process.php',
            method: 'POST',
            data: $('#form_prod_update').serialize(),
            success:function(data){
            	window.location.href = "";
            }
        })
    })
})