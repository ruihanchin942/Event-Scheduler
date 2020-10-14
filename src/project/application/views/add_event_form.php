<?php
if (isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
}
?>

<?php echo form_open('Calendar/add'); ?>

<div class="row justify-content-center">
	<div class="centered">
		<h3 class="text-md-center"><b><i>Add Event</i></b></h3>
		<div class="form-group">
			<label for="title">Title: </label><br/>
			<input type="text" name="title" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="location">Location: </label><br/>
			<input type="text" name="location" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="note">Start Date: </label><br/>
			<input type="datetime-local" name="start" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<label for="note">End Date: </label><br/>
			<input type="datetime-local" name="end" class="form-control" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Add event!</button> <br/>
		<a href="">Cancel</a><br/>
	</div>
</div>
</div>

