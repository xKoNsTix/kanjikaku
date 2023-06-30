<!-- This website was created as MultiMediaProject 1 for MultiMediaTechnology at the Salzburg University of Applied Sciences.
Author: Jennifer Scharinger
Illustration: by pikisuperstar - www.freepik.com -->

<?php
	require "functions.php";
    // Wenn man auf save button drückt, wird user, kanji und notiz gespeichert
	if (isset($_POST['save']) && isset($_POST['grab-kanji']) && strlen($_POST['grab-kanji']) > 0) {
		echo "custom";
		$userid = $_SESSION['userid'];
		$kanji = $_POST['grab-kanji'];
		$note = $_POST['note'];
		$list = $_POST['list'];

		echo $userid;
		echo $kanji;
		echo $note;
		// suchen, ob Kombination aus Userid und Kanji schon existiert
		$sth = $dbh->prepare("SELECT * FROM custom WHERE userid=? AND kanji=?");
		$sth->execute(array($userid, $kanji));
		$entry = $sth->fetch();

		print_r($entry);

		//Wenn nicht, neuen Eintrag anlegen
		if (!$entry) {
			$stm = $dbh->prepare("INSERT INTO custom (userid, kanji, list_name, note) VALUES (?, ?, ?, ?)");
			$stm->execute(
			array(
				$userid,
				$kanji,
				$list,
				$note
				)
			);
		} else {
			$stm = $dbh->prepare("UPDATE custom SET list_name=?, note=? WHERE userid=? AND kanji=?");
			$stm->execute(
			array(
				$list,
				$note,
				$userid,
				$kanji
				)
			);
		}
	}

?>