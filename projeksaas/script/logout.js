const logoutBtn = document.getElementById("logoutBtn");
const logoutModal = document.getElementById("logoutModal");
const cancelBtn = document.getElementById("cancelLogout");

logoutBtn.addEventListener("click", function (e) {
  e.preventDefault();
  logoutModal.classList.remove("hidden");
});

cancelBtn.addEventListener("click", function () {
  logoutModal.classList.add("hidden");
});
