(function () {
    "use strict";
    window.addEventListener(
        "load",
        function () {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(
                forms,
                function (form) {
                    form.addEventListener(
                        "submit",
                        function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                }
            );
        },
        false
    );
})();

$(function () {
    var url = window.location;
    // for single sidebar menu
    $("ul.nav-sidebar a")
        .filter(function () {
            return this.href == url;
        })
        .addClass("active");

    // for sidebar menu and treeview
    $("ul.nav-treeview a")
        .filter(function () {
            return this.href == url;
        })
        .parentsUntil(".nav-sidebar > .nav-treeview")
        .css({
            display: "block",
        })
        .addClass("menu-open")
        .prev("a")
        .addClass("active");
});

$(document).on("click", "#btn-delete", function (e) {
    e.preventDefault();
    var form = $(this).closest("form");
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7367f0",
        cancelButtonColor: "#82868b",
        confirmButtonText: "Yes, delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

(function () {
    "use strict";
    window.addEventListener(
        "load",
        function () {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(
                forms,
                function (form) {
                    form.addEventListener(
                        "submit",
                        function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                }
            );
        },
        false
    );
})();

$(".log-out").on("click", function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7367f0",
        cancelButtonColor: "#82868b",
        confirmButtonText: "Yes, Log Out !",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#logging-out").submit();
        }
    });
});
