<?php 

include 'header.php'; 
function formatSize( $bytes )
{
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
                return( round( $bytes, 2 ) . " " . $types[$i] );
}

//Ram Usage


exec('free -mo', $out);
preg_match_all('/\s+([0-9]+)/', $out[1], $matches);
list($total, $used, $free, $shared, $buffers, $cached) = $matches[1];
$memory_usage = $buffers;
	


//Cpu Usage

function get_server_cpu_usage(){
 
	$load = sys_getloadavg();
	return $load[0];
 
}


//Disk Usage

/* get disk space free (in bytes) */
$df = disk_free_space("/home");
/* and get disk space total (in bytes)  */
$dt = disk_total_space("/home");
/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;
/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f',($du / $dt) * 100);

/* and we formate the size from bytes to MB, GB, etc. */
$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);




//Server Uptime

$data = shell_exec('uptime');
$uptime = explode(' up ', $data);
$uptime = explode(',', $uptime[1]);
$uptime = $uptime[0].', '.$uptime[1];


//Load Average

$current_reading = @exec('uptime'); 
preg_match("/averages?: ([0-9\.]+),[\s]+([0-9\.]+),[\s]+([0-9\.]+)/", $current_reading, $averages); 
$uptime = explode(' up ', $current_reading); 
$uptime = explode(',', $uptime[1]); 
$uptime = $uptime[0].', ' . $uptime[1];
$load = "$averages[1], $averages[2], $averages[3]\n";

?>

<div class="width-800">

<h3 class="marginbot-40"><i class="fa fa-dashboard"></i> Welcome, Dashboard</h3>

<div class="row marginbot-40">

<div class="col-md-6">

<div class="col-md-3 bg-uptime text-center">
<i class="fa fa-arrow-up fa-vc"></i>
</div>
<div class="col-md-9 bg-common">
<?=$uptime?>
<p>Server Uptime</p>
</div>

</div>

<div class="col-md-6">

<div class="col-md-3 bg-load text-center">
<i class="fa fa-area-chart fa-vc"></i>
</div>
<div class="col-md-9 bg-common">
<?=$load?>
<p>Load Average</p>
</div>

</div>

</div>

<div class="row">
<div class="col-md-6">
<div class="col-md-3 bg-host text-center">
<i class="fa fa-ioxhost fa-vc"></i>
</div>
<div class="col-md-9 bg-common">
<?
$version = phpversion();
print $version;
?>
<p>Php Version</p>
</div>
</div>

<div class="col-md-6">
<div class="col-md-3 bg-web text-center">
<i class="fa fa-globe fa-vc"></i>
</div>
<div class="col-md-9 bg-common">
<?=$_SERVER['SERVER_ADDR']?>
<p>Server IP</p>
</div>
</div>

</div>
</div>

<? include $adminfolder.'footer.php'; ?>





