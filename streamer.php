<?php
//header to denote that this is a stream
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


//vars to store info from last iteration so that it can be compared to current values in order to check for noticable change 
$lastMemVal = 0;
$lastCPUVal = 0;

//get total memory
$totalMemVal = shell_exec("cat /proc/meminfo | grep MemTotal | awk '{print $2/(1000*1000)}'");;

$startTime=time();

//method that actually sends the message
function sendMsg($id, $msg) {
    echo "data: $id:$msg". PHP_EOL;
    echo PHP_EOL;
    ob_flush();
    flush();
}

//main do-while loop that sends out new data. 
do{
    //get system info
    $memFree = shell_exec("cat /proc/meminfo | grep MemAvailable | awk '{print $2/(1000*1000)}'");
    $cpuUsage = shell_exec("top -bn 2  | grep '^%Cpu' | tail -n 1 | gawk '{print $2+$4+$6}'");
    
    //only send the info if it has noticably changed from the last value
    if(abs($memFree - $lastMemVal)/$totalMemVal > 0.01){
        sendMsg("memupdate",$memFree);
    }
    
        sendMsg("cpuupdate",$cpuUsage);
    
    
    
    //record current values for use in the next iteration
    $lastMemVal = $memFree;
    $lastCPUVal = $cpuUsage;
    
    
    
    
    sleep(2);
}while(true);

?>