
var streamSource;
var cpuInfoCanvas , memInfoCanvas , diskInfoCanvas;

var cpuCanvas = {
    canvas:null,
    posX:null,
    posY:null,
    width:null,
    height:null
}

var memCanvas = {
    canvas:null,
    posX:null,
    posY:null,
    width:null,
    height:null
}

var diskCanvas = {
    canvas:null,
    posX:null,
    posY:null,
    width:null,
    height:null
}


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
    cpuCanvas.width = cpuCanvas.canvas.width;
    cpuCanvas.height = cpuCanvas.canvas.height;
    console.log(cpuCanvas);
    
    
    memCanvas.canvas = document.getElementById("cpuInfoCanvas");
    diskCanvas.canvas = document.getElementById("cpuInfoCanvas");
    
    
    
}

//set listener for data from the php script
function setListeners(){
    streamSource.addEventListener('message', function(e) {
        var data = e.data;
        //console.log(data);
        
    }, false);

    streamSource.addEventListener("error", function(e) {
        if(e.readyState == EventSource.CLOSED){
            //console.log("Connection closed");
        }
    },false);
    
}


window.addEventListener("load", onLoad());