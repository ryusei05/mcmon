<?php
/**
 * Memcached monitor service
 * returns JSON to be consumed by the client javascript
 * 
 * @author Jason Hinkle http://www.verysimple.com
 * @version 1.0
 */
 
require_once("_config.php");
require_once("verysimple/HTTP/Request.php");
require_once("JSON.php");

$id = Request::Get("id",0);
$info = $servers[$id];

$memcache = new Memcache();
$memcache->addServer($info->host, $info->port);

$stats = @$memcache->getExtendedStats();

$json = new Services_JSON();

header("Content-Type: application/json");
print $json->encode($stats[$info->getKey()]);

?>