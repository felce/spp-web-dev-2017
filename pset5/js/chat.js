$(document).ready(function() {
  $.ajax({
    url: "welcome.php",
    cache: false,
    success: function(html) {
      $("#messages").html(html);
    }
  });
  $.ajax({
    url: "welcomemessage.php",
    cache: false,
    success: function(html) {
      $("#welcomemessage").html(html);
      setTimeout(function () {
        $("#welcomemessage").hide();
      }, 5000);

    }
  });

})

function show() {
  if ($("#messages:hover").length === 0) {
    $("#chatcnt").scrollTop($("#chatcnt")[0].scrollHeight - $("#chatcnt")[0].clientHeight);
  }

  $.ajax({
    url: "find.php",
    cache: false,
    success: function(html) {
      $("#messages").append(html);
    }
  });
}
setInterval("show()", 1000);

$("#formMessage").submit(function(){
  var str = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "addMessage.php",
      data: str,
      success: function() {
          $("#formMessage")[0].reset();
      }
    });
    return false;
});
