<!-- This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com -->

<?php require "functions.php" ?>

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
	<nav class="flex items-center bg-gray-50 py-2 md:py-0 md:bg-transparent border-b border-gray-200 md:border-b-0">
		<div class="container flex flex-wrap items-center md:bg-gray-50 md:p-6 lg:my-6 md:rounded-b-2xl lg:rounded-t-2xl md:border-b md:border-x md:border-l-gray-200 lg:border-t">
			<a href="" class="text-2xl font-bold text-brand-500 mb-2 md:mb-0 md:mr-6 w-full md:w-auto">Kanji Kaku</a>
			<a href="register.php" class="font-medium text-gray-500 hover:text-gray-600">Sign Up</a>
		</div>
	</nav>

	<div class="container mx-auto flex-1 flex flex-col">
		<div class="flex-1 flex flex-col">
			<div class="grid grid-cols-2 flex-1 gap-24">
				<div class="col-span-2 lg:col-span-1 grid place-items-center">
					<div class="w-full">
						<h1 class="text-3xl font-bold text-brand-500 mb-3">Welcome back!</h1>
						<h2 class="mb-10">The kanji missed you already.</h2>
						<p class="mb-5">Not a member yet? <a href="register.php" class="text-brand-400">Sign up</a></p>
						<form method="POST" action="" class="grid gap-6">
							<div>
							<label for="username" class="text-sm text-gray-700 font-semibold">Username</label><br>
							<input type="text" id="username" name="username" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required><br>
							</div>
							<div>
							<label for="pwd" class="text-sm text-gray-700 font-semibold">Password</label><br>
							<input type="password" id="pwd" name="pwd" class="border-gray-200 rounded-lg h-11 mt-1 w-full focus:ring-0 focus:border-brand-500" required><br>
							</div>
							<input type="submit" name="submit" value="Login" class="bg-brand-500 hover:bg-brand-600 cursor-pointer text-white text-lg font-semibold rounded-lg h-12 w-full">
						</form>
					</div>
				</div>
				<div class="hidden lg:block col-span-1 mb-12 rounded-2xl bg-login-illustration bg-cover bg-no-repeat"></div>
			</div>
		</div>
	</div>

	<?php

		if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['pwd'])) {

			$error = NULL;

			$username = $_POST['username'];
	  		$password = $_POST['pwd'];

			// vlt in der variable schon das gehashte passwort speichern

			$sth = $dbh->prepare("SELECT * FROM users WHERE username=?");
			$sth->execute(array($username));
			$user = $sth->fetch();

			if ($user && password_verify($password, $user->password) && $user->verified == true) {
				echo "login erfolgreich!";
				$_SESSION['userid'] = $user->id;
				header("Location: dashboard.php");
				return true;
			} else {
				echo "This account either hasn't been verified or the username/password is wrong. If you have created an account, please make sure to verify it via the verification email we have sent you.";
				return false;
			}
			
		}	
	?>
	<?php require "footer.php" ?>
</body>
</html>