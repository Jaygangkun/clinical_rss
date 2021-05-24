<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
		<title>CE Clinical Trials Reporting</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?v=<?php echo time() ?>">
        
		<script type="text/javascript">
        var base_url = "<?php echo base_url()?>";
        </script>
	</head>
	<body>
	<nav class="topnav">
		<div style="flex-grow: 8;"><a href="#" class="header-logo"><img src="<?= base_url() ?>assets/img/logo.png"></a></div>
		<div style="text-align: right;"><a href="<?php echo base_url('/login')?>">Logout</a></div>
		<div style="text-align: right;"><a href="#"><i class="material-icons">person</i></a></div>
	</nav>
	<div class="report-add-area">
		<div class="container">
			<h3 class="area-title">Clinical Trials Reports</h3>
			<div class="report-input-row">
				<div class="report-input-col">
					<div class="report-input-col-row">
						<div class="report-input-col-row-50">
							<input type="text" class="report-input" id="title" placeholder="+ Enter report title">
						</div>
						<div class="report-input-col-row-50">
							<input type="text" class="report-input" id="conditions" placeholder="+ Enter condition or disease">
						</div>
					</div>
					<div class="report-input-col-row">
						<div class="report-input-col-row-50">
							<div class="report-input-col-row-50">
								<select class="report-input" id="study">
									<?php
									if(isset($studies)){
										foreach($studies as $study){
											?>
											<option value="<?php echo $study['value']?>"><?php echo $study['text']?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
							<div class="report-input-col-row-50">
								<select class="report-input" id="country">
									<?php
									if(isset($countries)){
										foreach($countries as $country){
											?>
											<option value="<?php echo $country['value']?>"><?php echo $country['text']?></option>
											<?php
										}
									}
									?>
								</select>
							</div>		
						</div>
						<div class="report-input-col-row-50">
							<input type="text" class="report-input" id="terms" placeholder="+ Enter search terms">
						</div>
					</div>
				</div>
				<div class="report-btn-col">
					<span class="btn-main" id="report_add_btn">+ Add</span>
				</div>
			</div>
		</div>
	</div>
	<div class="report-list-area">
		<div class="container">
			<div class="report-list-head">
				<div class="report-list-head-sort">
					<span class="sort-btn" id="sort_btn" sort="ASC">
						<i class="material-icons">sort</i>Sort
					</span>
				</div>
				<div class="report-list-head-search">
					<div class="search-input-wrap">
						<input type="text" placeholder="Search" id="report_search_input">
						<i class="search-input-icon material-icons">search</i>
					</div>
				</div>
			</div>
			<div class="report-list-body" id="report_list">
				<?php
				if(isset($reports)){
					foreach($reports as $report){

						$data = array();
						$data['report'] = $report;

						$this->view('admin/template/report-template', $data);
					}
				}
				?>
			</div>
		</div>
	</div>

    </body>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.js?v=<?php echo time()?>"></script>
</html>