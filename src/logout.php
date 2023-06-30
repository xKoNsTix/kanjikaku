<!-- This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com -->

<?php

    include "functions.php";

   if (isset($_COOKIE[session_name()])) {
    setcookie(
      session_name(),
      '',
      time()-42000,
      '/',           
     );
    }

  session_destroy();
  header("Location: index.php");
?>