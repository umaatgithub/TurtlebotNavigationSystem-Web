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
    console.log('Connected to websocket server.');
});

ros.on('error', function(error) {
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Error connecting to server.";
    console.log('Error connecting to websocket server: ', error);
});

ros.on('close', function() {
    document.getElementById("conn_img").src = "images/disconnected.png";
    document.getElementById("conn_status").innerHTML = "Connection to server is closed.";
    console.log('Connection to websocket server closed.');
});

var max_vel_x = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/TrajectoryPlannerROS/max_vel_x'
});

var min_vel_x = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/TrajectoryPlannerROS/min_vel_x'
});

var max_rotational_vel = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/TrajectoryPlannerROS/max_rotational_vel'
});

var min_in_place_vel_theta = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/TrajectoryPlannerROS/min_in_place_vel_theta'
});

var obstacle_range = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/global_costmap/obstacle_layer/obstacle_range'
});

var inflation_radius = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/global_costmap/inflation_layer/inflation_radius'
});

var update_frequency_global = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/global_costmap/update_frequency'
});

var update_frequency_local = new ROSLIB.Param({
    ros : ros,
    name : '/move_base/local_costmap/update_frequency'
});

function fetchParameters(){
    max_vel_x.get(function(value){
	console.log('MAX VEL X: ' + value);
        $("#max_vel_x").val(value); 
    });

    min_vel_x.get(function(value){
	console.log('MIN VEL X: ' + value);
        $("#min_vel_x").val(value); 
    });

    max_rotational_vel.get(function(value){
	console.log('MAX ANGULAR VEL: ' + value);
        $("#max_rotational_vel").val(value); 
    });

    min_in_place_vel_theta.get(function(value){
	console.log('MIN ANGULAR VEL: ' + value);
        $("#min_in_place_vel_theta").val(value); 
    });

    obstacle_range.get(function(value){
	console.log('OBSTACLE RANGE: ' + value);
        $("#obstacle_range").val(value); 
    });

    inflation_radius.get(function(value){
	console.log('INFLATION RADIUS: ' + value);
        $("#inflation_radius").val(value); 
    });

    update_frequency_global.get(function(value){
	console.log('UPDATE FREQUENCY GLOBAL: ' + value);
        $("#update_frequency_global").val(value); 
    });

    update_frequency_local.get(function(value){
	console.log('UPDATE FREQUENCY LOCAL: ' + value);
        $("#update_frequency_local").val(value); 
    });
}

function updateParameters(){
    max_vel_x.set($("#max_vel_x").val());
    min_vel_x.set($("#min_vel_x").val());
    max_rotational_vel.set($("#max_rotational_vel").val());
    min_in_place_vel_theta.set($("#max_vel_x").val());
    obstacle_range.set($("#obstacle_range").val());
    inflation_radius.set($("#inflation_radius").val());
    update_frequency_global.set($("#update_frequency_global").val());
    update_frequency_local.set($("#update_frequency_local").val());
    return true;
}


$(document).ready(function(){
    $("#resetparam").click(function() {
        resetParameters();
    });
});


function resetParameters(){
    max_vel_x.set($("#def_max_vel_x").val());
    min_vel_x.set($("#def_min_vel_x").val());
    max_rotational_vel.set($("#def_max_rotational_vel").val());
    min_in_place_vel_theta.set($("#def_max_vel_x").val());
    obstacle_range.set($("#def_obstacle_range").val());
    inflation_radius.set($("#def_inflation_radius").val());
    update_frequency_global.set($("#def_update_frequency_global").val());
    update_frequency_local.set($("#def_update_frequency_local").val());
    location.reload(true);
}




