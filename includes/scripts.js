// Mobile hamburger

const navbar = document.querySelector(".nav");
const navList = document.querySelector(".nav__list");
const navHamburger = document.querySelector(".nav__hamburger");
const oneLine = document.querySelector(".line-1");
const twoLine = document.querySelector(".line-2")
const threeLine = document.querySelector(".line-3");
let isHamburgerOpen = false;

const throttle = (callback, delay) => {
  let throttleTimeout = null;
  let storedEvent = null;

  const throttledEventHandler = event => {
    storedEvent = event;
    const shouldHandleEvent = !throttleTimeout;

    if (shouldHandleEvent) {
      callback(storedEvent);
      storedEvent = null;
      throttleTimeout = setTimeout(() => {
        throttleTimeout = null;
        if (storedEvent) {
          throttledEventHandler(storedEvent);
        }
      }, delay);
    }
  }
  return throttledEventHandler;
}

const removeClasses = () => {
  oneLine.classList.remove("nav__x--top");
  threeLine.classList.remove("nav__x--bottom");
  twoLine.classList.remove("nav__hide");
  navHamburger.classList.remove("nav__hide--border");
  navbar.classList.remove("nav__expand");
  navList.classList.remove("nav__list--expand");
  window.removeEventListener("click", closeMenu);
  navHamburger.addEventListener("click", openMenu);
}

const openMenu = (e) => {
    oneLine.classList.add("nav__x--top");
    threeLine.classList.add("nav__x--bottom");
    twoLine.classList.add("nav__hide");
    navHamburger.classList.add("nav__hide--border");
    navbar.classList.add("nav__expand");
    navList.classList.add("nav__list--expand");
    navHamburger.removeEventListener("click", openMenu);
    setTimeout(() => {
      window.addEventListener("click", closeMenu);
      isHamburgerOpen = true;
    }, 1);
}

const closeMenu = (e) => {
  if (!e.target.closest(".nav") || e.target.closest(".nav__hamburger")) {
    removeClasses();
    isHamburgerOpen = false;
  }
}

const resizedWindow = e => {
  if (e.target.innerWidth > 600 && isHamburgerOpen) {
    removeClasses();
    isHamburgerOpen = false;
  }
}

if (navHamburger) {
  navHamburger.addEventListener("click", openMenu);
  window.addEventListener("resize", throttle(resizedWindow, 100));
}

// Handling inputs

const username = document.querySelector(".input__username");
const password = document.querySelector(".input__password");

const inputRequired = (e) => {
  if (e.target.value === "") {
    e.target.classList.add("input__required");
  } else if (e.target.closest(".input__required")) {
    e.target.classList.remove("input__required");
  }
}

let isactive = false;

username.addEventListener("focusout", inputRequired)