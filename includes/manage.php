<?php
	/**
	 * 
	 */
	class Manage
	{
		private $con;

		function __construct()
		{
			require_once('../database/db.php');
			$db = new Database;
			$this->con = $db->connect();
		}


		public function mngRecord($table, $pno){

			//connection, table, how many page and how many records per page
			$a = $this->pagination($this->con, $table, $pno, 3);

			if($table == "category"){
				$sql = "SELECT p.cat_id, p.cat_name as category, c.cat_name as root, p.status FROM category p 
				LEFT JOIN category c ON p.parent_cat = c.cat_id ".$a["Limit"];
			}elseif($table == "products"){
				$sql = "SELECT p.pid, p.product_name, c.cat_name, b.brand_name, p.product_price, p.product_stock, p.added_date, p.p_status FROM products p, category c, brands b WHERE  p.cat_id = c.cat_id AND p.bid = b.bid ".$a["Limit"];
			}else{
				$sql = "SELECT * FROM ".$table." ".$a["Limit"];
			}

			$result = $this->con->query($sql) or die($this->con->error);

			$rows = array();

			if($result->num_rows > 0){
				while ($row = $result->fetch_assoc()) {
					$rows[] = $row;
				}
			}

			return ["rows" => $rows, "pagination" => $a["pagination"]];
		}

		//pagination
		private	function pagination($con, $table, $pno, $n){
		//$toalRecords = 963;

		$query = $con->query("SELECT COUNT(*) as total FROM ".$table);
		$row = mysqli_fetch_assoc($query);

		$pageno = $pno;
		$recordsPerPage = $n;

		//count how many page needed for records 1st
		$last = ceil($row['total']/$recordsPerPage);

		$pagination = "<ul class='pagination'>";

			//show previous page 3rd
			if($last != 1){
				if($pageno > 1){
					$previous = "";
					$previous = $pageno - 1;
					$pagination .= "<li class='page-item'><a class = 'page-link' pn='".$previous."' href = '#' style='text-decoration:none;'>Previous</a></li>";
				}

				//show each page 2nd
				for($i = $pageno - 5; $i<$pageno; $i++){
					
					if($i > 0){
						$pagination .= "<li class='page-item'><a class = 'page-link' pn='".$i."' href = '#' style='text-decoration:none;'>".$i."</a></li>";
					}
				}

				//show current active page 4th
				$pagination .= "<li class='page-item'><a class = 'page-link' pn='".$pageno."' href= '#' style='color:red;'>".$pageno."</a></li>";

				//show how many page numbr should display 6th
				for($i=$pageno + 1; $i <= $last; $i++){
					$pagination .= "<li class='page-item'><a class = 'page-link' pn='".$i."' href= '#' style='text-decoration:none;'>".$i."</a></li>";

					if($i > $pageno + 3){
						break;
					}
				}

				//show next page 5th
				if($last > $pageno){
					$next = "";
					$next = $pageno + 1;
					$pagination .= "<li class='page-item'><a class = 'page-link' pn='".$next."' href='' style='text-decoration:none;'>Next</a></li></ul>";
				}
			}

			//Limit how many records you want to display per page by sql query
			$limit = "Limit " . ($pageno - 1) * $recordsPerPage.", ".$recordsPerPage;
			return ['pagination' => $pagination, 'Limit' => $limit];
		}

		//Delete records from table
		public function deleteData($table, $pk, $id){
			if($table == "category"){
				$pre_stat = $this->con->prepare("SELECT ".$id." FROM category WHERE parent_cat = ?");
				$pre_stat -> bind_param("i",$id);
				$pre_stat->execute();
				$result = $pre_stat->get_result() or die($this->con->error);

				if($result->num_rows > 0){
					return "DEPENDENT_CATEGORY";
				}else{
					$pre_stat = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
					$pre_stat->bind_param("i", $id);
					$result = $pre_stat->execute() or die($this->con->error);

					if($result){
						return "CATEGORY_DELETED";
					}
				}
			}else{
				$pre_stat = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
				$pre_stat->bind_param("i", $id);
				$result = $pre_stat->execute() or die($this->con->error);

				if($result){
					return "DELETED";
				}
			}
		}

		//fetch singe record
		public function getRecord($table, $pk, $id){
			$pre_stat = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ?");
			$pre_stat->bind_param("i", $id);
			$pre_stat->execute() or die($this->con->error);
			$result = $pre_stat->get_result();

			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
			}
			return $row;
		}

		//update 
		public function update($table, $where, $data){
			$sql = "";
			$condition = "";

			foreach ($where as $key => $value) {
				$condition .= $key." = '".$value."' AND ";
			}

			//remove the last AND from query
			$condition = substr($condition, 0, -5);

			foreach ($data as $key => $value) {
				//update table set cat_name = " " where cat_id = ""
				$sql .= $key."= '".$value."', ";
			}

			$sql = substr($sql, 0, -2);
			$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;

			if(mysqli_query($this->con, $sql)){
				return true;
			}
		}


		//order details insert into database
		public function insertOrders($cName,$date,$sub,$tax,$dis,$net,$paid,$due,$pMethod, $pName, $price, $qty, $tqty){
			$pre_stat = $this->con->prepare
			("
				INSERT INTO `invoice`(`customer_name`, `order_date`, `sub_total`, `tax`, `discount`, `net_total`, `paid`, `due`, `p_type`) VALUES (?,?,?,?,?,?,?,?,?)
			");

			$pre_stat->bind_param("ssdddddds", $cName,$date,$sub,$tax,$dis,$net,$paid,$due,$pMethod);
			$pre_stat->execute() or die($this->con->error);

			$invoice_id = $pre_stat->insert_id;

			if($invoice_id){
				for ($i=0; $i <count($pName) ; $i++) {
					//find out remaining quantity
					$rem_qty = $tqty[$i] - $qty[$i];
					if($rem_qty < 0){
						return "Order_failed_to_complete";
					}else{
						//update product stock
						$this->con->query("UPDATE products SET product_stock = '".$rem_qty."' WHERE product_name = '".$pName[$i]."'");
					}

					$insert_product = $this->con->prepare
					("
						INSERT INTO `invoice_details`(`invoice_id`, `product_name`,`price`, `quantity`) VALUES (?,?,?,?)
					");

					$insert_product->bind_param("isdi", $invoice_id, $pName[$i], $price[$i], $qty[$i]);
					$insert_product->execute() or die($this->con->error);
				}

				return "Order_Complete";
			}

		}
	}

	//$obj = new Manage;

	// echo "<pre>";
	// print_r($obj->mngRecord("category", 1));
	// echo $obj->deleteData("category", "cat_id", 1);

	//print_r($obj->getRecord("category", "cat_id", 1));