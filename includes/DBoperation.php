<?php

	class DBoperation
	{
		private $con;
		
		function __construct()
		{
			include_once("../database/db.php");
			$db = new Database;
			$this->con = $db->connect();
		}

		public function addCategory($parent, $cat){
			$pre_stat = $this->con->prepare("INSERT INTO `category`(`parent_cat`, `cat_name`, `status`) VALUES (?,?,?)");

			$status = 1;
			//i=int, s=string
			$pre_stat->bind_param("isi",$parent, $cat, $status);
			$result = $pre_stat->execute() or die($this->con->error);

			if($result){
				return "CATEGORY_ADDED";
			}else{
				return 0;
			}
		}

		public function addBrand($brand){
			$pre_stat = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");

			$status = 1;
			//i=int, s=string
			$pre_stat->bind_param("si",$brand, $status);
			$result = $pre_stat->execute() or die($this->con->error);

			if($result){
				return "BRAND_ADDED";
			}else{
				return 0;
			}
		}

		public function addProducts($cid, $bid, $p_name, $price, $stock, $date){
			$pre_stat = $this->con->prepare("INSERT INTO `products`(`cat_id`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?)");

			$status = 1;
			//i=int, s=string
			$pre_stat->bind_param("iisdisi",$cid, $bid, $p_name, $price, $stock, $date, $status);
			$result = $pre_stat->execute() or die($this->con->error);

			if($result){
				return "PRODUCTS_ADDED";
			}else{
				return 0;
			}
		}

		public function getAllrecords($table){
			$pre_stat = $this->con->prepare("SELECT * FROM ".$table);
			$pre_stat->execute() or die($this->con->error);
			$result = $pre_stat->get_result();
			$rows = array();

			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$rows[] = $row;
				}
				return $rows;
			}else{
				return "NO_DATA";
			}
		}
	}

	// $opr = new DBoperation;
	// $opr->addCategory(1, 'Mobiles');
	// echo "<pre>";
	// print_r($opr->getAllrecords('category'));
