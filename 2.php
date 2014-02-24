<?php 
	$name = "J.A.R.V.I.S";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Emulate (<?= $name ?>) | Black3v3r</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="2.css">
</head>
<body>
	<h1 class="center" id="headline">
	  <a href="http://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html">
		Web Speech API</a> Demonstration</h1>
	<div id="info">
	  <p id="info_start">Cliquez sur l'icone de microphone et commencez à parler.</p>
	  <p id="info_speak_now">Parlez maintenant.</p>
	  <p id="info_no_speech">Aucun con détecté. Vous devrez peut-être ajuster les
		<a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
		  paramètres du microphone</a>.</p>
	  <p id="info_no_microphone" style="display:none">
		Aucon microphone détecté. Assurez-vous qu'un microphone est installé et que les
		<a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
		paramètres du microphone</a> sont correctement configurés.</p>
	  <p id="info_allow">Cliquez sur le bouton "Autoriser" ci-dessus pour activer votre microphone.</p>
	  <p id="info_denied">La permission d'utiliser le microphone a été refusée.</p>
	  <p id="info_blocked">La permission d'utiliser le microphone est bloquée. Pour la modifier,
	   visitez chrome://settings/contentExceptions#media-stream</p>
	  <p id="info_upgrade">L'API Web Search n'est pas supportée par ce navigateur.
		 Installez <a href="//www.google.com/chrome">Chrome</a>
		 version 25 ou supérieure.</p>
	</div>
	<!-- <div class="right"> -->
	<div>
	  <button id="start_button" onclick="startButton(event)">
		<img id="start_img" src="mic.gif" alt="Start"></button>
	</div>
	<div id="results" hidden>
	  <span id="final_span" class="final"></span>
	  <span id="interim_span" class="interim"></span>
	  <p>
	</div>
	<!-- <input type="text" id="query" width="500px" placeholder="Que voulez vous que <?= $name ?> exécute ?" speech x-webkit-speech /> -->
	<div class="center">
		<!--   <div class="sidebyside" style="text-align:right">
		  <button id="copy_button" class="button" onclick="copyButton()">
			Copy and Paste</button>
		  <div id="copy_info" class="info">
			Press Control-C to copy text.<br>(Command-C on Mac.)
		  </div>
		</div> -->
		<!--   <div class="sidebyside">
		  <button id="email_button" class="button" onclick="emailButton()">
			Create Email</button>
		  <div id="email_info" class="info">
			Text sent to default email application.<br>
			(See chrome://settings/handlers to change.)
		  </div>
		</div> -->
	  <p>
	  <div id="div_language">
		<select id="select_language" onchange="updateCountry()"></select>
		&nbsp;&nbsp;
		<select id="select_dialect"></select>
	  </div>
	</div>





	<div class="container">
		<form class="form-signin" role="form" id="searchform">
			<h2 class="form-signin-heading">Envoyez vos demandes à <?= $name ?></h2>
			<!-- <input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus speech onspeechchange="request();"> -->
			<input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus x-webkit-speech onwebkitspeechchange="sendToSARAH(this.value);">
			<div class="btn-group btn-group-lg">
				<input type="submit" name="btn_send" id="btn_send" class="btn btn-primary" value="Envoyer">
				<input type="button" name="btn_cont" id="btn_cont" class="btn btn-danger" value="Dictée continue: Off" onclick="startButton(event)">
			</div>
			<label for="voc">Vocalisation du résultat:</label><input type="checkbox" id="voc" checked />
			<input type="button" value="Vocaliser" onclick="vocalise($('#answer').text())">
			<hr>
			<p id="url"></p>
			<p id="answer"></p>
		</form>
	</div>





	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="2.js"></script>
</body>
</html>