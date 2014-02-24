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
    <div class="container">
        <form class="form-signin" role="form" id="searchform">
            <h2 class="form-signin-heading">Envoyez vos demandes à <?= $name ?></h2>
            <!-- <input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus speech onspeechchange="request();"> -->
            <input type="text" x-webkit-speech name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus spech onwebkitspeechchange="request();">
            <div class="btn-group btn-group-lg">
            	<input type="submit" name="btn_send" id="btn_send" class="btn btn-primary" value="Envoyer">
            	<input type="button" name="btn_cont" id="btn_cont" class="btn btn-danger" value="Dictée continue: Off" onclick="continous();">
            </div>
        </form>
          <div class="form-signin">
              <hr>
              <p id="url"></p>
              <p id="answer"></p>
          </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript">
    	var cont = 0;
    	function request() {
    		$('#url').empty();
            $('#answer').empty();
            var query = $('#query').val();
            $.get( "./engine.php", {q : encodeURIComponent(query)}) 
                .done(function( data ) {
                    //var dataJSON = JSON.parse(data);
                    console.log(data);
                    //$('#url').append("URL: <a href=\"" + dataJSON.url + "\">" + dataJSON.url + "</a>");
                    $('#answer').append("Answer: " + data);
                    vocalise(data);
            });
    	}
        $('#searchform').submit(function(event) {
            event.preventDefault();
            request();
        });
        function continous() {
        	if (cont == 0) {
        		cont = 1;
        		$("#btn_cont").val("Dictée continue: On");
        		$("#btn_cont").removeClass("btn-danger").addClass("btn-success");
        	} else {
        		cont = 0;
        		$("#btn_cont").val("Dictée continue: Off");
        		$("#btn_cont").removeClass("btn-success").addClass("btn-danger");
        	}
        }
        function vocalise(text) {
			var audio = new Audio();
			audio.src ='http://translate.google.com/translate_tts?ie=utf-8&tl=fr&q=' + text;
			// alert(audio.src);
			console.log(audio.src);
			audio.play();
		}
    </script>
</body>
</html>