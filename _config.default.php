<?php
/**
 * Memcached monitor default config file
 * 
 * @author Jason Hinkle http://www.verysimple.com
 * @version 1.0
 */
 
define("APP_ROOT", realpath("./"));
set_include_path(APP_ROOT . "/libs/" . PATH_SEPARATOR . get_include_path());
require_once("ServerInfo.php");

// ADD AS MANY MEMCACHED SERVERS HERE AS YOU WANT TO MONITOR:
$servers = array();
$servers[] = new ServerInfo('localhost', 11211);
// $servers[] = new ServerInfo('server2.zzz', 11211); 
// $servers[] = new ServerInfo('server2.zzz', 11211); 

// FREQUENCY TO POLL SERVICE.PHP (IN MILISECONDS)
$frequency = 1000;

?>