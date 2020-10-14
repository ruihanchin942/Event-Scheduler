<head>

	<title>Live poll on events</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#poll_button').on('click', function(){
				var selected = $('#poll_option').val();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('/Calendar/add_vote')?>",
					dataType: "JASON",
					data: {selected: selected},
					success: function (data) {
						alert("Poll Submitted Successfully");
					}
				});
			})
		});
	</script>
</head>
<body>
	<div class="container">
		<br/>
		<br/>
		<br/>
		<h2 align="center">Live Poll on events</h2><br/>
		<div class="row">
			<div class="col-md-7">
				<?php echo form_open('Calendar/fetch_poll', 'id="poll_form"')?>
					<h3>Which is the best date and time for you?</h3>
					<br/>
					<div class="radio">
					<?php if(isset($poll_data))
						foreach($poll_data as $r){
							echo '<br>';
							echo form_radio($r->title.': '.$r->start_date.' to '.$r->end_date, 'poll_option', FALSE, 'name="poll_option" class="poll_option"');
							echo form_label($r->title.': '.$r->start_date.' to '.$r->end_date);
						}
					?>
					<?php
					echo '<br/>';
					echo form_submit('submit', 'Submit', "id = 'poll_button', class='btn btn-primary'");
					echo form_close();
					?>
					</div>
				<br/>
			</div>
			<div class="col-md-6">
				<br/>
				<br/>
				<br/>
				<h4>Live Poll Result</h4><br/>
				<div id="poll_result"></div>
			</div>
		</div>
	</div>
</body>
