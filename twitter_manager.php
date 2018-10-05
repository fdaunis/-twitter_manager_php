<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Franccesc Daunis">
		<link rel="icon" href="assets/img/favicon.ico">

		<title>Twitter Manager</title>
		
		<link href="bootstrap-4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<header>
		
		</header>

		<main>
			<div class="container-fluid">
				<h1>Twitter Manager</h1>
			</div>
			
			<hr>
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-6 col-lg-3">
						<form id="form-dates">
							<div class="form-group row">
								<label for="tx_date1" class="col-sm-4 col-form-label">Start Date</label>
								<div class="col-sm-8">
									<input type="date" class="form-control" id="tx_date1" value="<?php echo date('Y-m-d');?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="tx_date2" class="col-sm-4 col-form-label">End Date</label>
								<div class="col-sm-8">
									<input type="date" class="form-control" id="tx_date2" value="<?php echo date('Y-m-d');?>">
								</div>
							</div>
							
						</form>
					</div>
					<div class="col-6 col-lg-3" >
						<h2>User <span class="badge badge-secondary" id="id_span_username" >????</span></h2>
						<button id="id_bt_show_tweets" type="button" class="btn btn-primary" onclick="Event_Click_Button_Show_Tweets();">Show Tweets</button>
					</div>
				</div>
				
				
			</div>

			<div class="container-fluid" id="id_div_resultat">
			</div>

			
		</main>

		<footer>

		</footer>
		
		<script src="jquery/jquery-3.3.1.min.js" ></script>
		<script src="bootstrap-4.1.3/dist/js/popper_1.14.3.min.js" ></script>
		<script src="bootstrap-4.1.3/dist/js/bootstrap.min.js" ></script>
		<script src="assets/js/javascript.js" ></script>
		
	</body>
</html>
