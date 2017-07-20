<?php DEFINED("SPM_GENUINE") OR DIE('403 ACCESS DENIED'); ?>
<?php if (isset($_SESSION["classwork"])): ?>

<?php
	
	global $db;
	
	$query_str = "
		SELECT
			*
		FROM
			`spm_classworks`
		WHERE
			`id` = '" . $_SESSION["classwork"] . "'
		LIMIT
			1
		;
	";
	
	if (!$query = $db->query($query_str))
		die(header('location: index.php?service=error&err=db_error'));
	
	if ($query->num_rows == 0)
		die(header('location: index.php'));
	
	$classwork = $query->fetch_assoc();
	$query->free();
	
	$clw_now = new DateTime(date("Y-m-d H:i:s"));
	$clw_end = new DateTime($classwork["endTime"]);
	
	$clw_diff = $clw_now->diff($clw_end);
	$clw_diff = $clw_diff->format("%H:%i:%s");
	
?>
<script type="text/javascript">
	function startTimer() {
		var my_timer = document.getElementById("classwork_timer");
		var time = my_timer.innerHTML;
		var arr = time.split(":");
		var h = arr[0];
		var m = arr[1];
		var s = arr[2];
		if (s == 0) {
			if (m == 0) {
				if (h == 0) {
					alert("Упс! Часу більше немає... Ви будете переадресовані на сторінку результатів змагання.");
					window.location.href = "index.php?service=classworks.result&id=<?=$_SESSION["classwork"]?>";
					return;
				}
				h--;
				m = 60;
				if (h < 10)
					h = "0" + h;
			}
			
			m--;
			
			s = 59;
		}
		else
			s--;
		
		if (s < 10)
			s = "0" + s;
		
		document.getElementById("classwork_timer").innerHTML = h+":"+m+":"+s;
		setTimeout(startTimer, 1000);
	}
</script>
<li class="dropdown messages-menu">
	<a class="dropdown-toggle" title="Час до закінчення змагання">
		&nbsp;<i class="fa fa-hourglass-half"></i>&nbsp;
		<strong id="classwork_timer"><?=$clw_diff?></strong>
	</a>
</li>
<?php endif; ?>