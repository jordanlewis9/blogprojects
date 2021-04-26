// Delete modal

const deleteLink = document.querySelectorAll(".delete__link");
const deleteModal = document.querySelector(".delete__modal");
const deleteModalConfirm = document.querySelector(".delete__modal--confirm-button");
const deleteModalCancel = document.querySelector(".delete__modal--cancel-button");
const deleteModalHeadline = document.querySelector(".delete__modal--headline");
const deleteModalContainer = document.querySelector(".delete__modal--container");

const removeModal = (e) => {
  console.log("toggled")
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
  deleteModalConfirm.setAttribute('href', `delete_${deleteModalSection}.php?${deleteModalSection}_id=${deleteModalId}`);
  setTimeout(() => {
    window.addEventListener("click", removeModal);
  }, 50);
}

if (deleteLink) {
  deleteLink.forEach(link => {
    link.addEventListener("click", showDeleteModal);
  })
}