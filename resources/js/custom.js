$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).on("click", "#Removetocart", function (e) {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/removeCart/" + id,
            success: function (data) {
                console.log(data);
                location.reload();
            },
        });
    });
});
