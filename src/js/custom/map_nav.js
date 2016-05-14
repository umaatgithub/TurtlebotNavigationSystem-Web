function getCookieValue(cookie_name) {
    name = cookie_name + "=";
    cookie_array = document.cookie.split(';');
    for(var i=0; i<cookie_array.length; i++) {
        var cookie = cookie_array[i];
        while (cookie.charAt(0)==' ') 
	    cookie = cookie.substring(1);
        if (cookie.indexOf(name) == 0) 
	    return cookie.substring(name.length, cookie.length);
    }
    return "";
}

var connection_flag = false;

var ros = new ROSLIB.Ros({
    url : "ws://"+getCookieValue("host_ip")+":9090"
});

ros.on('connection', function() {
    connection_flag = true;
    document.getElementById("conn_img").src = "images/connected.png";
    document.getElementById("conn_status").innerHTML = "Connected to server.";
    document.getElementById("video_stream").src = "http://"+getCookieValue("host_ip")+":8080/stream_viewer?topic=/camera/rgb/image_color";
    console.log('Connected to websocket server.');
});

ros.on('error', function(error) {
    connection_flag = false;
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Error connecting to server.";
    document.getElementById("video_stream").src = "";
    console.log('Error connecting to websocket server: ', error);
});

ros.on('close', function() {
    connection_flag = false;
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Connection to server is closed.";
    document.getElementById("video_stream").src = "";
    console.log('Connection to websocket server closed.');
});

function loadMap(){
    console.log('Loading map.');
    var viewer = new ROS2D.Viewer({
        divID : 'map',
        width : 350,
        height : 200
    });
    
    var nav = NAV2D.OccupancyGridClientNav({
        ros : ros,
        rootObject : viewer.scene,
        viewer : viewer,
        continuous : true,
        serverName : 'move_base',
	withOrientation :true
    });
    
}


