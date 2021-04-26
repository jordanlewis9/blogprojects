// Delete modal

const deleteLink = document.querySelector(".delete__link");
const deleteModal = document.querySelector(".delete__modal");
const deleteModalConfirm = document.querySelector(".delete__modal--confirm-button");
const deleteModalHeadline = document.querySelector(".delete__modal--headline");

const showDeleteModal = (e) => {
  const deleteModalSection = e.target.dataset.table;
  const deleteModalId = e.target.dataset.id;
  const deleteModalSubject = e.target.dataset.single;
  deleteModal.classList.remove(".hide__modal");
  deleteModalHeadline.innerHTML = `Are you sure you want to delete ${deleteModalSection} ${deleteModalSubject}?`;
  deleteModalConfirm.setAttribute('href', `delete_${deleteModalSection}.php?${deleteModalSection}_id=${deleteModalId}`);
}

if (deleteLink) {
  deleteLink.addEventListener("click", showDeleteModal);
}