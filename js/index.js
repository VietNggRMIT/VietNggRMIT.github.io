const collapseBtn = document.querySelectorAll(".navbar-toggler");
const collapseNav = document.querySelector(".navbar-collapse");

for (let i = 0; i < collapseBtn.length; i++) {
    collapseBtn[i].addEventListener("click", function () {
        collapseNav.classList.toggle("active")
    })
}