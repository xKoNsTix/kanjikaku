<?php
    if (isset($_POST['good'] || isset($_POST['bad']))) {
        $rating = $_POST['good'];

        $stm = $dbh->prepare("INSERT INTO custom (rating) VALUES (?)");
			$stm->execute(
			array(
				$rating
				)
			);
    }