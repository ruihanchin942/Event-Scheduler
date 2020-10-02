<?php
if (isset($username)){
}
?>

<?php echo form_open_multipart('Users/profileupdate/'.$username);?>
<html>
<div class="row justify-content-center">
	<div class="col-md-4 col-md-offset-6 centered">
		<h1 class="text-center">Edit Profile</h1>
		<?php
		if (isset($error)){
			echo $error;
		} ?>
		<div class="form-group">
			<label for="ques">Security Question: </label><br/>
			<input type="text" name="ques" class="form-control" required autofocus/>
		</div>
		<div class="form-group">
			<label for="ans">Answer for Security Question: </label><br/>
			<input type="text" name="ans" class="form-control" required autofocus/>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Save</button> <br/>
	</div>
</div>
</div>
</html>
