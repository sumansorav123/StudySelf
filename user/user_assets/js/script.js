// // Toggle between login and register forms
// document.querySelectorAll(".switch-to-register").forEach((link) => {
//   link.addEventListener("click", (e) => {
//     e.preventDefault();
//     document.querySelector(".login").classList.remove("active");
//     document.querySelector(".register").classList.add("active");
//   });
// });

// document.querySelectorAll(".switch-to-login").forEach((link) => {
//   link.addEventListener("click", (e) => {
//     e.preventDefault();
//     document.querySelector(".register").classList.remove("active");
//     document.querySelector(".login").classList.add("active");
//   });
// });

// Toggle password visibility
document.querySelectorAll(".toggle-password").forEach((icon) => {
  icon.addEventListener("click", function () {
    const passwordInput =
      this.closest(".form-group").querySelector(".password-input");
    const isVisible = passwordInput.type === "text";

    passwordInput.type = isVisible ? "password" : "text";
    this.classList.toggle("password-visible");
    this.closest(".form-group")
      .querySelectorAll(".toggle-password")
      .forEach((i) => {
        i.classList.toggle("password-visible");
      });
  });
});
