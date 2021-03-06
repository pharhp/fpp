<?php

//define('debug', true);
define('CONFIG_FILE', '/home/pi/media/settings');
define('SUDO', 'sudo');

// Set some defaults
$fppMode = "player";
$settingsFile = CONFIG_FILE;
$mediaDirectory = "/home/pi/media/";
$musicDirectory = "/home/pi/media/music/";
$sequenceDirectory = "/home/pi/media/sequences/";
$playlistDirectory = "/home/pi/media/playlists/";
$universeFile = "/home/pi/media/universes";
$pixelnetFile = "/home/pi/media/pixelnetDMX";
$scheduleFile = "/home/pi/media/schedule";
$bytesFile = "/home/pi/media/bytesReceived";
$volume = 0;

if (defined('debug'))
{
	error_log("DEFAULTS:");
	error_log("fppMode: $fppMode");
	error_log("settings: $settingsFile");
	error_log("media: $mediaDirectory");
	error_log("music: $musicDirectory");
	error_log("sequence: $sequenceDirectory");
	error_log("playlist: $playlistDirectory");
	error_log("universe: $universeFile");
	error_log("pixelnet: $pixelnetFile");
	error_log("schedule: $scheduleFile");
	error_log("bytes: $bytesFile");
	error_log("volume: $volume");
}

$fd = @fopen(CONFIG_FILE, "r");
if ( ! $fd )
{
  error_log("Couldn't open config file " . CONFIG_FILE);
  return(1);
}

do
{
	global $fppMode, $volume, $settingsFile;
	global $mediaDirectory, $musicDirectory, $sequenceDirectory, $playlistDirectory;
	global $universeFile, $pixelnetFile, $scheduleFile, $bytesFile;

	// Parse the file, assuming it exists
	$data = fgets($fd);
	$split = explode("=", $data);
	if ( count($split) < 2 )
	{
//		error_log("not long enough");
		continue;
	}

	switch (trim($split[0]))
	{
		case "fppMode":
			$fppMode = trim($split[1]);
			break;
		case "volume":
			$volume = trim($split[1]);
			break;
		case "settingsFile":
			$settingsFile = trim($split[1]);
			break;
		case "mediaDirectory":
			$mediaDirectory = trim($split[1]) . "/";
			break;
		case "musicDirectory":
			$musicDirectory = trim($split[1]) . "/";
			break;
		case "sequenceDirectory":
			$sequenceDirectory = trim($split[1]) . "/";
			break;
		case "playlistDirectory":
			$playlistDirectory = trim($split[1]) . "/";
			break;
		case "universeFile":
			$universeFile = trim($split[1]);
			break;
		case "pixelnetFile":
			$pixelnetFile = trim($split[1]);
			break;
		case "scheduleFile":
			$scheduleFile = trim($split[1]);
			break;
		case "bytesFile":
			$bytesFile = trim($split[1]);
			break;
	}

	global $rds_enabled;
	$rds_enabled = false;
}
while ( $data != NULL );

fclose($fd);

if (defined('debug'))
{
	error_log("SET:");
	error_log("fppMode: $fppMode");
	error_log("settings: $settingsFile");
	error_log("media: $mediaDirectory");
	error_log("music: $musicDirectory");
	error_log("sequence: $sequenceDirectory");
	error_log("playlist: $playlistDirectory");
	error_log("universe: $universeFile");
	error_log("pixelnet: $pixelnetFile");
	error_log("schedule: $scheduleFile");
	error_log("bytes: $bytesFile");
	error_log("volume: $volume");
}

?>
