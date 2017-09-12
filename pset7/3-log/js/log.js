function logToConsole(text) {
	$.ajax({
		type: "POST",
		url: "js-loggin.php",
		success: function (logg) {
				if ( logg != "" ){
				console.log(logg);
			}

		}
	});
}

setInterval("logToConsole()", 1000);
