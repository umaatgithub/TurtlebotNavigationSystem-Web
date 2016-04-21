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
        height : 350
    });
    
    if(connection_flag == true){
    var nav = NAV2D.OccupancyGridClientNav({
        ros : ros,
        rootObject : viewer.scene,
        viewer : viewer,
        continuous : true,
        serverName : 'move_base'
    });
    }
    console.log('Calling function initialize pose.');
    initializePose();
}

var initialPose = new ROSLIB.Topic({
    ros : ros,
    name : '/initialpose',
    messageType : 'geometry_msgs/PoseWithCovarianceStamped'
});

var poseWithCovarianceStamped = new ROSLIB.Message({
    header : {
        seq : 0,
        stamp : {
	    secs: 0,
            nsecs: 0	
	},
        frame_id : 'map'
    },
    pose : {
        pose : {
	    position : {
	        x : 0.312246918678,
		y : 0.267449855804,
		z : 0.0
	    },
            orientation : {
		x : 0.0,
		y : 0.0,
		z : 0.709902956535,
		w : 0.704299504688
	    }
	},
	covariance : [0.25, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.06853891945200942]
    }
});

function initializePose(){
    console.log('In function initialize pose.');
    if(connection_flag == true){
        console.log('Initializing pose.');
        initialPose.publish(poseWithCovarianceStamped);
    }
}
