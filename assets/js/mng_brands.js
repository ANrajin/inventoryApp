$(document).ready(function(){

	var DOMAIN = "http://localhost/inv/public_html/";

	//Manage category
    mngBrands(1);
    function mngBrands(pn){
        $.ajax({
            url: DOMAIN + 'includes/process.php',
            method: "POST",
            data: {mngBrands:1, pageNo: pn},
            success: function(data){
                $("#get_brand").html(data);
            }
        })
    }

    $(document).delegate(".page-link", "click", function(){
        var pn = $(this).attr("pn");
        mngBrands(pn);
    })


    //Delete Brands
    $(document).delegate(".del_brand", "click", function(){
        var did = $(this).attr("did");
        
        if (confirm("Are sure to delete?")) {
            $.ajax({
                url: DOMAIN + "includes/process.php",
                method:"POST",
                data: {deleteBrand:1, id:did},
                success:function(data){
                    if(data == "DELETED"){
                        alert("Data successfully deleted");
                        mngBrands(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    })


    //Update Brand
    $(document).delegate('.edit_brand', "click", function(){

    	var bid = $(this).attr('eid');

    	$.ajax({
    		url: DOMAIN + "includes/process.php",
    		method: "POST",
    		dataType: "json",
    		data: {getRecord:1, id:bid},
    		success: function(data){
    			//console.log(data);
    			$("#update_bid").val(data["bid"]);
    			$("#update_brand").val(data["brand_name"]);
    		}
    	})
    })


    //edit brand
    $("#form_brand_update").submit(function(){
    	$.ajax({
    		url: DOMAIN + "includes/process.php",
    		method:"POST",
    		data: $("#form_brand_update").serialize(),
    		success: function(data){
    			window.location.href = "";
    		}
    	})
    })

});