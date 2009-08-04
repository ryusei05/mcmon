<?php

/**
 * Simple type for storing server connection info
 */
class ServerInfo
{
	public $host;
	public $port;
	
	public function ServerInfo($host,$port)
	{
		$this->host = $host;
		$this->port = $port;
	}
	
	public function getKey()
	{
		return $this->host . ":" . $this->port;
	}
	
}

?>