document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modal");
  const modalTitle = document.getElementById("modal-title");
  const modalBody = document.getElementById("modal-body");
  const closeBtn = document.querySelector(".close-btn");

  modal.style.display = "none";

  const bubbles = document.querySelectorAll(".berita-bubble");
  bubbles.forEach(bubble => {
    bubble.addEventListener("click", () => {
      const title = bubble.getAttribute("data-title");
      const body = bubble.getAttribute("data-body");
      openModal(title, body);
    });
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      closeModal();
    }
  });

  function openModal(title, body) {
    if (!title || !body) return;
    modalTitle.innerText = title;
    modalBody.innerText = body;
    modal.style.display = "flex";
  }

  function closeModal() {
    modal.style.display = "none";
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", closeModal);
  }
});