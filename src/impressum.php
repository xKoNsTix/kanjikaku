<!-- This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com -->

<?php session_start(); 
  
  if(isset($_SESSION['userid'])) {
    $loginState = "Logout";
		$loginBtnLink = "logout";
    $logoLink = "dashboard.php";
  } else {
    $loginState = "Login";
		$loginBtnLink = "login";
    $logoLink = "index.php";
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
<body class="h-screen flex flex-col">
 
  <nav class="flex items-center bg-gray-50 py-2 md:py-0 md:bg-transparent border-b border-gray-200 md:border-b-0">
      <div class="container flex flex-wrap items-center md:bg-gray-50 md:p-6 lg:my-6 md:rounded-b-2xl lg:rounded-t-2xl md:border-b md:border-x md:border-l-gray-200 lg:border-t">
        <a href="<?php echo $logoLink ?>" class="text-2xl font-bold text-brand-500 mb-2 md:mb-0 md:mr-6 w-full md:w-auto">Kanji Kaku</a>
      <?php echo '<a href="' . $loginBtnLink . '.php" font-medium text-gray-500 hover:text-gray-600">' . $loginState . '</a>' ?>
    </div>
  </nav>

  <div class="container mx-auto flex-1 flex flex-col">
    <h1 class="text-3xl font-bold text-brand-500 mb-3">Impressum</h1>
    <h2 class="text-lg font-medium mb-5">This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.</h2>
    <p class="text-medium"><strong>Author:</strong> Jennifer Scharinger</p>
    <p class="text-medium"><strong>Contact:</strong> jennyxscharinger@gmail.com</p>
    <p><strong>Illustration:</strong> <a href="https://www.freepik.com/vectors/japan-illustration">by pikisuperstar - www.freepik.com</a></p>
  </div>
  <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 330" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(150.588, 20.883, 20.883, 1)" offset="0%"></stop><stop stop-color="rgba(255, 162.052, 162.052, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,132L40,115.5C80,99,160,66,240,82.5C320,99,400,165,480,165C560,165,640,99,720,99C800,99,880,165,960,209C1040,253,1120,275,1200,236.5C1280,198,1360,99,1440,49.5C1520,0,1600,0,1680,27.5C1760,55,1840,110,1920,154C2000,198,2080,231,2160,236.5C2240,242,2320,220,2400,181.5C2480,143,2560,88,2640,104.5C2720,121,2800,209,2880,247.5C2960,286,3040,275,3120,258.5C3200,242,3280,220,3360,192.5C3440,165,3520,132,3600,143C3680,154,3760,209,3840,225.5C3920,242,4000,220,4080,209C4160,198,4240,198,4320,209C4400,220,4480,242,4560,258.5C4640,275,4720,286,4800,242C4880,198,4960,99,5040,60.5C5120,22,5200,44,5280,44C5360,44,5440,22,5520,16.5C5600,11,5680,22,5720,27.5L5760,33L5760,330L5720,330C5680,330,5600,330,5520,330C5440,330,5360,330,5280,330C5200,330,5120,330,5040,330C4960,330,4880,330,4800,330C4720,330,4640,330,4560,330C4480,330,4400,330,4320,330C4240,330,4160,330,4080,330C4000,330,3920,330,3840,330C3760,330,3680,330,3600,330C3520,330,3440,330,3360,330C3280,330,3200,330,3120,330C3040,330,2960,330,2880,330C2800,330,2720,330,2640,330C2560,330,2480,330,2400,330C2320,330,2240,330,2160,330C2080,330,2000,330,1920,330C1840,330,1760,330,1680,330C1600,330,1520,330,1440,330C1360,330,1280,330,1200,330C1120,330,1040,330,960,330C880,330,800,330,720,330C640,330,560,330,480,330C400,330,320,330,240,330C160,330,80,330,40,330L0,330Z"></path></svg>
  <?php require "footer.php" ?>
</body>
</html>