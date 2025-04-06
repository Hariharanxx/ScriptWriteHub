document.addEventListener("DOMContentLoaded", () => {
  const registerForm = document.getElementById("register-form");
  const loginForm = document.getElementById("login-form");

  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      const username = registerForm
        .querySelector("input[name='username']")
        .value.trim();
      const email = registerForm
        .querySelector("input[name='email']")
        .value.trim();
      const password = registerForm
        .querySelector("input[name='password']")
        .value.trim();

      if (username === "" || email === "" || password === "") {
        alert("All fields are required!");
        e.preventDefault();
      }
    });
  }

  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      const email = loginForm.querySelector("input[name='email']").value.trim();
      const password = loginForm
        .querySelector("input[name='password']")
        .value.trim();

      if (email === "" || password === "") {
        alert("All fields are required!");
        e.preventDefault();
      }
    });
  }
});
document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.querySelector(".menu-btn");
    const menuDropdown = document.querySelector(".menu-dropdown");

    menuBtn.addEventListener("click", (event) => {
        event.stopPropagation(); 
        menuDropdown.classList.toggle("active"); // Show/hide men
    });

    document.addEventListener("click", (event) => {
        if (!menuBtn.contains(event.target) && !menuDropdown.contains(event.target)) {
            menuDropdown.classList.remove("active"); // Hide menu when clicking outside
        }
    });
});
document.addEventListener("DOMContentLoaded", () => {
  const dropArea = document.getElementById("drop-area");
  const fileInput = document.getElementById("script-file");

  dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.style.background = "rgba(30, 144, 255, 0.2)";
  });

  dropArea.addEventListener("dragleave", () => {
    dropArea.style.background = "transparent";
  });

  dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    dropArea.style.background = "transparent";

    const files = event.dataTransfer.files;
    if (files.length > 0) {
      fileInput.files = files;
      alert(`File "${files[0].name}" selected!`);
    }
  });

  document.querySelector(".upload-btn").addEventListener("click", () => {
    fileInput.click();
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const filterButtons = document.querySelectorAll(".filter-btn");
  const storyCards = document.querySelectorAll(".story-card");

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const genre = button.getAttribute("data-genre");

      storyCards.forEach((card) => {
        if (genre === "all" || card.getAttribute("data-genre") === genre) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
});


