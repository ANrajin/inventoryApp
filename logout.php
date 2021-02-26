<?php
	include_once('database/constants.php');

	if(isset($_SESSION['user_id'])){
		session_destroy();
	}
	header("location:".DOMAIN);
