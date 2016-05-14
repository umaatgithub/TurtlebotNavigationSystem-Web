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

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

var ros = new ROSLIB.Ros({
    url : "ws://"+getCookieValue("host_ip")+":9090"
});

ros.on('connection', function() {
    document.getElementById("conn_img").src = "images/connected.png";
    document.getElementById("conn_status").innerHTML = "Connected to server.";
    document.getElementById("video_stream").src = "http://"+getCookieValue("host_ip")+":8080/stream_viewer?topic=/camera/rgb/image_color";
    initializePose();
    console.log('Connected to websocket server.');
});

ros.on('error', function(error) {
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Error connecting to server.";
    document.getElementById("video_stream").src = "";
    console.log('Error connecting to websocket server: ', error);
});

ros.on('close', function() {
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Connection to server is closed.";
    document.getElementById("video_stream").src = "";
    console.log('Connection to websocket server closed.');
});
var timer;
var twist;
var linear_x = 0.1;
var angular_z = 0.5;
var linearx;
var angularz;
var input_teleop = new ROSLIB.Topic({
    ros : ros,
    name : '/cmd_vel_mux/input/teleop',
    messageType : 'geometry_msgs/Twist'
});


function move(){
    console.log('Robot moving...');
    twist = new ROSLIB.Message({
        linear : {
            x : linearx,
            y : 0,
            z : 0
        },
        angular : {
            x : 0,
            y : 0,
            z : angularz
        }
    });
    input_teleop.publish(twist);
}

$(document).ready(function(){
    $("#linear_x_vel").change(function() {
        linear_x = parseFloat(document.getElementById("linear_x_vel").value);
        console.log('Linear X velocity : ' + linear_x);
    });
});

$(document).ready(function(){
    $("#angular_z_vel").change(function() {
        angular_z = parseFloat(document.getElementById("angular_z_vel").value);
        console.log('Angular Z velocity : ' + angular_z);
    });
});

$(document).ready(function(){
    $("#emergency_stop").click(function() {
        move(0, 0);
        console.log('Emergency stop!');
    });
});

$(document).ready(function(){
    $("#move_left").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Move left.');
	    linearx = linear_x;
	    angularz = angular_z;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#move_left").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop move left.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------

$(document).ready(function(){
    $("#move_forward").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Move forward.');
	    linearx = linear_x;
	    angularz = 0;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#move_forward").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop move forward.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------

$(document).ready(function(){
    $("#move_right").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Move right.');
	    linearx = linear_x;
	    angularz = -angular_z;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#move_right").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop move right.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------

$(document).ready(function(){
    $("#rotate_left").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Rotate left.');
	    linearx = 0;
	    angularz = angular_z;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#rotate_left").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop rotate left.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------

$(document).ready(function(){
    $("#move_backward").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Move backward.');
	    linearx = -linear_x;
	    angularz = 0;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#move_backward").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop move backward.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------

$(document).ready(function(){
    $("#rotate_right").mousedown(function(event) {
	if (event.which === 1) {
            console.log('Rotate right.');
	    linearx = 0;
	    angularz = -angular_z;
	    timer = setInterval(move, 100);
	}	
    });
});

$(document).ready(function(){
    $("#rotate_right").mouseup(function(event) {
	if (event.which === 1) {        
	    console.log('Stop rotate right.');
	    clearInterval(timer);
	}	
    });
});

//--------------------------------------------------------------------------


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
    
    if(getCookieValue("initial_pose_set")=="true"){
	    console.log('Initial pose already set.');
	}
	else{
	    console.log('Initializing pose.');
            initialPose.publish(poseWithCovarianceStamped);
	    setCookie("initial_pose_set", "true", 30);
	}
	
}

