
<html>
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

<?php $code = "";
for($i=0;$i<6;$i++)
{
	$c = rand(0,9);
	$code .= $c;
}?>

<?php echo form_open('Users/login/'.$code); ?>

<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
	echo $error_message;
}
echo validation_errors();
echo "</div>";
?>

<div class="row justify-content-center">
	<div class="col-md-4 col-md-offset-6 centered">
		<h1 class="text-center">Login</h1>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php if(get_cookie('username')) {echo get_cookie('username'); }?>" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(get_cookie('password')) {echo get_cookie('password'); }?>" required autofocus>
		</div>
		<div class="form-group">
			<label for="code">Captcha: <?php echo $code;?></label><br/>
			<input type="text" name="code" class="form-control" required autofocus>
		</div>
		<div class="form-group">
			<input type="checkbox" name="remember_me"/> Remember Me
		</div>
		<button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button> <br/>
		<a href="<?php echo base_url(); ?>index.php/Users/signupform"> Sign up here</a><br/>
		<a href="<?php echo base_url(); ?>index.php/Users/forgotpwform"> Forgot Password</a>
	</div>
</div>
</div>
</html>

