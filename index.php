<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $password = cleanValue($_POST["password"]);

  if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
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
  <title>PHP Hasher</title>
  <link rel="shortcut icon" href="icon.svg" type="image/svg+xml">
  <style>
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
          color: black;
          font-style: normal;
          transition: top 0.3s ease-in-out, left 0.3s ease-in-out;
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
              color: black;
              font-style: normal;
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

  <script>
    const hashed = document.querySelector("#hashed");
    const copyBtn = document.querySelector("#copyBtn");

    if (hashed && copyBtn) {
      copyBtn.addEventListener("click", () => copyToClipboard(hashed.textContent))
      hashed.addEventListener("click", () => copyToClipboard(hashed.textContent))
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