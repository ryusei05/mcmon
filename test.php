<?php
/**
 * Memcached monitor load test
 * fills Memcache with random garbage so you can see if the monitor is working
 * 
 * @author Jason Hinkle http://www.verysimple.com
 * @version 1.0
 */
 ?>
<html>
<pre>
<?php
require_once("_config.php");

$memcache = new Memcache;
for ($i = 0; $i < count($servers); $i++)
{
	$memcache->addServer($servers[$i]->host, $servers[$i]->port);
}

$id = 0;

for ($i = 0; $i < 1000; $i++)
{
	$id = rand(100000,999999);
	print "Saving Object $id to Cache\r\n";
	$memcache->set('tst_'.$id, $servers, false, 60) or die ("Failed to save data at the server");

	print "Getting Object $id from Cache\r\n";
	$get_result = $memcache->get('tst_'.$id);
}

?>
</pre>
</html>