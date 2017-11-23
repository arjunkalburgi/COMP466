/*!
* Clientside JavaScript for COMP390 Ass1Prt4
* Copyright 2014-2017 Materialize
* MIT License (https://raw.githubusercontent.com/Dogfalo/materialize/master/LICENSE)
*/
$(document).ready(function() {
    $('select').material_select();
});

$("#app1").click(function() {
	var xhr
	try {
		xhr = new window.XMLHttpRequest(); 
	} catch (e) {
		xhr = false; 
	}
	xhr.onreadystatechange = function(){ 
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				$("#content").html(xhr.responseText); 
				$('select').material_select();
			} else {
				document.ajax.dyn="Error code " + xhr.status;
			}
		}
	}; 
	xhr.open("GET", "toolfiles/unitconv.html", true); 
	xhr.send(null);
})


$("#app2").click(function() {
	var xhr
	try {
		xhr = new window.XMLHttpRequest(); 
	} catch (e) {
		xhr = false; 
	}
	xhr.onreadystatechange = function(){ 
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				$("#content").html(xhr.responseText); 
				$('select').material_select();
			} else {
				document.ajax.dyn="Error code " + xhr.status;
			}
		}
	}; 
	xhr.open("GET", "toolfiles/morgcalc.html", true); 
	xhr.send(null);
})


$("#app3").click(function() {
	var xhr
	try {
		xhr = new window.XMLHttpRequest(); 
	} catch (e) {
		xhr = false; 
	}
	xhr.onreadystatechange = function(){ 
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				$("#content").html(xhr.responseText); 
				$('select').material_select();
			} else {
				document.ajax.dyn="Error code " + xhr.status;
			}
		}
	}; 
	xhr.open("GET", "toolfiles/retircalc.html", true); 
	xhr.send(null);
})
