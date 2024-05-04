document.addEventListener("DOMContentLoaded", function () {
    var button = document.getElementById("back-to-top-btn");

    window.onscroll = function () {
        if (window.scrollY > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    };

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
    button.addEventListener("click", scrollToTop);
});

const $panels = document.querySelectorAll('.panel');
$panels.forEach($panel => {
    $panel.addEventListener("click", () => {
        removeActiveClasses();
        $panel.classList.add("active");
    });
});

function removeActiveClasses() {
    $panels.forEach($panel => {
        $panel.classList.remove("active");
    });
}