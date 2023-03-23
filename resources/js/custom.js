$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    ///remove product from cart
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
    //cart quantity increase
    $(document).on("click", "#cart-increase", function (e) {
        e.preventDefault;
        var id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "/cartincrease/" + id,
            success: function (data) {
                console.log(data);
                location.reload();
            },
        });
    });
    //cart quantity decrease
    $(document).on("click", "#cart-decrease", function (e) {
        e.preventDefault;
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/cartdecrease/" + id,
            success: function (data) {
                location.reload();
            },
        });
    });
});
