$(document).ready(function(){
	var DOMAIN = "http://localhost/inv/public_html/";
	addNewRow();

	$("#add").on("click", function(){
		addNewRow();
	})

	$("#remove").on("click", function(){
		$("#invoice-item").children("tr:last").remove();
		calculate(0,0);
	})

	function addNewRow(){
		$.ajax({
			url: DOMAIN + "includes/process.php",
			method: "POST",
			data: {getNewOrderItem:1},
			success: function(data){
				$("#invoice-item").append(data);
				var i = 1;
				$(".number").each(function(){
					$(this).html(i++);
				})
			}
		})
	}


	$("#invoice-item").delegate(".pid", "change", function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();

		$.ajax({
			url: DOMAIN + "includes/process.php",
			method:"POST",
			data: {getPriceQty:1, id: pid},
			dataType: "json",
			success: function(data){
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(1);
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
				calculate(0, 0);
			}
		})
	})

	$("#invoice-item").delegate(".qty", "keyup", function(){
		var qty = $(this);
		var tr = $(this).parent().parent();

		if(isNaN(qty.val())){
			alert("Please Insert a valid quantity");
			qty.val(1);
		}else{
			if((qty.val() - 0) > (tr.find(".tqty").val() - 0)){
				alert("Sorry this much quantity is not available");
				qty.val(1);
			}else{
				price = tr.find(".price").val();
				qty = qty.val();

				tr.find(".amt").html(price * qty);
				calculate(0, 0);
			}
		}
	})

	function calculate(dis, paid){
		var sub_total = 0;
		var tax = 0;
		var net = 0;
		var disc = dis/100;
		var paid = paid;
		var due = 0;
		
		$(".amt").each(function(){
			sub_total = sub_total +($(this).html() * 1)
		})

		tax = 0.15 * sub_total;
		net = sub_total + tax;
		net_total = net * disc;
		net = net - net_total;
		net = net.toFixed(2);
		due = net - paid;
		//fixed the decimal number to 2 point
		due = due.toFixed(2);

		$("#sub").val(sub_total);
		$("#tax").val(tax);
		$("#net").val(net);
		$("#due").val(due);

	}


	$("#dis").on("keyup", function(){
		var discount = $(this).val();
		calculate(discount, 0);
	})

	$("#paid").on("keyup", function(){
		var paid = $(this).val();
		var discount = $("#dis").val();
		calculate(discount, paid);
	})


	//order processing
	$("#order_form").click(function(){

		var invoice = $("#get_orders").serialize();

		if($("#cName").val() === ""){
			alert("Please enter customer name");
		}else if($("#paid").val() === ""){
			alert("Please enter paid amount");
		}else{
			$.ajax({
				url: DOMAIN + "includes/process.php",
				method:"POST",
				data: $("#get_orders").serialize(),
				success: function(data){
					$("#get_orders").trigger("reset");
					
					if(data == "Order_Complete"){
						if(confirm("Do you want to print invoice?")){
							window.location.href = DOMAIN + "includes/bill.php?" + invoice;
						}
					}else{
						alert("Error");
					}
				}
			})
		}
	})
})
