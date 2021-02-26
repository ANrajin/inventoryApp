<?php
	$con = mysqli_connect('localhost', 'root', '', 'world');

	function pagination($con, $table, $pno, $n){
		//$toalRecords = 963;

		$query = $con->query("SELECT COUNT(*) as total FROM ".$table);
		$row = mysqli_fetch_assoc($query);

		$pageno = $pno;
		$recordsPerPage = $n;

		//count how many page needed for records 1st
		$last = ceil($row['total']/$recordsPerPage);

		$pagination = "";

		//show previous page 3rd
		if($last != 1){
			if($pageno > 1){
				$previous = "";
				$previous = $pageno - 1;
				$pagination = "<a href = 'pagination.php?pageno=".$previous."' style='text-decoration:none;'>Previous</a>";
			}

			//show each page 2nd
			for($i = $pageno - 5; $i<$pageno; $i++){
				
				if($i > 0){
					$pagination .= "<a href = 'pagination.php?pageno=".$i."' style='text-decoration:none;'>".$i."</a>";
				}
			}

			//show current active page 4th
			$pagination .= "<a href= 'pagination.php?pageno=".$pageno."' style='color:red;'>".$pageno."</a>";

			//show how many page numbr should display 6th
			for($i=$pageno + 1; $i <= $last; $i++){
				$pagination .= "<a href= 'pagination.php?pageno=".$i."' style='text-decoration:none;'>".$i."</a>";

				if($i > $pageno + 3){
					break;
				}
			}

			//show next page 5th
			if($last > $pageno){
				$next = "";
				$next = $pageno + 1;
				$pagination .= "<a href='".$next."' style='text-decoration:none;'>Next</a>";
			}
		}

		//Limit how many records you want to display per page by sql query
		$limit = "Limit " . ($pageno - 1) * $recordsPerPage.", ".$recordsPerPage;
		return ['pagination' => $pagination, 'Limit' => $limit];
	}

	// if(isset($_GET['pageno'])){
	// 	$pageno = $_GET['pageno'];
	// 	$table = 'city';
	// 	$array = pagination($con, $table, $pageno, 25);

	// 	$sql = "SELECT * FROM ".$table." ".$array["Limit"];

	// 	$query = $con->query($sql);
	// 	while($row = mysqli_fetch_assoc($query)){
	// 		echo "<div style = 'margin: 0 auto; font-size: 20px;'><b>".$row["city_id"]."</b>".$row["Name"]."</div>";
	// 	}
	// 	echo $array['pagination'];
	// }
