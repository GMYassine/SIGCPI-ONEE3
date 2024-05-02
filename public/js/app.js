// dropdown
function slideDown(element) {
    element.nextElementSibling.style.display = "block";
    element.classList.replace("bi-caret-down-square","bi-caret-up-square");
    element.setAttribute("onclick","slideUp(this)");
}
function slideUp(element) {
    element.nextElementSibling.style.display = "none";
    element.classList.replace("bi-caret-up-square","bi-caret-down-square");
    element.setAttribute("onclick","slideDown(this)");
}