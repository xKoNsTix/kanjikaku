<!-- This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com -->

<?php
  require "../config.php";
 // if ( ! $DB_NAME ) die ('please create config.php, define $DB_NAME, $DSN, $DB_USER, $DB_PASS there. See config_sample.php');

  try {
      $dbh = new PDO($dsn, $params["user"], $params["password"], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
      $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  } catch (Exception $e) {
      die ("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
  }
?>

<?php

      function generateKey($username) {
        $key = md5(time().$username);
        return $key;
      }

      function emailVerification($email, $vkey) {
        $to = $email;

        $subject = "Verify your email address";
        $message =  <<< end
                    Thank you for signing up!</br>
                    Please click on the following link to verify your account.</br>
                    <a href='https://users.multimediatechnology.at/~fhs47772/mmp1/src/verify.php?vkey=$vkey'>Verify your Account</a>
                    end;
        $headers = "From: jennyxscharinger@gmail.com" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        mail($to, $subject, $message, $headers);

        header('location: thankyou.php');
      }

      if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pwd'])) {

        $feedback = NULL;
        $issue = false;

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd2'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (strlen($username) < 3 || strlen($username) > 12) {
          $feedback = "Your username must be ast least between 3 and 12 characters long.";
          $issue = true;
        }

        if (strlen($password) < 8) {
          $feedback = "Your password must be at least 8 characters long.";
          $issue = true;
        }

        if ($password != $password2) {
          $feedback = "Passwords do not match.";
          $issue = true;
        }

        if (!$issue) {
          $sth = $dbh->prepare("SELECT * FROM users WHERE username=?");
          $sth->execute(array($username));
          $user = $sth->fetch();

          if ($user) {
            $feedback = "That username has already been taken";
            $issue = true;
          }
        }

        if (!$issue) {

          $vkey = generateKey($username);
          //echo $vkey;

          $sth = $dbh->prepare("INSERT INTO users (username, password, email, vkey) VALUES (?, ?, ?, ?)");
          $sth->execute(
          array(
            $username,
            $hash,
            $email,
            $vkey
            )
          );

          emailVerification($email, $vkey);
        }

      }
    ?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
  <link href="../assets/style.css" rel="stylesheet">
</head>
<body>
  <div class ="container mx-auto flex-1 flex flex-col">
    <nav class="flex items-center bg-gray-50 py-2 md:py-0 md:bg-transparent border-b border-gray-200 md:border-b-0">
      <div class="container flex flex-wrap items-center md:bg-gray-50 md:p-6 lg:my-6 md:rounded-b-2xl lg:rounded-t-2xl md:border-b md:border-x md:border-l-gray-200 lg:border-t">
        <a href="index.php" class="text-2xl font-bold text-brand-500 mb-2 md:mb-0 md:mr-6 w-full md:w-auto">Kanji Kaku</a>
        <a href="login.php" class="font-medium text-gray-500 hover:text-gray-600">Login</a>
      </div>
    </nav>

      <!-- FLEX CONTAINER -->
    <div class="flex-1 flex flex-col">
      <div class="grid grid-cols-2 flex-1 gap-24">
        <div class="col-span-2 lg:col-span-1 grid place-items-center">
        <div class="w-full">
            <h1 class="text-3xl font-bold text-brand-500 mb-3">Create an account</h1>
            <h2 class="mb-10">Start practicing right away.</h2>
            <p class="mb-9">Already a Member? <a href="login.php" class="text-brand-400">Log in</a></p>
            <p class="mb-5 text-blue-500 font-semibold"><?php echo $feedback ?></p>
            <form method="POST" action="" class="grid grid-cols-2 gap-6">
              <div class="col-span-2 md:col-span-1">
                <label for="username" class="text-sm text-gray-700 font-semibold">Username</label><br>
                <input type="text" id="username" name="username" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required>
              </div>
              <div class="col-span-2 md:col-span-1">
                <label for="email" class="text-sm text-gray-700 font-semibold">Email</label><br>
                <input type="email" id="email" name="email" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required>
              </div>
              <div class="col-span-2 md:col-span-1">
                <label for="pwd" class="text-sm text-gray-700 font-semibold">Password</label><br>
                <input type="password" id="pwd" name="pwd" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required>
              </div>
              <div class="col-span-2 md:col-span-1">
                <label for="pwd2" class="text-sm text-gray-700 font-semibold">Repeat Password</label><br>
                <input type="password" id="pwd2" name="pwd2" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required><br>
              </div>
              <input type="submit" name="submit" value="Create Account" class="bg-brand-500 hover:bg-brand-600 cursor-pointer text-white text-lg font-semibold rounded-lg h-12 col-span-2"></input>
            </form>

          </div>
        </div>
      <div class="col-span-1 hidden lg:block mb-12 rounded-2xl bg-login-illustration bg-cover bg-no-repeat"></div>
    </div>
  </div>
  </div>

  <?php require "footer.php"?>
</body>
</html>
