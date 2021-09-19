<?php
		$servername = "localhost";
        $username = "root";
        $password = "";
        $database_name = "aap";

        $connection = mysqli_connect($servername, $username, $password, $database_name);
        if($connection){
            // echo "Success";
        }else{
            "Connection failed: " . mysqli_connect_error();
        }
 ?>