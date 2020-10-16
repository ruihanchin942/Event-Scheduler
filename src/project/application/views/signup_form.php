<?php
print_r($_POST);
?>
<?php
if (isset($logout_message)) {
	echo "<div class='message'>";
	echo $logout_message;
	echo "</div>";
}
?>
<?php
if (isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
}
?>
<?php echo form_open('users/signup'); ?>
<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
	echo $error_message;
}
echo validation_errors();
echo "</div>";
?>

<?php if(isset($error)) {echo $error;}?>
<?php echo form_open_multipart('users/signup');?>
<div class="row justify-content-center">
	<div class="col-md-4 col-md-offset-6 centered">
		<h1 class="text-center">Sign up</h1>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="What is your Username?" required autofocus>
		</div>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="Enter your Email" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Create Password" required autofocus>
		</div>
		<div class="form-group">
			<b>Write a security question<br/></b>
			<label for="secure_question">(Security question is to retrieve back your password) </label><br/>
			<input type="text" name="secure_question" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<b>Answer for security question<br/></b>
			<input type="text" name="secure_answer" class="form-control" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Sign up</button> <br/>
		<div id="mainFooter" style="bottom:0; position: fixed;">
			<a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
		</div>
	</div>
</div>
</div>
<?php echo form_close(); ?>
<script>

</script>
