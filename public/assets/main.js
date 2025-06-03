$(document).ready(function () {
    // (error, success) messages timeout
    $("#errorMsg, #successMsg").fadeIn("fast");

    setTimeout(function () {
        $("#errorMsg, #successMsg").fadeOut("fast");
    }, 3000);

    // Set delete form action dynamically
    $("#deleteModal").on("show.bs.modal", (e) => {
        let button = $(e.relatedTarget);
        let url = button.data("url");
        $("#deleteForm").attr("action", url);
    });
});
