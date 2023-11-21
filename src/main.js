const navLinks = document.querySelector(".nav-links");

function onToggleMenu(e) {
    e.name = e.name === "menu" ? "close" : "menu";
    navLinks.classList.toggle("top-[7%]");
}

function updateNavBackground() {
    var nav = document.getElementById("nav");
    if (window.innerWidth < 768) {
        nav.classList.add("bg-white");
    } else {
        nav.classList.remove("bg-white");
    }
}