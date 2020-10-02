<html>
<?php
if (isset($row)){
}
?>

<?php
if (isset($row)){
	echo form_open('users/validate_ans/'.$row['secure_answer'].'/'.$row['username']);
}
 ?>
<div class="row justify-content-center">
	<div class="col-md-offset-6 centered">
		<h1 class="text-left">Reset Password</h1>
		<div class="form-group">
			<label for="code">Your Question:<br/> </label>
			<?php echo $row['secure_question']?>
		</div>
		<div class="form-group">
			<label for="code">Your Answer:<br/> </label>
			<input type="text" name="answer" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="New Password" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button> <br/>
		<a href="<?php echo base_url(); ?>index.php/users/login">Back to Login </a>
	</div>
</div>
</div>
</html>
