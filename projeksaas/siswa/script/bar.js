const toggleSidebar = document.getElementById("toggleSidebar");
const sidebar =
  document.querySelector(".sidebar") ||
  document.querySelector(".admin-sidebar");

if (toggleSidebar && sidebar) {
  toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}
