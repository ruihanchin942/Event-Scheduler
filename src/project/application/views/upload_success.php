<html>
<head>
	<title>Upload Form</title>
</head>>
<body>
<h3>succesuflly uploaded</h3>
<u1>
	<?php foreach ($upload_data as $item=>$value):?>
		<li><?php echo $item;?>:<?php echo $value;?> </li>
	<?php endforeach; ?>
</u1>
</body>
</html>
