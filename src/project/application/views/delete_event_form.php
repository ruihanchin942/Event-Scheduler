
<?php echo form_open('Calendar/delete');?>
<html>
<div class="row justify-content-center">
	<div class="col-md-4 col-md-offset-6 centered">
		<h1 class="text-center">Delete Event</h1>
		<?php
		if (isset($error)){
			echo $error;
		} ?>
		<div class="form-group">
			<label for="ques">Enter event id: </label><br/>
			<input type="text" name="id" class="form-control" required autofocus/>
		</div>

		<button type="submit" class="btn btn-primary btn-block">Delete</button> <br/>
		<div id="mainFooter" style="bottom:0; position: fixed;">
			<a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
		</div>
	</div>
</div>
</div>
</html>
