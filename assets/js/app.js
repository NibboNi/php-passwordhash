import { copyToClipboard } from "./copyToClipboard.js";
import { setTheme, changeTheme, applyTheme } from "./themeManager.js";

document.addEventListener("DOMContentLoaded", () => {
  const hashed = document.querySelector("#hashed");
  const copyBtn = document.querySelector("#copyBtn");
  const themeBtns = document.querySelectorAll("[data-theme]");

  window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", () => applyTheme());

  setTheme();

  if (hashed && copyBtn) {
    copyBtn.addEventListener("click", () =>
      copyToClipboard(hashed.textContent)
    );
    hashed.addEventListener("click", () => copyToClipboard(hashed.textContent));
  }

  if (themeBtns) {
    themeBtns.forEach(btn => {
      if (localStorage.getItem("theme") === btn.dataset.theme) {
        btn.classList.add("active");
      }

      btn.addEventListener("click", () => {
        themeBtns.forEach(btn => btn.classList.remove("active"));

        if (localStorage.getItem("theme") !== btn.dataset.theme) {
          changeTheme(btn.dataset.theme);
        }

        btn.classList.add("active");
      });
    });
  }
});
