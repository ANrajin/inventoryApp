$(document).ready(function(){

    var DOMAIN = "http://localhost/inv/public_html/";
    
    //Manage category
    mngCategory(1);
    function mngCategory(pn){
        $.ajax({
            url: DOMAIN + 'includes/process.php',
            method: "POST",
            data: {mngCategory:1, pageNo: pn},
            success: function(data){
                $("#get_category").html(data);
            }
        })
    }


    $(document).delegate(".page-link", "click", function(){
        var pn = $(this).attr("pn");
        mngCategory(pn);
    })

    //Delete category
    $(document).delegate(".del_ct", "click", function(){
        var did = $(this).attr("did");
        
        if (confirm("Are sure to delete?")) {
            $.ajax({
                url: DOMAIN + "includes/process.php",
                method:"POST",
                data: {deleteCategory:1, id:did},
                success:function(data){
                    if (data == "DEPENDENT_CATEGORY") {
                        alert("Root category cannot be deleted");
                    }else if(data == "CATEGORY_DELETED"){
                        alert("Category deleted successfully");
                        mngCategory(1);
                    }else if(data == "DELETED"){
                        alert("Data successfully deleted");
                    }else{
                        alert(data);
                    }
                }
            })
        }
    })

    //update category
        
    //Fatch Category
    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN+'includes/process.php',
            method: 'POST',
            data: {getCategory:1},
            success: function(data){
                var root = "<option value='0'>Root</option>";
                $('#upd_parent').html(root+data);
            }
        })
    }

    $(document).delegate(".edit_ct", "click", function(){
        var eid = $(this).attr("eid");

        $.ajax({
            url: DOMAIN + "includes/process.php",
            method: "POST",
            data: {getReord: 1, id: eid},
            dataType: "json",
            success: function(data){
                //console.log(data);
                $("#cid").val(data["cat_id"]);
                $("#cat_name_upd").val(data["cat_name"]);
                $("#upd_parent").val(data["parent_cat"]);
            }
        })
    })

    $("#update_cat").on("submit", function(){
        if($('#cate').val() == ''){
            $('#cate').addClass('border-danger');
            $('#cate_error').html('<span class="text-danger">Please Write Category Name</span>');
        }else{
            $.ajax({
                url:DOMAIN + 'includes/process.php',
                method: 'POST',
                data: $('#update_cat').serialize(),
                success:function(data){
                    window.location.href = "";
                }
            })
        }
    })
})