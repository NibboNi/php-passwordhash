<?php

$hashed = null;
$inputError = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $password = cleanValue($_POST["password"]);

  if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $password = "";
  } else {
    $inputError = "No password was given";
  }
}

function cleanValue($value)
{
  return htmlspecialchars(trim($value));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP - Hasher</title>
  <link rel="shortcut icon" href="icon.svg" type="image/svg+xml">
  <style>
    :root {
      --color: #000;
      --bg: #fff;
    }

    .dark {
      --color: #fff;
      --bg: #0c0c0d;
    }

    html {
      box-sizing: border-box;
      font-size: 62.5%;
      scroll-behavior: smooth;
    }

    *,
    *:before,
    *:after {
      margin: 0;
      box-sizing: inherit;
    }

    body {
      height: 100dvh;
      width: 100vw;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 5rem;
      font-size: 1.6rem;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      /* Improve text rendering */
      -webkit-font-smoothing: antialiased;
      color: var(--color);
      background-color: var(--bg);
    }

    /* Improve media defaults */
    img,
    picture,
    video,
    canvas,
    svg {
      display: block;
      max-width: 100%;
    }

    /* Inherit fonts for form controls */
    input,
    button,
    textarea,
    select {
      font: inherit;
    }

    h1 {
      text-align: center;
      text-transform: capitalize;
      font-size: 4.8rem;
      font-weight: 300;
    }

    form {
      width: 95%;
      max-width: 90rem;
      display: flex;
      justify-content: center;

      fieldset {
        padding: 0;
        display: flex;
        flex-direction: column;
        position: relative;
        border: none;

        label {
          position: absolute;
          top: -2rem;
          left: 1rem;
          color: inherit;
          font-style: normal;
          transition: top 0.3s ease-in-out, left 0.3s ease-in-out;
          transform: translateY(-50%);
        }

        input {
          padding: 1rem 2rem;
          border: 1px solid lightgray;
          border-radius: 100rem 0rem 0rem 100rem;

          &:placeholder-shown {
            +label {
              top: 50%;
              left: 2.4rem;
              color: gray;
              font-style: italic;
              transform: translateY(-50%);
            }
          }

          &:focus {
            border: 1px solid black;
            outline: none;

            +label {
              top: -2rem;
              left: 1rem;
              color: inherit;
              font-style: normal;
              transform: translateY(-50%);
            }
          }
        }

        p {
          position: absolute;
          top: calc(100% + 0.6rem);
          left: 0;
          color: red;
          transition: top 0.3s ease-in-out;
          animation: slideIn 1s ease-in-out forwards;
        }

      }

      button {
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        color: white;
        background-color: rgba(0, 0, 0, 0.8);
        border: none;
        border-radius: 0rem 100rem 100rem 0rem;

        &:hover {
          background-color: rgba(0, 0, 0, 1);
        }

        &:focus {
          outline: none;
          background-color: rgba(0, 0, 0, 1);
        }

        span {
          font-size: 1.8rem;
          font-weight: 600;
        }

        svg {
          width: 1.8rem;
          aspect-ratio: 1;
          fill: white;
        }
      }
    }

    .dark form {
      fieldset {
        input {
          background-color: inherit;
          color: white;
          border: 1px solid rgba(255, 255, 255, 0.1);
          border-right: none;

          &:focus {
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-right: none;
          }
        }
      }

      button {
        background-color: rgba(255, 255, 255, 0.15);

        &:focus,
        &:hover {
          background-color: rgba(255, 255, 255, 0.1);
        }
      }
    }

    @keyframes slideIn {
      from {
        top: 100%;
        opacity: 0;
      }

      to {
        top: calc(100% + 1rem);
        opacity: 1;
      }
    }

    section {
      padding: 0rem 2rem;
      width: 100%;
      max-width: 90rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 1rem;

      h2 {
        font-size: 3.2rem;
        font-weight: 300;
      }

      div {
        width: 100%;
        position: relative;
        overflow-wrap: anywhere;

        p {
          margin: 0 auto;
          padding: 1rem 2rem;
          width: 100%;
          max-width: 60rem;
          text-align: center;
          background-color: rgba(211, 211, 211, 0.2);
          border: 1px solid rgba(211, 211, 211, 1);
          border-radius: 1rem;

          &:hover {
            background-color: rgba(211, 211, 211, 0.4);
            border: 1px solid rgba(211, 211, 211, 0.2);
            cursor: default;
          }
        }

        button {
          padding: 0.6rem;
          width: 3.2rem;
          aspect-ratio: 1;
          position: absolute;
          top: -4.4rem;
          left: calc(50% + 6rem);
          background-color: rgba(211, 211, 211, 0.2);
          border: 1px solid rgba(211, 211, 211, 1);
          border-radius: 0.8rem;

          &:hover,
          &:focus {
            background-color: rgba(211, 211, 211, 0.4);
            border: 1px solid rgba(211, 211, 211, 0.2);
            cursor: default;
          }

          &:focus {
            outline: none;
          }
        }
      }
    }

    .dark section {
      div {
        p {
          background-color: rgba(211, 211, 211, 0.1);
          border: none;

          &:hover {
            background-color: rgba(211, 211, 211, 0.15);
          }
        }

        button {
          border: none;
          background-color: rgba(211, 211, 211, 0.1);

          &:hover {
            background-color: rgba(211, 211, 211, 0.15);
          }

          svg {
            fill: white;
          }
        }
      }
    }

    .toast {
      padding: 0.4rem 0.8rem;
      width: fit-content;
      position: absolute;
      top: calc(100% + 0.6rem);
      left: 50%;
      font-size: 1.4rem;
      font-weight: 500;
      color: #1e611e;
      background-color: #9de09d;
      border: none;
      border-radius: 0.8rem;
      transform: translateX(-50%);
      animation: fadeIn 3s ease-in-out forwards;

      &:hover {
        color: #1e611e;
        background-color: #9de09d;
        border: none;
      }
    }

    .dark .toast {
      color: #9de09d;
      background-color: #1e611e;
      border: none;

      &:hover {
        color: #9de09d;
        background-color: #1e611e;
        border: none;
      }
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }

      10%,
      90% {
        opacity: 1;
      }

      100% {
        opacity: 0;
      }
    }

    footer {
      padding: 1rem 4rem;
      width: 90%;
      max-width: 40rem;
      position: fixed;
      bottom: 2rem;
      left: 50%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 4rem;
      border-radius: 100rem;
      border: 1px solid rgba(0, 0, 0, 0.12);
      transform: translateX(-50%);

      h2 {
        font-size: 1.4rem;
        font-weight: 300;
        color: inherit;

        &:hover {
          text-decoration: underline;
        }

        a {
          color: inherit;
          text-decoration: none;
        }
      }

      div {
        display: flex;
        gap: 0.6rem;

        button {
          padding: 0.4rem;
          width: 2.8rem;
          aspect-ratio: 1;
          background-color: inherit;
          border: 1px solid rgba(0, 0, 0, 0.12);
          border-radius: 0.8rem;

          &.active {
            background-color: rgba(0, 0, 0, 0.12);
          }

          &:hover {
            background-color: rgba(211, 211, 211, 0.6);
            border: 1px solid transparent;
          }
        }
      }
    }

    .dark {
      footer {
        border: 1px solid rgba(255, 255, 255, 0.12);

        div {
          button {
            border: 1px solid rgba(255, 255, 255, 0.12);

            &.active {
              background-color: rgba(255, 255, 255, 0.2);
            }

            svg {
              fill: white;
            }
          }
        }
      }
    }
  </style>
</head>

<body>

  <header>
    <h1>PHP password hasher</h1>
  </header>

  <form action="/" method="post">
    <fieldset>
      <input type="password" name="password" id="password" placeholder="" required>
      <label for="password">Password</label>
      <?php if (isset($inputError)): ?>
        <p><?= $inputError; ?></p>
      <?php endif; ?>
    </fieldset>
    <button type="submit">
      <span>Hash</span>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <title>Hash password</title>
        <path d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
      </svg>
    </button>
  </form>

  <?php if (isset($hashed)): ?>
    <section>
      <h2>Hashed</h2>
      <div>
        <p id="hashed"><?= htmlspecialchars($hashed); ?></p>
        <button id="copyBtn" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <title>Copy hash</title>
            <path d="M19,21H8V7H19M19,5H8A2,2 0 0,0 6,7V21A2,2 0 0,0 8,23H19A2,2 0 0,0 21,21V7A2,2 0 0,0 19,5M16,1H4A2,2 0 0,0 2,3V17H4V3H16V1Z" />
          </svg>
        </button>
      </div>
    </section>
  <?php endif; ?>

  <footer>
    <h2>
      <a href="https://github.com/NibboNi/php-passwordhash">Repo</a>
    </h2>

    <div>
      <button type="button" data-theme="light" aria-label="Enable light mode">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <title>Enable light mode</title>
          <path d="M3.55 19.09L4.96 20.5L6.76 18.71L5.34 17.29M12 6C8.69 6 6 8.69 6 12S8.69 18 12 18 18 15.31 18 12C18 8.68 15.31 6 12 6M20 13H23V11H20M17.24 18.71L19.04 20.5L20.45 19.09L18.66 17.29M20.45 5L19.04 3.6L17.24 5.39L18.66 6.81M13 1H11V4H13M6.76 5.39L4.96 3.6L3.55 5L5.34 6.81L6.76 5.39M1 13H4V11H1M13 20H11V23H13" />
        </svg>
      </button>
      <button type="button" data-theme="dark" aria-label="Enable dark mode">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <title>Enable dark mode</title>
          <path d="M12 2A9.91 9.91 0 0 0 9 2.46A10 10 0 0 1 9 21.54A10 10 0 1 0 12 2Z" />
        </svg>
      </button>
      <button type="button" data-theme="system" aria-label="Enable system mode">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <title>Enable system mode</title>
          <path d="M21,16H3V4H21M21,2H3C1.89,2 1,2.89 1,4V16A2,2 0 0,0 3,18H10V20H8V22H16V20H14V18H21A2,2 0 0,0 23,16V4C23,2.89 22.1,2 21,2Z" />
        </svg>
      </button>
    </div>
  </footer>

  <script>
    const themeBtns = document.querySelectorAll("[data-theme]");

    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => applyTheme());

    setTheme();

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
      })
    });

    const hashed = document.querySelector("#hashed");
    const copyBtn = document.querySelector("#copyBtn");

    if (hashed && copyBtn) {
      copyBtn.addEventListener("click", () => copyToClipboard(hashed.textContent))
      hashed.addEventListener("click", () => copyToClipboard(hashed.textContent))
    }

    function setTheme() {
      if (!localStorage.getItem("theme")) {
        const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

        if (prefersDark) {
          localStorage.setItem("theme", "dark");
        } else {
          localStorage.setItem("theme", "light");
        }
      }

      applyTheme();

    }

    function applyTheme() {
      const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
      const theme = localStorage.getItem("theme");

      if ((theme === "system" && prefersDark) || theme === "dark") {
        document.documentElement.classList.add("dark")
      } else if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark")
      }
    }

    function changeTheme(theme) {
      localStorage.setItem("theme", theme);

      applyTheme();
    }

    async function copyToClipboard(text) {
      const type = "text/plain";
      const clipboardItemData = {
        [type]: text,
      };

      const clipboardItem = new ClipboardItem(clipboardItemData);
      await navigator.clipboard.write([clipboardItem]);

      createToast(document.querySelector("#hashed"));
    }

    function createToast(parentContainer) {
      if (document.querySelector(".toast")) return;

      const toast = document.createElement("P");

      toast.classList.add("toast");
      toast.textContent = "Copied to clipboard!";

      parentContainer.appendChild(toast);

      setTimeout(() => {
        toast.remove();
      }, 3000);
    }
  </script>

</body>

</html>