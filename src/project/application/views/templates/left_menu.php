<div id="profile">
	<?php
	echo "Hello <b><i>" . $username . "</i> !</b>";
	echo "<br/>";
	?>
	<a href="<?php echo site_url('Users/userprofile/'.$username) ?>">Edit Profile</a>
	<h5 class="card-title text-right">
		<button type="button" class="btn btn-primary"
				onclick="location.href='<?php echo base_url();?>index.php/Calendar/add_event_form'">Add Event
		</button>
	</h5>
</div>
