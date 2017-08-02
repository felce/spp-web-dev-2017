var friendId = "";

var names = [
	["A Zabara", "img/img1.png"],
	["A Oleynick", "img/img2.png"],
	["S Kolisnichenco", "img/img3.png"],
	["O Brajnichenco", "img/img4.png"]
];

$(document).ready(function () {
	for (var i = 0; i < names.length; i++) {
		$("#friend-list").append("<div class='friend' id='" + names[i][0] + "'><img width='20' src='" + names[i][1] + "'>" + names[i][0] + "</div>");
	}

	for (var i = 0; i < names.length; i++) {
		var color = "#" + Math.floor(Math.random() * 700000 + 100000);
		console.log(color);
		$("img:eq(" + i + ")").css('background-color', color);
	}

	$("#spanDown").click(
		function () {
			$(".friend").slideToggle();
		}
	);

	$(".friend").hover(
		function () {
			$(this).css('background-color', 'whitesmoke');
		},
		function () {
			$(this).css('background', 'none');
		}
	);

	$(".friend").click(
		function () {
			$("#friend-list div").hide();
			$("span").hide();
			$(this).show();
			$(".down").show();
			friendId = this.id;
			$("#result").html("<b>Friend ID: </b>" + friendId);
		}
	)
});
