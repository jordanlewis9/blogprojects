// Mobile hamburger

const navbar = document.querySelector(".nav");
const navList = document.querySelector(".nav__list");
const navHamburger = document.querySelector(".nav__hamburger");
const oneLine = document.querySelector(".line-1");
const twoLine = document.querySelector(".line-2")
const threeLine = document.querySelector(".line-3");

const openMenu = (e) => {
    oneLine.classList.add("nav__x--top");
    threeLine.classList.add("nav__x--bottom");
    twoLine.classList.add("nav__hide");
    navHamburger.classList.add("nav__hide--border");
    navbar.classList.add("nav__expand");
    navList.classList.add("nav__list--expand");
    navHamburger.removeEventListener("click", openMenu);
    navHamburger.addEventListener("click", closeMenu);
}

const closeMenu = (e) => {
  oneLine.classList.remove("nav__x--top");
  threeLine.classList.remove("nav__x--bottom");
  twoLine.classList.remove("nav__hide");
  navHamburger.classList.remove("nav__hide--border");
  navbar.classList.remove("nav__expand");
  navList.classList.remove("nav__list--expand");
  navHamburger.removeEventListener("click", closeMenu);
  navHamburger.addEventListener("click", openMenu)
}

if (navHamburger) {
  navHamburger.addEventListener("click", openMenu)
}