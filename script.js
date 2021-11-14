$(document).ready(function () {
  let inputName = null;

  $(".details").on("click", "button", function (event) {
    let currVal = $(this).parent().children("span").html();
    let dataType = $(this).parent().data("type");
    let prevHtml = $(this).parent().html();
    inputName = $(this)
      .parent()
      .children("b")
      .html()
      .replace(":", "")
      .replaceAll(" ", "_")
      .toLowerCase();

    $(this)
      .parent()
      .html("")
      .append(
        $("<div></div>")
          .addClass("row")
          .append(
            $("<div></div>").addClass("col-8").append(
              $("<input/>")
                .val(currVal)
                .attr("type", dataType)
                // .attr("name", inputName)
                .addClass("form-control")
            )
          )
          .append(
            $("<div></div>")
              .addClass("col-4")
              .append(
                $("<button></button")
                  .addClass("btn btn-dark pull-right")
                  .html("Update")
                  .on("click", function (evt) {
                    let newVal = $(this)
                      .parent()
                      .parent()
                      .find(".col-8 input")
                      .val();
                    let details = $(this).parents(".details");
                    $(this).parents(".details").html(prevHtml);
                    details.children("span").html(newVal);
                    $("#update-profile-form").submit();
                  })
              )
          )
      );
    $("input[type != 'hidden']").on("keyup", function (evt) {
      $("input[name='" + inputName + "'").val(evt.target.value);
    });
  });
});
