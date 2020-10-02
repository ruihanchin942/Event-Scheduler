<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Neaty - Event Calendar Scheduler</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="">Neaty</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
	</div>
	</li>
	</ul>
	<ul class="navbar-nav my-lg-0">
		<?php if(isset($this->session->userdata['logged_in'])) { ?>
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>"> Logout </a>
			</li>
		<?php } ;?>
	</ul>
	</div>
</nav>
<div class="container">
