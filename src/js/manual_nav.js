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

var ros = new ROSLIB.Ros({
    url : "ws://"+getCookieValue("host_ip")+":9090"
});

ros.on('connection', function() {
    document.getElementById("conn_img").src = "images/connected.png";
    document.getElementById("conn_status").innerHTML = "Connected to server.";
    document.getElementById("video_stream").src = "http://"+getCookieValue("host_ip")+":8080/stream_viewer?topic=/camera/rgb/image_color";
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
var input_teleop = new ROSLIB.Topic({
    ros : ros,
    name : '/cmd_vel',
    messageType : 'geometry_msgs/Twist'
});

function move(linearx, angularz){
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
	    timer = setInterval(move(linear_x, angular_z), 100);
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
	    timer = setInterval(move(linear_x, 0), 100);
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
	    timer = setInterval(move(linear_x, -angular_z), 100);
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
	    timer = setInterval(move(0, angular_z), 100);
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
	    timer = setInterval(move(-linear_x, 0), 100);
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
	    timer = setInterval(move(0, -angular_z), 100);
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


