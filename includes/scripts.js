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

const loginForm = document.querySelector(".login__form");
const signupForm = document.querySelector(".signup__form");
const commentForm = document.querySelector(".comment__form");
const username = document.querySelector(".input__username");
const password = document.querySelector(".input__password");
const email = document.querySelector(".input__email");
const firstName = document.querySelector(".input__first-name");
const lastName = document.querySelector(".input__last-name");
const comment = document.querySelector(".input__comment");

const userInputs = [username, password, email, firstName, lastName, comment];
const userForms = [loginForm, signupForm, commentForm];

const usernameValidate = (input) => {
  return /^(\w|\d){4,15}$/.test(input);
}

const passwordValidate = (input) => {
  let isValid = [];
  isValid.push(/[A-Z]/.test(input));
  isValid.push(/[a-z]/.test(input));
  isValid.push(/^\S{6,20}$/.test(input));
  return !isValid.some(bool => bool === false);
}

const emailValidate = (input) => {
  return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{2,63}@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/i.test(input);
}

const nameValidate = (input) => {
  return /^[a-zA-Z']{1,30}(-[a-zA-Z']{1,20}|\s[a-zA-Z']{1,20})?([\s-a-zA-Z']{1,20})?$/i.test(input);
}

const commentValidate = (input) => {
  return /^.{2,}$/.test(input);
}

const inputRequired = (e) => {
  const messageContainer = e.target.parentNode;
  if (e.target.value === "" && e.target.classList.contains("input__required")) {
    return null;
  } else if (e.target.value === "") {
    e.target.classList.add("input__required");
    let field = e.target.id.substring(0, 1).toUpperCase() + e.target.id.substring(1);
    if (field.includes('_')) {
      field = field.replace('_', ' ');
    }
    messageContainer.insertAdjacentHTML('beforeend', `<p class="input__error">${field} cannot be empty</p>`);
  } else if (e.target.classList.contains("input__required")) {
    e.target.classList.remove("input__required");
    const inputError = messageContainer.querySelector('.input__error');
    messageContainer.removeChild(inputError);
  }
}

const validateInput = e => {
  userInputs.forEach(input => {
    if (input) {
      if (input.classList.contains("input__invalid")) {
        input.classList.remove("input__invalid");
        const inputError = input.parentNode.querySelector('.input__fail');
        input.parentNode.removeChild(inputError);
      }
    }
  })
  let isValid = true;
  userInputs.forEach(input => {
    if (!input) {
      return null;
    }
    const messageContainer = input.parentNode;
    switch (input) {
      case username:
        if (!usernameValidate(input.value)) {
          isValid = false;
          username.classList.add("input__invalid");
          messageContainer.insertAdjacentHTML('beforeend', `<p class="input__fail">Username must be alphanumeric and 4-15 characters in length</p>`);
        }
        break;
      case password:
        if (!passwordValidate(input.value)) {
          isValid = false;
          password.classList.add("input__invalid");
          messageContainer.insertAdjacentHTML('beforeend', `<p class="input__fail">Password must have at least one uppercase letter, one lowercase letter, be 6-20 characters in length, and contain no spaces</p>`);
        }
        break;
      case email:
        if (!emailValidate(input.value)) {
          isValid = false;
          email.classList.add("input__invalid");
          messageContainer.insertAdjacentHTML('beforeend', `<p class="input__fail">Email is invalid. Please use a different one</p>`);
        }
        break;
      case firstName:
      case lastName:
        if (!nameValidate(input.value)) {
          isValid = false;
          input.classList.add("input__invalid");
          messageContainer.insertAdjacentHTML('beforeend', `<p class="input__fail">Name is invalid. First and last name must be at least 2 letter long</p>`);
        }
        break;
      case comment:
        if (!commentValidate(input.value)) {
          isValid = false;
          input.classList.add("input__invalid");
          messageContainer.insertAdjacentHTML('beforeend', `<p class="input__fail">Name is invalid. First and last name must be at least 2 letter long</p>`);
        }
        break;
      default:
        return null;
    }
  })
  if (isValid) {
    loginForm.submit();
  } else {
    e.preventDefault();
  }
}

if (loginForm || signupForm || commentForm) {
  userForms.forEach(form => {
    if (form) {
      form.addEventListener("submit", validateInput);
    }
  })
  userInputs.forEach(input => {
    if (input) {
      input.addEventListener("focusout", inputRequired);
    }
  });
}
