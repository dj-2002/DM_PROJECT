<?php include '../header.php' ?>


	<div class="container">
		
		<div class="row">
				<form action="export.php" method="post" class="offset-md-3">
					<div class="col-md-6 mt-3">
						<input type="text" name="heading" class="form-control d-block" placeholder="type title">
					</div>
					<div class="col-md-6 mt-3">
						<textarea name="description" class=" d-block" cols=50 rows=5 placeholder="Type your html code here"></textarea>
					</div>
					<div class="col-md-6 mt-3">
						<input type="submit" class="btn btn-primary" name="submit"/>
					</div>
				</form>
		</div>
	</div>
