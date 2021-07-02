// Delete modal

const deleteLink = document.querySelectorAll(".delete__link");
const deleteModal = document.querySelector(".delete__modal");
const deleteModalConfirm = document.querySelector(".delete__modal--confirm-link");
const deleteModalCancel = document.querySelector(".delete__modal--cancel-button");
const deleteModalHeadline = document.querySelector(".delete__modal--headline");
const deleteModalContainer = document.querySelector(".delete__modal--container");

const removeModal = (e) => {
  if (!e.target.closest(".delete__modal--container") || e.target.closest(".delete__modal--cancel-button")) {
    deleteModal.classList.add("hide__modal");
    window.removeEventListener("click", removeModal);
  }
}

const showDeleteModal = (e) => {
  const deleteModalSection = e.target.dataset.table;
  const deleteModalId = e.target.dataset.id;
  const deleteModalSubject = e.target.dataset.single;
  deleteModal.classList.remove("hide__modal");
  deleteModalHeadline.innerHTML = `Are you sure you want to delete ${deleteModalSection} ${deleteModalSubject}?`;
  deleteModalConfirm.setAttribute('href', `delete_item.php?${deleteModalSection}_id=${deleteModalId}`);
  setTimeout(() => {
    window.addEventListener("click", removeModal);
  }, 50);
}

if (deleteLink) {
  deleteLink.forEach(link => {
    link.addEventListener("click", showDeleteModal);
  })
}

// Image Preview

const picInput = document.querySelector("#picture");
let previewPic = document.querySelector(".admin__form--picture-preview");
const previewPicText = document.querySelector(".admin__form--picture-file");
const pictureContainer = document.querySelector("#admin__form--picture-container");

const showPreview = (e) => {
  if (!previewPic) {
    previewPic = document.createElement("img");
    previewPic.classList.add("admin__form--picture-preview");
    previewPic.setAttribute("src", URL.createObjectURL(picInput.files[0]));
    pictureContainer.insertAdjacentElement('afterbegin', previewPic);
  } else {
    previewPic.setAttribute("src", URL.createObjectURL(picInput.files[0]));
  }
  previewPicText.textContent = picInput.files[0].name;
}

if (picInput) {
  picInput.addEventListener("change", showPreview);
}

// WYSIWYG editor

const editor = document.querySelector(".editor");

if (editor) {
  ClassicEditor.create(editor).catch(err => console.error(err));
}

// Input validation

const blogForm = document.querySelector("#admin-blog-form");
const projectForm = document.querySelector("#admin-project-form");
const userForm = document.querySelector("#admin-user-form");
const altText = document.querySelector("#alt_text");
const title = document.querySelector("#title");
const author = document.querySelector("#author");
const content = document.querySelector("#content");
const description = document.querySelector("#description");
const snippet = document.querySelector("#snippet");
const link = document.querySelector("#link");
const username = document.querySelector("#username");
const email = document.querySelector("#email");
const firstName = document.querySelector("#first_name");
const lastName = document.querySelector("#last_name");
const password = document.querySelector("#password");

const adminInputs = [altText, title, author, content, description, snippet, link, username, email, firstName, lastName, password];
const adminForms = [blogForm, projectForm, userForm];

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

if (blogForm || projectForm || userForm) {
  adminForms.forEach(form => {
    if (form) {
      form.addEventListener('submit', validateInput);
    }
  })
  adminInputs.forEach(input => {
    if (input) {
      input.addEventListener('focusout', inputRequired);
    }
  })
}