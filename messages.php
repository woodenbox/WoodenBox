<?php

session_start();

$welcome = "Welcome,<b> ".$_SESSION['username']."!</b><br /><a href='messages.php?id=compose'>Compose</a> | <a href='messages.php?id=inbox'>Inbox</a> | <a href='messages.php?id=outbox'>Outbox</a> | <a href='logout.php'>Logout</a><br />";

?>

<?php print $welcome; ?>


<?php

	$pages_dir = 'msg';
	
	if(!empty($_GET['id'])) {
		$pages = scandir($pages_dir, 0);
		unset($pages[0], $pages[1]);
		
	$id = $_GET['id'];
	
	if(in_array($id.'.inc.php', $pages)) {
		include($pages_dir.'/'.$id.'.inc.php');
	} else {
		echo "PAGE NOT FOUND!";
	}
	} else {
		include($pages_dir.'/inbox.inc.php');
	}
	
	?>
	
