<?php
/**
 * Memcached monitor landing page
 * renders the client html and javascript
 * 
 * @author Jason Hinkle http://www.verysimple.com
 * @version 1.0
 */
 
 require_once("_config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Memcached Monitor</title>
    <link rel="stylesheet" type="text/css" href="styles/clearfix.css" />
    <link rel="stylesheet" type="text/css" href="styles/mcmon.css" />
    <script type="text/javascript" src="scripts/prototype.js"></script>
    <script type="text/javascript" src="scripts/mclient.js"></script>
</head>
<body>

<h1>Memcached Monitor</h1>

<div id="controls">
	Monitor Status: <span id="status" class="stopped">Stopped</span>
	<a id="start" href="#" onclick="startMonitor();return false;">START</a>
	<a id="stop" style="display:none;" href="#" onclick="stopMonitor();return false;">STOP</a>
</div>

<?php for ($i = 0; $i < count($servers); $i++) { ?>

	<div class="server">
		<h2>Server <?php print $servers[$i]->getKey(); ?></h2>
	
		<div class="fields">
			<div class="field clearfix">
				<label>result</label>
				<span id="result_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>utilization</label>
				<span id="utilization_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>&nbsp;</label>
				<span class="utilization_bar" id="utilization_bar_<?php print $i; ?>"><b id="utilization_bar_b_<?php print $i; ?>"></b></span>
			</div>
			<div class="field clearfix">
				<label>pid</label>
				<span id="pid_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>uptime</label>
				<span id="uptime_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>time</label>
				<span id="time_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>version</label>
				<span id="version_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>pointer_size</label>
				<span id="pointer_size_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>curr_items</label>
				<span id="curr_items_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>total_items</label>
				<span id="total_items_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>bytes</label>
				<span id="bytes_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>curr_connections</label>
				<span id="curr_connections_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>total_connections</label>
				<span id="total_connections_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>connection_structures</label>
				<span id="connection_structures_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>cmd_get</label>
				<span id="cmd_get_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>cmd_set</label>
				<span id="cmd_set_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>get_hits</label>
				<span id="get_hits_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>get_misses</label>
				<span id="get_misses_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>bytes_read</label>
				<span id="bytes_read_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>bytes_written</label>
				<span id="bytes_written_<?php print $i; ?>"></span>
			</div>
			<div class="field clearfix">
				<label>limit_maxbytes</label>
				<span id="limit_maxbytes_<?php print $i; ?>"></span>
			</div>
		</div> <!-- /fields -->
	</div> <!-- /server -->
<?php } ?>

<script type="text/javascript">
	setNumServers(<?php print count($servers); ?>);
	setFrequency(<?php print $frequency; ?>);
</script>

</body>
</html>