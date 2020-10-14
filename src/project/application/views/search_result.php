<?php $code = "";
for($i=0;$i<6;$i++)
{
	$c = rand(0,9);
	$code .= $c;
}?>
<table class="table table-striped text-center">
	<thead>
		<tr>
			<th>ID</th>
			<th>Event</th>
			<th>Location</th>
			<th>Start</th>
			<th>End</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($results as $row){ ?>
		<tr>
			<td><?php echo $row->event_id?></td>
			<td><?php echo $row->title?></td>
			<td><?php echo $row->location?></td>
			<td><?php echo $row->start_date?></td>
			<td><?php echo $row->end_date?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<div id="mainFooter" style="bottom:0; position: fixed;">
	<a class="btn btn-primary mb-2" style="text-align: center" href="javascript:history.back()">Back</a>
</div>
