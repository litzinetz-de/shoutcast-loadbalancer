<?php
// Define servers in this array
$servers=array('1.2.3.4','shout.cast.server');

$maxfree=0;
$maxfreeserver=$servers[0];
$all_full=true;

function getFreeSlots($host)
{
	$port = 8000; // Change server port if needed
	$url = "/index.html?sid=1";
 
	$timeout = 5;
 
	$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
	if($fp)
	{
		$request = "GET ".$url." HTTP/1.1\r\n";
		$request.= "Host: ".$host."\r\n";
		$request.= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; de-DE; 	rv:1.7.12) Gecko/20050919 Firefox/1.0.7\r\n";
		$request.= "Connection: Close\r\n\r\n";
 
		fwrite($fp, $request);
		while (!feof($fp))
		{
			$data .= fgets($fp, 128);
		}
		fclose($fp);
		
		$buffer1=explode('Stream is up at 96 kbps with ',$data); // Change kbps if needed
		$buffer2=explode(' listeners',$buffer1[1]);
		$buffer3=explode(' of ',$buffer2[0]);
		return $buffer3[1]-$buffer3[0];
	}
	else
	{
		return 0;
	}
}

foreach($servers as $server)
{
	$this_free_slots=getFreeSlots($server);
	if($this_free_slots > $maxfree)
	{
		$maxfree=$this_free_slots;
		$maxfreeserver=$server;
	}
	if($this_free_slots>0)
	{
		$all_full=false;
	}
}

?>
