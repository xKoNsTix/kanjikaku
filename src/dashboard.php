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
    <?php
      if(!isset($_SESSION['userid'])) {
        echo '<h1 class="text-3xl font-bold text-brand-700 mb-10">You need to be logged in to view this page.</h1>
              <a href="login.php" class="bg-brand-500 hover:bg-brand-600 rounded-xl py-2 px-3 text-white font-medium">Go to login</a>
            </div>';
            require "footer.php";
        die();
    }
    ?>
    <div class="flex flex-col gap-6 lg:gap-12 lg:flex-row lg:justify-between">


      <div id="buttonContainer" class="flex flex-col w-full lg:w-1/6 min-w-[200px] space-y-3 shrink-0 grow-0">
        <button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300 active" id="grade-1" value="1">Grade 1</button>
        <button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="grade-2" value="2">Grade 2</button>
        <button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="grade-3" value="3">Grade 3</button>
        <button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="grade-4" value="4">Grade 4</button>
        <button class="btn py-3 px-5 font-medium text-sm bg-gray-50 text-gray-500 rounded-lg text-left border border-gray-200 hover:border-gray-300" id="grade-5">Grade 5</button>
      </div>
      

      <!-- Middle -->
      <div class="flex justify-center lg:justify-start">
        <div class="flex flex-col">
          <h1 class="text-3xl mb-2 font-bold">Choose your desired category<h1>
          <p class="font-medium tracking-wide mb-6 text-center lg:text-left">Press Generate to practice random kanji!</p>
          <div id="display-meaning" class="text-center text-brand-500 text-3xl font-bold mb-9 uppercase lg:text-left">Write the kanji</div>
          <div id="display-stroke-count" class="text-center uppercase text-sm font-bold text-brand-700 mb-2">Number of Strokes</div>
          <div class="flex flex-col lg:flex-row">
            <div class="space-y-4 grid place-items-center mb-4 lg:mb-0">
              <canvas id="canvas" width="298" height="298" class="bg-gray-50 border border-gray-200 rounded-lg lg:rounded-r-none"></canvas>
              <div>
                <button id="clear" class="bg-white hover:bg-gray-100 hover:border-gray-300 rounded-lg py-2 px-3 border border-gray-200 text-sm font-medium mr-4">Clear Canvas</button>
                <button id="next" class="bg-brand-500 hover:bg-brand-600 rounded-lg py-2 px-3 text-blue-100 text-sm font-medium">Generate Kanji</button>
              </div>
              <div>
                <button id="good">Good :)</button>
                <button id="bad">Good :(</button>
              </div>
            </div>
            <div class="space-y-4 grid place-items-center">
              <div class="w-[300px] h-[300px] rounded-lg lg:rounded-l-none bg-gray-50 border border-gray-200 lg:border-l-0 grid place-items-center text-8xl font-japanese">
                <div id="display-kanji" class="hidden"></div>
              </div>
              <button id="show-kanji" class="bg-gray-500 hover:bg-gray-600 border border-gray-500 hover:border-gray-600 rounded-lg py-2 px-3 text-gray-100 text-sm font-medium">Show Kanji</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Side -->
      <?php 
        require "customization.php";   
      ?>
      <div class="flex items-center">
        <iframe name="no-refresh" style="display:none"></iframe>
        <form action="customization.php" method="post" target="no-refresh" class="space-y-3">
          <label for="note" class="text-sm text-gray-700 font-semibold block">Add a note</label>
          <input type="text" id="note" name="note" class="border-gray-200 rounded-lg h-11 mt-1 focus:ring-0 focus:border-brand-500"></input>
          <input type="hidden" id="grab-kanji" name="grab-kanji" value=""></input>
          <label for="note" class="text-sm text-gray-700 font-semibold block">Add to list</label>
          <input type="text" id="list" name="list" class="border-gray-200 rounded-lg h-11 mt-1 focus:ring-0 focus:border-brand-500"></input>
          <div class="grid place-items-center">
            <input type="submit" id="save" name="save" value="Save Changes" class="bg-brand-500 hover:bg-brand-600 rounded-lg py-2 px-3 text-white text-sm font-medium cursor-pointer"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="locals"></div>

  </div>
  
  <?php require "footer.php" ?>

  <script src="../app.js"></script>
  <script src="../canvas.js"></script>
</body>
</html>