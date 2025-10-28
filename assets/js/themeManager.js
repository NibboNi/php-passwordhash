export function setTheme() {
  if (!localStorage.getItem("theme")) {
    const prefersDark = window.matchMedia(
      "(prefers-color-scheme: dark)"
    ).matches;

    if (prefersDark) {
      localStorage.setItem("theme", "dark");
    } else {
      localStorage.setItem("theme", "light");
    }
  }

  applyTheme();
}

export function applyTheme() {
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
  const theme = localStorage.getItem("theme");

  if ((theme === "system" && prefersDark) || theme === "dark") {
    document.documentElement.classList.add("dark");
  } else if (document.documentElement.classList.contains("dark")) {
    document.documentElement.classList.remove("dark");
  }
}

export function changeTheme(theme) {
  localStorage.setItem("theme", theme);

  applyTheme();
}
