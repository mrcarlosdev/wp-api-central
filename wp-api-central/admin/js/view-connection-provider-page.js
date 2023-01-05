jQuery(document).ready(function ($) {
  $("#setAccessToken").click(function () {
    $("#modalAccessToken").modal("show");
  });

  $("#setSubscriptionId").click(function () {
    $("#modalSubscriptionId").modal("show");
  });

  $("#setResourceGroup").click(function () {
    $("#modalResourceGroup").modal("show");
  });

  $("#setServiceId").click(function () {
    $("#modalServiceId").modal("show");
  });

  $(document).on("click", "a[data-id]", function () {
    var id = this.dataset.id;
    var url = AjaxRequest.url;

    $.ajax({
      type: "POST",
      url: url,
      data: {
        action: "deleterequest",
        nonce: AjaxRequest.security,
        id: id,
      },
      success: function () {
        location.reload();
      },
    });
  });

  $(document).on("click", "a[action-id]", function () {
    var id = this.id;
    console.log(this);
    var url = this.name;
    console.log(id, url);
    $.ajax({
      type: "GET",
      url: url,
      dataType: "JSON",
      success: function (response) {
        document.getElementById("responseTestAPIM").innerHTML =
          '<b style="color:green">Your APIManagement instance is connected!</b>';
        //JSON.stringify(response.value);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR, textStatus, errorThrown);
        document.getElementById("responseTestAPIM").innerHTML =
          '<b style="color:red">' +
          textStatus +
          ": It was not possible to establish the connection with your APIManagement instance, please check the configuration.</b>";
      },
    });
  });
});
