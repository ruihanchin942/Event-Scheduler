

<?php echo form_open('Calendar/edit');?>
<html>
<div class="row justify-content-center">
	<div class="col-md-4 col-md-offset-6 centered">
		<h1 class="text-center">Edit Event</h1>
		<?php
		if (isset($error)){
			echo $error;
		} ?>
		<div class="form-group">
			<label for="ques">Enter event id: </label><br/>
			<input type="text" name="id" class="form-control" required autofocus/>
		</div>
		<div class="form-group">
			<label for="ans">New event title: </label><br/>
			<input type="text" name="title" class="form-control" required autofocus/>
		</div>
		<div class="form-group">
			<label for="ans">New event location: </label><br/>
			<input type="text" name="location" class="form-control" required autofocus/>
		</div>
		<div class="form-group">
			<label for="ans">New event start: </label><br/>
			<input type="datetime-local" name="start" class="form-control" required autofocus/>
		</div>
		<div class="form-group">
			<label for="ans">New event end: </label><br/>
			<input type="datetime-local" name="end" class="form-control" required autofocus/>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Save</button> <br/>
	</div>
</div>
</div>
</html>
