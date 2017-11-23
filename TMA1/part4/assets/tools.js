
function retireCalc() {
	var ca = document.retirement.cAge.value;
	var ra = document.retirement.rAge.value;
	var ys = document.retirement.years.value;
	var s = document.retirement.salary.value;
	var ss = document.retirement.ssecurity.value;

	if (isEmpty(ca, ra, ys, s, ss)) {
		window.alert("Please fill in all boxes.");
		return;
	}
	if (!isNum(ca, ra, ys, s, ss)) {
		window.alert("Please use numbers only.");
		return;
	}

	var x = (0.8 * s * Math.pow(1.03, ra - ca) - ss) * ys;

	document.retirement.save.value = x.toFixed(2);
}

function mortgageCalc() {
	
	if (isEmpty(document.mortgage.purchase.value, document.mortgage.down.value, document.mortgage.rate.value, document.mortgage.term.value)) {
		window.alert("Please fill in each field.");
		return;
	}
	if (!isNum(document.mortgage.purchase.value, document.mortgage.down.value, document.mortgage.rate.value, document.mortgage.term.value)) {
		window.alert("Please use only numbers.");
		return;
	}
	
	var p = document.mortgage.purchase.value - document.mortgage.down.value;
	var i = (document.mortgage.rate.value / 100) / 12;
	var n = document.mortgage.term.value * 12;

	var mp = p * (i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1);

	document.mortgage.monthlyPay.value = mp.toFixed(2);
}


function isEmpty() {
 	for (var i = arguments.length - 1; i >= 0; i--) {
 		if (arguments[i] == null || arguments[i] == "") {
 			return true;
 		}
	}
	return false;
}


function isNum() {
 	for (var i = arguments.length - 1; i >= 0; i--) {
  		if (!arguments[i].match(/^\d+$/)) {
  			return false;
  		}
  	}
  	return true;
}


function unitChange(newType) {
	var xhr
	try {
		xhr = new window.XMLHttpRequest(); 
	} catch (e) {
		xhr = false; 
	}
	xhr.onreadystatechange = function(){ 
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
				$(".oUnit label").empty().html(" "); 
				$(".cUnit label").empty().html(" "); 
				$(".oUnit label").html('<select name="oUnit">' + xhr.responseText + '</select>'); 
				$(".cUnit label").html('<select name="cUnit">' + xhr.responseText + '</select>'); 
				$('select').material_select();
			} else {
				document.ajax.dyn="Error code " + xhr.status;
			}
		}
	}; 
	if (newType == 0) {
		xhr.open("GET", "toolfiles/unitchangeoptions0.html", true); 
	} else if (newType == 1) {
		xhr.open("GET", "toolfiles/unitchangeoptions1.html", true); 
	} else if (newType == 2) {
		xhr.open("GET", "toolfiles/unitchangeoptions2.html", true); 
	} else if (newType == 3) {
		xhr.open("GET", "toolfiles/unitchangeoptions3.html", true); 
	}
	xhr.send(null);
}

function makeOption(newText) {
	var x = document.createElement("option");
	x.text = newText;
	return x;
}

function convertCheck() {
	var o = document.converter.original.value;

	if (isEmpty(o)){
		window.alert("Please enter a value into the box.");
		document.converter.original.focus();
		return;
	}

	if (!isNum(o)) {
		window.alert("Please use a numeric value.");
		document.converter.original.focus();
		return;
	}

	convertCalc(o);
	
}

function convertCalc(o) {
	var result;
	var convertType = document.converter.convertChoice.selectedIndex;
	var ou = document.converter.oUnit.selectedIndex;
	var cu = document.converter.cUnit.selectedIndex;

	if (convertType == 0) {
		switch (ou) {
			case 0:
				result = o * 1016046.9088;
				break;
			case 1:
				result = o * 6350.29318;
				break;
			case 2:
				result = o * 453.59237;
				break;
			case 3:
				result = o * 28.349523125;
				break;
			case 4:
				result = o * 1000000;
				break;
			case 5:
				result = o * 1000;
				break;
			case 6:
				result = o;
				break;
			case 7:
				result = o * 0.001;
				break;
			case 8:
				result = o * 0.000001;
				break;
		}
		switch (cu) {
			case 0:
				result = result / 1016046.9088;
				break;
			case 1:
				result = result / 6350.29318;
				break;
			case 2:
				result = result / 453.59237;
				break;
			case 3:
				result = result / 28.349523125;
				break;
			case 4:
				result = result / 1000000;
				break;
			case 5:
				result = result / 1000;
				break;
			case 6:
				break;
			case 7:
				result = result / 0.001;
				break;
			case 8:
				result = result / 0.000001;
				break;
		}
	}
	else if (convertType == 1) {
		switch (ou) {
			case 0:
				result = o * 1853.184;
				break;
			case 1:
				result = o * 1609.344;
				break;
			case 2:
				result = o * 0.9144;
				break;
			case 3:
				result = o * 0.3048;
				break;
			case 4:
				result = o * 0.00254;
				break;
			case 5:
				result = o * 1000;
				break;
			case 6:
				result = o;
				break;
			case 7:
				result = o * 0.01;
				break;
			case 8:
				result = o * 0.001;
				break;
			case 9:
				result = o * 0.000001;
				break;
			case 10:
				result = o * 0.000000001;
				break;
		}
		switch (cu) {
			case 0:
				result = result / 1853.184;
				break;
			case 1:
				result = result / 1609.344;
				break;
			case 2:
				result = result / 0.9144;
				break;
			case 3:
				result = result / 0.3048;
				break;
			case 4:
				result = result / 0.00254;
				break;
			case 5:
				result = result / 1000;
				break;
			case 6:
				break;
			case 7:
				result = result / 0.01;
				break;
			case 8:
				result = result / 0.001;
				break;
			case 9:
				result = result / 0.000001;
				break;
			case 10:
				result = result / 0.000000001;
				break;
		}
	}
	else if (convertType == 2) {
		switch (ou) {
			case 0:
				result = o * 4046.8564224;
				break;
			case 1:
				result = o * (1609.344 * 1609.344);
				break;
			case 2:
				result = o * (0.3048 * 0.3048);
				break;
			case 3:
				result = o * (0.00254 * 0.00254);
				break;
			case 4:
				result = o * 10000;
				break;
			case 5:
				result = o * (1000 * 1000);
				break;
			case 6:
				result = o;
				break;
		}
		switch (cu) {
			case 0:
				result = result / 4046.8564224;
				break;
			case 1:
				result = result / (1609.344 * 1609.344);
				break;
			case 2:
				result = result / (0.3048 * 0.3048);
				break;
			case 3:
				result = result / (0.00254 * 0.00254);
				break;
			case 4:
				result = result / 10000;
				break;
			case 5:
				result = result / (1000 * 1000);
				break;
			case 6:
				break;
		}
	}
	else if (convertType == 3) {
		switch (ou) {
			case 0:
				result = o * 28316.8;
				break;
			case 1:
				result = o * 16.3870370367249;
				break;
			case 2:
				result = o * 4546.09;
				break;
			case 3:
				result = o * 1136.5225;
				break;
			case 4:
				result = o * 568.26125;
				break;
			case 5:
				result = o * 28.4130625;
				break;
			case 6:
				result = o * 1000000;
				break;
			case 7:
				result = o * 1000;
				break;
			case 8:
				result = o;
				break;
		}
		switch (cu) {
			case 0:
				result = result / 28316.8;
				break;
			case 1:
				result = result / 16.3870370367249;
				break;
			case 2:
				result = result / 4546.09;
				break;
			case 3:
				result = result / 1136.5225;
				break;
			case 4:
				result = result / 568.26125;
				break;
			case 5:
				result = result / 28.4130625;
				break;
			case 6:
				result = result / 1000000;
				break;
			case 7:
				result = result / 1000;
				break;
			case 8:
				break;
		}
	}

	document.converter.converted.value = result;
}

// var asyncRequest;
// function registerListeners() {
// 	var img;
// 	img = document.getElementById("i1");
// 	img.addEventListener("click", function() { getContent("measureConvert.htm"); }, false);
// 	img = document.getElementById("i2");
// 	img.addEventListener("click", function() { getContent("mortgageCalc.htm"); }, false);
// 	img = document.getElementById("i3");
// 	img.addEventListener("click", function() { getContent("retireCalc.htm"); }, false);
// }

// function getContent(url) {
// 	try {
// 		asyncRequest = new XMLHttpRequest();
// 		asyncRequest.addEventListener("readystatechange", stateChange, false);
// 		asyncRequest.open("GET", url, true);
// 		asyncRequest.send(null);
// 	}
// 	catch (exception) {
// 		window.alert("Request failed.");
// 	}
// }

// function stateChange() {
// 	if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
// 		document.getElementById("convertArea").innerHTML = "";
// 		document.getElementById("convertArea").innerHTML = asyncRequest.responseText;
// 		unitChange(0);
// 	}
// }

// window.addEventListener("load", registerListeners, false);
