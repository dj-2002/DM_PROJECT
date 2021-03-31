	<?php 
		if(isset($_POST['submit'])){
			if(empty($_POST['description'])){
				echo '<script>alert("can not be empty")</script>';
				echo '<script>window.location = "index.php"</script>';
			}else{
				header("Content-type: application/vnd.ms-word");
				header("Content-Disposition: attachment;Filename=".rand().".doc");
				header("Pragma: no-cache");
				header("Expires: 0");
				echo "<html>";
				// echo "<h1>".$_POST['heading']."</h1>";
				echo $_POST["description"];
				echo "</html>";
			}
		}

	 ?>

	 <?php include '../header.php' ?>

	 
