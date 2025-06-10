document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.getElementById("hamburgerBtn");
    const sidebar = document.getElementById("sidebar");

    hamburger.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const modalTitleInput = document.getElementById("modal-title");
    const modalBodyTextarea = document.getElementById("modal-body");
    const closeBtn = document.querySelector(".close-btn");
    const btnEdit = document.querySelector(".btn-edit");
    const btnDelete = document.querySelector(".btn-delete");

    let activeBubble = null;

    document.querySelectorAll(".berita-bubble").forEach(bubble => {
        bubble.addEventListener("click", () => {
            const title = bubble.getAttribute("data-title");
            const body = bubble.getAttribute("data-body");

            modal.style.display = "flex";
            modalTitleInput.value = title;
            modalBodyTextarea.value = body;
            activeBubble = bubble;
        });
    });

    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
        activeBubble = null;
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
            activeBubble = null;
        }
    });

    btnEdit.addEventListener("click", () => {
        if (!activeBubble) return;
        const newTitle = modalTitleInput.value;
        const newBody = modalBodyTextarea.value;

        activeBubble.querySelector(".berita-title").innerText = newTitle;
        activeBubble.querySelector("p").innerText = newBody;
        activeBubble.setAttribute("data-title", newTitle);
        activeBubble.setAttribute("data-body", newBody);

        modal.style.display = "none";
    });

    btnDelete.addEventListener("click", () => {
        if (activeBubble && confirm("Yakin ingin menghapus berita ini?")) {
            activeBubble.remove();
            modal.style.display = "none";
        }
    });
});