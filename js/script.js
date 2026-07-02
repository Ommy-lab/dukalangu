// =========================================================
// Duka Bora Inventory System — UI behaviour (vanilla JS only)
// =========================================================

document.addEventListener("DOMContentLoaded", function () {
  initSidebarToggle();
  initLiveClock();
  initProductSearch();
});

// ---------- Mobile sidebar toggle ----------
function initSidebarToggle() {
  var hamburger = document.getElementById("hamburgerBtn");
  var sidebar = document.getElementById("sidebar");
  var overlay = document.getElementById("sidebarOverlay");

  if (!hamburger || !sidebar || !overlay) return;

  function openSidebar() {
    sidebar.classList.add("open");
    overlay.classList.add("active");
  }

  function closeSidebar() {
    sidebar.classList.remove("open");
    overlay.classList.remove("active");
  }

  hamburger.addEventListener("click", function () {
    if (sidebar.classList.contains("open")) {
      closeSidebar();
    } else {
      openSidebar();
    }
  });

  overlay.addEventListener("click", closeSidebar);
}

// ---------- Live date / time in the topbar ----------
function initLiveClock() {
  var el = document.getElementById("liveDateTime");
  if (!el) return;

  function tick() {
    var now = new Date();
    var options = {
      weekday: "short",
      year: "numeric",
      month: "short",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit"
    };
    el.textContent = now.toLocaleString(undefined, options);
  }

  tick();
  setInterval(tick, 1000 * 30);
}

// ---------- Client-side search filter for the products table ----------
function initProductSearch() {
  var input = document.getElementById("productSearch");
  var table = document.getElementById("productsTable");
  if (!input || !table) return;

  input.addEventListener("input", function () {
    var query = input.value.trim().toLowerCase();
    var rows = table.querySelectorAll("tbody tr");

    rows.forEach(function (row) {
      var text = row.textContent.toLowerCase();
      row.style.display = text.indexOf(query) !== -1 ? "" : "none";
    });
  });
}

// ---------- Delete confirmation (used inline via onclick as a fallback) ----------
function confirmDelete(message) {
  return confirm(message || "Are you sure you want to delete this product?");
}
