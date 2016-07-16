
var streamSource;
var cpuInfoCanvas, memInfoCanvas, diskInfoCanvas;


//object that contains values of stuff that doesn't change a lot
var unchanging = {
    totalMem : null,
    disk : null
    
};
//objects that represent the canvas elements 
var cpuCanvas = {
    canvas : null,
    context : null,
    width : null,
    height : null
};
var memCanvas = {
    canvas : null,
    context : null,
    width : null,
    height : null
};

var diskCanvas = {
    canvas : null,
    context : null,
    width : null,
    height : null
};

// runs when page is loaded
function onLoad() {
    
    //check if the browser supports Server-Sent Events 
    if (!!window.EventSource) {
        streamSource = new EventSource("streamer.php");
        setListeners();
    } else {
        alert("This browser doesn't support Server-Sent Events :-(");
    }
    
    
    //initialise elements
    cpuCanvas.canvas = document.getElementById("cpuInfoCanvas");
    cpuCanvas.context = cpuCanvas.canvas.getContext("2d");
    cpuCanvas.width = cpuCanvas.canvas.width;
    cpuCanvas.height = cpuCanvas.canvas.height;
    
    memCanvas.canvas = document.getElementById("memInfoCanvas");
    memCanvas.context = memCanvas.canvas.getContext("2d");
    memCanvas.width = memCanvas.canvas.width;
    memCanvas.height = memCanvas.canvas.height;
    
    
    diskCanvas.canvas = document.getElementById("diskInfoCanvas");
    diskCanvas.context = diskCanvas.canvas.getContext("2d");
    diskCanvas.width = diskCanvas.canvas.width;
    diskCanvas.height = diskCanvas.canvas.height;
    
    
}

//set listener for data from the php script
function setListeners() {
    streamSource.addEventListener('message', function(e) {
        var data = e.data;
        handleMsg(data);
    }, false);

    streamSource.addEventListener("error", function(e) {
        if(e.readyState == EventSource.CLOSED) {
            console.log("Connection closed");     
        }
    }, false);
    
}

//check what type of update msg is and draw on the corresponding canvas
function handleMsg(msg) {
    var splitMsg = msg.split("=");
    var updateType = splitMsg[0];
    // String is in the same format regardless of whether it is a cpu or memory update 
    if(updateType == "cpuupdate" || updateType == "memupdate" || updateType == "totalmemory") { 
        var newVal = splitMsg[1];
        
        if(updateType == "cpuupdate") {
            drawCpuMeter(newVal);
        }
        else if(updateType == "memupdate") {
            drawMemMeter(newVal);
        }
        else if(updateType == "totalmemory") {
            unchanging.totalMem = parseInt(newVal);
            
        }
    
    }
    
}

function drawCpuMeter(val) {
    var value = parseInt(val); 
    cpuCanvas.context.clearRect(0, 0, cpuCanvas.width, cpuCanvas.height);
    cpuCanvas.context.beginPath();
    cpuCanvas.context.arc((cpuCanvas.width/2),(cpuCanvas.height/2),(cpuCanvas.height*0.4),(1.5*Math.PI),((value/100*2*Math.PI)+1.5*Math.PI));
    cpuCanvas.context.stroke();
}

function drawMemMeter(val) {
    var value = parseInt(val); 
    
    var memPercent = (value/unchanging.totalMem) * 100;
    
    console.log(memPercent);
    memCanvas.context.clearRect(0, 0, memCanvas.width, memCanvas.height);
    memCanvas.context.beginPath();
    memCanvas.context.arc((memCanvas.width/2),(memCanvas.height/2),(memCanvas.height*0.4),(1.5*Math.PI),((memPercent/100*2*Math.PI)+1.5*Math.PI));
    memCanvas.context.stroke();

}



window.addEventListener("load", onLoad());