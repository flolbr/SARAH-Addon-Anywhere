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
	   visitez <a href="chrome://settings/contentExceptions#media-stream">chrome://settings/contentExceptions#media-stream</a></p>
	  <p id="info_upgrade">L'API Web Search n'est pas supportée par ce navigateur.
		 Installez <a href="//www.google.com/chrome">Chrome</a>
		 version 32 ou supérieure.</p>
	</div>
	
	<div id="results" hidden>
	  <span id="final_span" class="final"></span>
	  <span id="interim_span" class="interim"></span>
	  <p>
	</div>
	<div class="center">
	  <div id="div_language">
		<select id="select_language" onchange="updateCountry()"></select>
		&nbsp;&nbsp;
		<select id="select_dialect"></select>
	  </div>
	</div>

	<div class="container">
		<form class="form-signin" role="form" id="searchform">
			<h2 class="form-signin-heading">Envoyez vos commandes à <?= $name ?></h2>
			<div class="input-group">
				<span class="input-group-addon" onclick="$('#query').val('');"><span class="glyphicon glyphicon-remove"></span></span>
				<input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus x-webkit-speech onwebkitspeechchange="sendToSARAH(this.value);">
			</div>
			<div class="btn-group btn-group-lg">
				<input type="submit" name="btn_send" id="btn_send" class="btn btn-primary" value="Envoyer">                
				<input type="button" name="btn_cont" id="btn_cont" class="btn btn-danger" value="Dictée continue: Off" onclick="startButton(event)">
			    <button id="start_button" onclick="startButton(event)"><img id="start_img" src="mic.gif" alt="Start"></button>
			</div>
			<label for="voc">Vocalisation du résultat:</label><input type="checkbox" id="voc"  /><!-- checked -->
			<input type="button" value="Vocaliser" onclick="vocalise($('#answer').text())">
			<hr>
			<p id="url"></p>
			<p id="answer"></p>
			<input type="hidden" id="name" value="<?= $name ?>">
		</form>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="anywhere.js"></script>
</body>
</html>