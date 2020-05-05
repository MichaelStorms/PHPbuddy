<?php
include_once("init.php");
include_once("loginCheck.inc.php");
include_once(__DIR__ . "/classes/Filter.php");
$filter = new Filter();
if (!empty($_GET)) {
	$search = $_GET["search"];
	if (!empty($search)) {
		$searchResult = $filter->searchPerson($search);
	}
}

?>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PhpBuddy</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!-- jQuery -->
</head>

<body>
	<style>
		.modal-dialog {
			width: 400px;
			margin: 30px auto;
		}
	</style>
	<header>
		<div class="navbar navbar-dark bg-dark box-shadow">
			<div class="container d-flex justify-content-between">
				<?php include_once("nav.inc.php"); ?>
			</div>
		</div>
	</header>
	<div class="container">
		<h1>Chat system</h1>
		<br>
		<div class="chat">
			<div id="frame">
				<div id="sidepanel">
					<div id="profile">
						<?php

						$loggedUser = $chat->getUserDetails($_SESSION['id']);
						echo '<div class="wrap">';
						$currentSession = '';
						foreach ($loggedUser as $user) {
							$currentSession = $user['current_session'];
							echo '<img id="profile-img" src="images/' . $user['image'] . '" class="online" alt="" />';
							echo  '<p>' . $user['firstname'] . " " . $user['lastname'] . '</p>';
							echo '<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>';
							echo '<div id="status-options">';
							echo '<ul>';
							echo '<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>';
							echo '<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>';
							echo '<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>';
							echo '<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>';
							echo '</ul>';
							echo '</div>';
							echo '<div id="expanded">';
							echo '<a href="logout.php">Logout</a>';
							echo '</div>';
						}
						echo '</div>';
						?>
					</div>
					<form action="" method="GET">
						<div id="search">
							<label for="search"><i class="fa fa-search" aria-hidden="true"></i></label>
							<input name="search" type="text" placeholder="Search contacts..." />
						</div>
					</form>
					<div id="contacts">
						<?php
						echo '<ul>';
						if (empty($search)) {
							$chatUsers = $chat->chatUsers($_SESSION['id']);
							foreach ($chatUsers as $user) {
								$status = 'offline';
								if ($user['online']) {
									$status = 'online';
								}
								$activeUser = '';
								if ($user['id'] == $currentSession) {
									$activeUser = "active";
								}
								echo '<li id="' . $user['id'] . '" class="contact ' . $activeUser . '" data-touserid="' . $user['id'] . '" data-tousername="' . $user['firstname'] . " " . $user['lastname'] . '">';
								echo '<div class="wrap">';
								echo '<span id="status_' . $user['id'] . '" class="contact-status ' . $status . '"></span>';
								echo '<img src="images/' . $user['image'] . '" alt="" />';
								echo '<div class="meta">';
								echo '<p class="name">' . $user['firstname'] . " " . $user['lastname'] . '<span id="unread_' . $user['id'] . '" class="unread">' . $chat->getUnreadMessageCount($user['id'], $_SESSION['id']) . '</span></p>';
								echo '<p class="preview"><span id="isTyping_' . $user['id'] . '" class="isTyping"></span></p>';
								echo '</div>';
								echo '</div>';
								echo '</li>';
							}
							echo '</ul>';
						} else {
							foreach ($searchResult as $user) {
								$status = 'offline';
								if ($user['online']) {
									$status = 'online';
								}
								$activeUser = '';
								if ($user['id'] == $currentSession) {
									$activeUser = "active";
								}
								echo '<li id="' . $user['id'] . '" class="contact ' . $activeUser . '" data-touserid="' . $user['id'] . '" data-tousername="' . $user['firstname'] . " " . $user['lastname'] . '">';
								echo '<div class="wrap">';
								echo '<span id="status_' . $user['id'] . '" class="contact-status ' . $status . '"></span>';
								echo '<img src="images/' . $user['image'] . '" alt="" />';
								echo '<div class="meta">';
								echo '<p class="name">' . $user['firstname'] . " " . $user['lastname'] . '<span id="unread_' . $user['id'] . '" class="unread">' . $chat->getUnreadMessageCount($user['id'], $_SESSION['id']) . '</span></p>';
								echo '<p class="preview"><span id="isTyping_' . $user['id'] . '" class="isTyping"></span></p>';
								echo '</div>';
								echo '</div>';
								echo '</li>';
							}
							echo '</ul>';
						}
						?>
					</div>
					<div id="bottom-bar">
						<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
						<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
					</div>
				</div>
				<div class="content" id="content">
					<div class="contact-profile" id="userSection">
						<?php
						$userDetails = $chat->getUserDetails($currentSession);
						foreach ($userDetails as $user) {
							echo '<img src="images/' . $user['image'] . '" alt="" />';
							echo '<p>' . $user['firstname'] . " " . $user['lastname'] . '</p>';
							echo '<div class="social-media">';
							echo '<i class="fa fa-facebook" aria-hidden="true"></i>';
							echo '<i class="fa fa-twitter" aria-hidden="true"></i>';
							echo '<i class="fa fa-instagram" aria-hidden="true"></i>';
							echo '</div>';
						}
						?>
					</div>
					<div class="messages" id="conversation">
						<?php
						echo $chat->getUserChat($_SESSION['id'], $currentSession);
						?>
					</div>
					<div class="message-input" id="replySection">
						<div class="message-input" id="replyContainer">
							<div class="wrap">
								<input name="chatMessage" type="text" class="chatMessage" id="chatMessage<?php echo $currentSession; ?>" placeholder="Write your message..." />
								<button class="submit chatButton" id="chatButton<?php echo $currentSession; ?>" value="send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<br>

	</div>
	<script src="chat.js"></script>

	<!-- begin footer -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>

</html>

<!-- einde footer -->