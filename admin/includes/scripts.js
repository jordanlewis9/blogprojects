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