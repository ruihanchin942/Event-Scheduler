<html>
<?php
if (isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
}
?>

<?php echo form_open('users/forgotpw'); ?>

<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
	echo $error_message;
}
echo validation_errors();
echo "</div>";
?>

<div class="row justify-content-center">
	<div class="col-md-offset-6 centered">
		<h1 class="text-left">Reset Password</h1>
		<div class="form-group">
			<label for="code">Please enter your Username<br/> </label>
			<input type="text" name="username" class="form-control" required autofocus>
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button> <br/>
		<div id="mainFooter" style="bottom:0; position: fixed;">
                        <a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
                </div>
	</div>
</div>
</div>
</html>
