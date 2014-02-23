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
			<label for="voc">Vocalisation du résultat:</label><input type="checkbox" id="voc"/>
			<input type="button" value="Vocaliser" onclick="vocalise($('#answer').text())">
			<hr>
			<p id="url"></p>
			<p id="answer"></p>
		</form>
	</div>





	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script>
		var langs =
		[['Afrikaans',       ['af-ZA']],
		 ['Bahasa Indonesia',['id-ID']],
		 ['Bahasa Melayu',   ['ms-MY']],
		 ['Català',          ['ca-ES']],
		 ['Čeština',         ['cs-CZ']],
		 ['Deutsch',         ['de-DE']],
		 ['English',         ['en-AU', 'Australia'],
							 ['en-CA', 'Canada'],
							 ['en-IN', 'India'],
							 ['en-NZ', 'New Zealand'],
							 ['en-ZA', 'South Africa'],
							 ['en-GB', 'United Kingdom'],
							 ['en-US', 'United States']],
		 ['Español',         ['es-AR', 'Argentina'],
							 ['es-BO', 'Bolivia'],
							 ['es-CL', 'Chile'],
							 ['es-CO', 'Colombia'],
							 ['es-CR', 'Costa Rica'],
							 ['es-EC', 'Ecuador'],
							 ['es-SV', 'El Salvador'],
							 ['es-ES', 'España'],
							 ['es-US', 'Estados Unidos'],
							 ['es-GT', 'Guatemala'],
							 ['es-HN', 'Honduras'],
							 ['es-MX', 'México'],
							 ['es-NI', 'Nicaragua'],
							 ['es-PA', 'Panamá'],
							 ['es-PY', 'Paraguay'],
							 ['es-PE', 'Perú'],
							 ['es-PR', 'Puerto Rico'],
							 ['es-DO', 'República Dominicana'],
							 ['es-UY', 'Uruguay'],
							 ['es-VE', 'Venezuela']],
		 ['Euskara',         ['eu-ES']],
		 ['Français',        ['fr-FR']],
		 ['Galego',          ['gl-ES']],
		 ['Hrvatski',        ['hr_HR']],
		 ['IsiZulu',         ['zu-ZA']],
		 ['Íslenska',        ['is-IS']],
		 ['Italiano',        ['it-IT', 'Italia'],
							 ['it-CH', 'Svizzera']],
		 ['Magyar',          ['hu-HU']],
		 ['Nederlands',      ['nl-NL']],
		 ['Norsk bokmål',    ['nb-NO']],
		 ['Polski',          ['pl-PL']],
		 ['Português',       ['pt-BR', 'Brasil'],
							 ['pt-PT', 'Portugal']],
		 ['Română',          ['ro-RO']],
		 ['Slovenčina',      ['sk-SK']],
		 ['Suomi',           ['fi-FI']],
		 ['Svenska',         ['sv-SE']],
		 ['Türkçe',          ['tr-TR']],
		 ['български',       ['bg-BG']],
		 ['Pусский',         ['ru-RU']],
		 ['Српски',          ['sr-RS']],
		 ['한국어',            ['ko-KR']],
		 ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
							 ['cmn-Hans-HK', '普通话 (香港)'],
							 ['cmn-Hant-TW', '中文 (台灣)'],
							 ['yue-Hant-HK', '粵語 (香港)']],
		 ['日本語',           ['ja-JP']],
		 ['Lingua latīna',   ['la']]];
		
		for (var i = 0; i < langs.length; i++) {
		  select_language.options[i] = new Option(langs[i][0], i);
		}
		select_language.selectedIndex = 9;
		updateCountry();
		select_dialect.selectedIndex = 0;
		showInfo('info_start');
		
		function updateCountry() {
			for (var i = select_dialect.options.length - 1; i >= 0; i--) {
			  select_dialect.remove(i);
			}
			var list = langs[select_language.selectedIndex];
			for (var i = 1; i < list.length; i++) {
			  select_dialect.options.add(new Option(list[i][1], list[i][0]));
			}
			select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
		}
		
		// var create_email = false;
		var final_transcript = '';
		var recognizing = false;
		var ignore_onend;
		var start_timestamp;
		if (!('webkitSpeechRecognition' in window)) {
		  upgrade();
		} else {
			start_button.style.display = 'inline-block';
			var recognition = new webkitSpeechRecognition();
			recognition.continuous = true;
			recognition.interimResults = true;
		
			recognition.onstart = function() {
				// $('#answer').empty();
				recognizing = true;
				showInfo('info_speak_now');
				start_img.src = 'mic-animate.gif';


				$("#btn_cont").val("Dictée continue: On");
				$("#btn_cont").removeClass("btn-danger btn-warning").addClass("btn-success");
			};
		
			recognition.onerror = function(event) {
				if (event.error == 'no-speech') {
				  start_img.src = 'mic.gif';
				  showInfo('info_no_speech');
				  ignore_onend = true;
				}
				if (event.error == 'audio-capture') {
				  start_img.src = 'mic.gif';
				  showInfo('info_no_microphone');
				  ignore_onend = true;
				}
				if (event.error == 'not-allowed') {
					if (event.timeStamp - start_timestamp < 100) {
						showInfo('info_blocked');
					} else {
						showInfo('info_denied');
					}
					ignore_onend = true;
				}
			};
		
			recognition.onend = function() {
				recognizing = false;
				if (ignore_onend) {
					return;
				}
				start_img.src = 'mic.gif';
				if (!final_transcript) {
					showInfo('info_start');
					return;
				}
				showInfo('');
				if (window.getSelection) {
					window.getSelection().removeAllRanges();
					var range = document.createRange();
					range.selectNode(document.getElementById('final_span'));
					window.getSelection().addRange(range);
				}


				$("#btn_cont").val("Dictée continue: Off");
				$("#btn_cont").removeClass("btn-success btn-warning").addClass("btn-danger");
				/*if (create_email) {
				  create_email = false;
				  createEmail();
				}*/
			};
		
			recognition.onresult = function(event) {
				$('#answer').empty();
				var interim_transcript = '';
				final_transcript = ""; // @MODIF
				for (var i = event.resultIndex; i < event.results.length; ++i) {
					if (event.results[i].isFinal) {
					  final_transcript += event.results[i][0].transcript;
					} else {
					  interim_transcript += event.results[i][0].transcript;
					}
				}
				final_transcript = capitalize(final_transcript);
				// final_span.innerHTML = linebreak(final_transcript);
				// final_span.innerHTML = "";
				final_span.innerHTML = final_transcript;

				$('#query').val(final_transcript);
				$('#query').attr("placeholder", interim_transcript);
				console.log('final transcript: ' + final_transcript);
				interim_span.innerHTML = linebreak(interim_transcript);
				/*if (final_transcript || interim_transcript) {
				  showButtons('inline-block');
				}*/
				if (final_transcript) {
					//alert(final_transcript);
					sendToSARAH(final_transcript);
					$('#query').attr("placeholder", "Que voulez vous que <?= $name ?> exécute ?");
				};
		  };
		}
		
		function upgrade() {
			start_button.style.visibility = 'hidden';
			showInfo('info_upgrade');
		}
		
		var two_line = /\n\n/g;
		var one_line = /\n/g;
		function linebreak(s) {
			return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
		}
		
		var first_char = /\S/;
		function capitalize(s) {
		  return s.replace(first_char, function(m) { return m.toUpperCase(); });
		}
		
		/*function createEmail() {
	  var n = final_transcript.indexOf('\n');
	  if (n < 0 || n >= 80) {
		n = 40 + final_transcript.substring(40).indexOf(' ');
	  }
	  var subject = encodeURI(final_transcript.substring(0, n));
	  var body = encodeURI(final_transcript.substring(n + 1));
	  window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
		}*/
		
		/*function copyButton() {
	  if (recognizing) {
		recognizing = false;
		recognition.stop();
	  }
	  copy_button.style.display = 'none';
	  copy_info.style.display = 'inline-block';
	  showInfo('');
		}*/
		
		/*function emailButton() {
	  if (recognizing) {
		create_email = true;
		recognizing = false;
		recognition.stop();
	  } else {
		createEmail();
	  }
	  email_button.style.display = 'none';
	  email_info.style.display = 'inline-block';
	  showInfo('');
		}*/
		
		function startButton(event) {
			if (recognizing) {
			  recognition.stop();
			  return;
			}
			final_transcript = '';
			recognition.lang = select_dialect.value;
			recognition.start();
			ignore_onend = false;
			final_span.innerHTML = '';
			interim_span.innerHTML = '';
			start_img.src = 'mic-slash.gif';

			$("#btn_cont").val("En attente de micro");
			$("#btn_cont").removeClass("btn-success btn-danger").addClass("btn-warning");

			showInfo('info_allow');
			showButtons('none');
			start_timestamp = event.timeStamp;
		}
		
		function showInfo(s) {
			if (s) {
			  for (var child = info.firstChild; child; child = child.nextSibling) {
				if (child.style) {
				  child.style.display = child.id == s ? 'inline' : 'none';
				}
			  }
			  info.style.visibility = 'visible';
			} else {
			  info.style.visibility = 'hidden';
			}
		}
		
		var current_style;
		function showButtons(style) {
			if (style == current_style) {
			  return;
			}
			current_style = style;
			/* copy_button.style.display = style;
			email_button.style.display = style;
			copy_info.style.display = 'none';
			email_info.style.display = 'none';*/
		}

		// Fonctions S.A.R.A.H:
		function sendToSARAH(query) {
			$('#answer').empty();
			$.get( "./engine.php", {q : encodeURIComponent(query)}) 
				.done(function( data ) {
					//var dataJSON = JSON.parse(data);
					console.log(data);
					//$('#url').append("URL: <a href=\"" + dataJSON.url + "\">" + dataJSON.url + "</a>");
					// $('#answer').append("Answer: " + data);
					$('#answer').append(data);
					if ($('#voc').is(':checked')) {
						// alert('yes');
						console.log('LOL: ' + data);
						vocalise(data);
					}
					$('#query').empty();
			});
		}

		$('#searchform').submit(function(event) {
			event.preventDefault();
			sendToSARAH($("#query").val());
		});

		function vocalise(text) {
			console.log('text: ' + text);
			var audio = new Audio();
			audio.src ='http://translate.google.com/translate_tts?ie=utf-8&tl=fr&q=' + text;
			// alert(audio.src);
			console.log(audio);
			console.log(audio.src);
			audio.play();
		}
	</script>
</body>
</html>