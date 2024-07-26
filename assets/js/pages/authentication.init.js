$("[data-password]").on("click", function () {
    "false" == $(this).attr("data-password")
        ? ($(this).siblings("input").attr("type", "text"),
            $(this).attr("data-password", "true"),
            $(this).addClass("show-password"))
        : ($(this).siblings("input").attr("type", "password"),
            $(this).attr("data-password", "false"),
            $(this).removeClass("show-password"));
});
