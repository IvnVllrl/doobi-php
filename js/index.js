const terminalButton = () => {
  window.location.href = "terminal.php";
};

const navLinks = document.querySelectorAll("nav ul li a");

navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.forEach((link) => link.classList.remove("active"));

    this.classList.add("active");
  });
});
