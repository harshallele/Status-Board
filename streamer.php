<?php
//header to denote that this is a stream
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


$timeIter = 0;

$startTime = time();


//vars to store info from last iteration so that it can be compared to current values in order to check for noticable change 
$lastMemVal = 0;
$lastCPUVal = 0;

//get total memory
$totalMemVal = shell_exec("cat /proc/meminfo | grep MemTotal | awk '{print $2/(1000*1000)}'");;


//method that actually sends the message
function sendMsg($id, $msg) {
    echo "data: $id=$msg". PHP_EOL;
    echo PHP_EOL;
    ob_flush();
    flush();
}




$timeIter=time();

//send slow changing things like disk info, uptime etc. for the first time(later on, they will only be sent once every few minutes)

//Disk Info
$diskInfo = shell_exec("df -h | grep '/dev/sd' | awk '{print $1\"-\"$3\":\"$2\"-\"$6\"+\"}' |tr -d \"\n\" ");
sendMsg("diskupdate",$diskInfo);  



//main do-while loop that sends out new data. 
while(true){
    
    
    //get system info
    //free memory 
    $memFree = shell_exec("cat /proc/meminfo | grep MemAvailable | awk '{print $2/(1000*1000)}'");
    //CPU usage
    $cpuUsage = shell_exec("top -bn 2  | grep '^%Cpu' | tail -n 1 | gawk '{print $2+$4+$6}'");
    
    
    //only send the info if it has noticably changed from the last value
    if(abs($memFree - $lastMemVal)/$totalMemVal > 0.01){
        sendMsg("memupdate",$memFree);
    }
    
    if(abs($cpuUsage - $lastCPUVal) > 1){
        sendMsg("cpuupdate",$cpuUsage);
    }
    
    
    
    
    
    
    //record current values for use in the next iteration
    $lastMemVal = $memFree;
    $lastCPUVal = $cpuUsage;
    
    $timeIter=time();
    
    
    //loop every 2 seconds
    sleep(2);
}

?>