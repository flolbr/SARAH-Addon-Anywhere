<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Chrome 33 TTS | Black3v3r</title>
</head>
<body>
	<input type="text" name="text" id="text">
	<input type="button" value="Envoyer"  onclick="speak()" />
	<script type="text/javascript">
		function speak() {
			console.log("Bonjour");
			var msg = new SpeechSynthesisUtterance();
			var voices = window.speechSynthesis.getVoices();
			msg.voice = voices[10]; // Note: some voices don't support altering params
			msg.voiceURI = 'native';
			msg.volume = 1; // 0 to 1
			msg.rate = 1; // 0.1 to 10
			msg.pitch = 2; //0 to 2
			msg.text = $("#text").val();
			console.log(msg.text);
			msg.lang = 'fr-FR';
			
			msg.onend = function(e) {
			  console.log('Finished in ' + event.elapsedTime + ' seconds.');
			};
			speechSynthesis.speak(msg);
        }
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
</html>