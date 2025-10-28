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
  <link rel="stylesheet" href="assets/css/main.css">
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

  <script type="module" src="assets/js/app.js"></script>

</body>

</html>