function show(){
  if ($("#messages:hover").length == 0) {
    $("#messages").scrollTop($("#messages")[0].scrollHeight - $("#messages")[0].clientHeight);
  }
  $.ajax({
    url: "find.php",
    cache: false,
    success: function(html) {
      $("#messages").html(html);
    }
  });
}
setInterval("show()", 1000);

$("#formMessage").submit(function(){
  var str = $(this).serialize();
  $("#text").value = "";
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
