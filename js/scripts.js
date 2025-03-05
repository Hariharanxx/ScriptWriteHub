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
