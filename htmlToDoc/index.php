<?php include '../header.php' ?>

  <h1>HTML TO DOCX Converter</h1>

	<div class="container">
		
		<div class="row">
				<form action="export.php" method="post" class="offset-md-3">
					<!-- <div class="col-md-6 mt-3">
						<input type="text" name="heading" class="form-control d-block" placeholder="type title">
					</div> -->
					<div class="col-md-6 mt-3 pl-0">
						<textarea name="description" class=" d-block" cols=70 rows=5 placeholder="Type your html code here"></textarea>
					</div>
					<div class="col-md-6 mt-3 pl-0">
						<input type="submit" class="btn btn-primary" name="submit"/>
					</div>
				</form>
		</div>
	</div>

  <style type="text/css">
    input[type=submit] {
         opacity: 1; 
         margin-left: 
    }
    h1{
      text-align: center;
      margin: 20px auto;
      color: #000;
    }
   </style>
