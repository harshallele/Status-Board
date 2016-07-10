
var streamSource;

function onLoad() {
    
    //check if the browser supports Server-Sent Events 
    if (!!window.EventSource) {
        streamSource = new EventSource("streamer.php");
        setListeners();
    } else {
        alert("This browser doesn't support Server-Sent Events :-(");
    }
    
}

//set listener for data from the php script
function setListeners(){
    streamSource.addEventListener('message', function(e) {
        var data = e.data;
        console.log(data);
        
    }, false);

    streamSource.addEventListener("error", function(e) {
        if(e.readyState == EventSource.CLOSED){
            console.log("Connection closed");
        }
    },false);
    
}


window.addEventListener("load", onLoad());