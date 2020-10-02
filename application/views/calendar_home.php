<?php
if (isset($_SESSION['logged_in'])) { //if is logged in
	if(time() - $_SESSION['logged_in']['lastlogin'] > 180) {
		$sess_array = array(
			'username' => '',
			'password' => '',
			'last_login'=> time()
		);
		session_destroy();
		header('login');
	}else{
		$_SESSION['logged_in']['lastlogin'] = time();
	}
	$username = ($this->session->userdata['logged_in']['username']);
} else {
	header("location: login");
}
?>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<!-- Full Calendar -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script>
		$(document).ready(function(){

			//initialize calendar
			var calendar = $('#calendar').fullCalendar({
				editable: true,
				header: {
					left: 'title',
					center: 'agendaDay,agendaWeek,month',
					right: 'prev,next today'
				},
				events:'<?php echo base_url(); ?>index.php/Calendar/load',
				selectable:true,
				selectHelper:true,
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#autocomplete-search').autocomplete({
				source: function(request, response){
					//fetch data
					$.ajax({
						url:'<?php echo base_url(); ?>Users/eventList',
						type: 'post',
						dataType:"json",
						data: {
							search: request.term
						},
						success: function(data){
							response(data);
						}
					});
				},
				select: function(event, ui){
					//Set selection
					$('#autocomplete-search').val(ui.item.label);
				}
			});
		});
	</script>

</head>
<body>
		<div id="profile">
			<?php
			echo "Hello <b><i>" . $username . "</i> !</b>";
			echo "<br/>";
			?>
			<a href="<?php echo site_url('Users/userprofile/'.$username) ?>">Edit Profile</a>
			<h5 class="card-title text-left">
				<div id="prefetch">
					<form class="form-inline my-2 my-lg-0" style="float:right" action="<?php echo site_url('Users/search_keyword')?>" method="post">
						<input id="autocomplete-search" class="form-control input-lg typeahead" name="keyword" type="text" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
				<br/>
				<button type="button" class="btn btn-success"
						onclick="location.href='<?php echo site_url('Calendar/add_event_form');?>'">Add Event
				</button>
				<!--
				<button type="button" class="btn btn-warning"
						onclick="location.href='<?php echo site_url('Calendar/edit_event_form');?>'">Edit Event
				</button>-->
				<button type="button" class="btn btn-danger"
						onclick="location.href='<?php echo site_url('Calendar/delete_event_form');?>'">Delete Event
				</button>
			</h5>
		</div>
		<?php
		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
		?>
	<div class="wrap" style="padding-top: 30px">
		<div id="calendar"></div>
	</div>
</body>

