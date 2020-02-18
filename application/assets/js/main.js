$(document).ready(function() {
  getList();
  $(".checkbox-note").change(function() {
    getList();
  });
  $(".btn-search").click(function() {
    getList();
  });
  $(".checkAll .on").click(function() {
    $(".checkbox-note").prop("checked", true);
    getList();
  });
  $(".checkAll .off").click(function() {
    $(".checkbox-note").prop("checked", false);
    getList();
  });
});

function getList() {
  var data = $(".search-form").serialize();

  var notes = "&notes=";

  $(".checkbox-note:checked").each(function(ite) {
    notes += $(this).val() + ",";
  });
  notes = notes.slice(0, -1);

  $.ajax({
    url: "?/main/getList",
    type: "POST",
    data: data+notes,
    dataType: "JSON",
    success: function(data) {
      $(".search .list").html(data.html);
    }
  });
}
