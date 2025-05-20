document.getElementById("searchInput").addEventListener("input", function () {
  const search = this.value.toLowerCase();
  const apps = document.querySelectorAll(".app-card");
  apps.forEach(app => {
    const title = app.querySelector("h3").textContent.toLowerCase();
    app.style.display = title.includes(search) ? "block" : "none";
  });
});