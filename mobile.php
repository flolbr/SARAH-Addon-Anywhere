<?php 
	$name = "J.A.R.V.I.S";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Emulate (<?= $name ?>) | Black3v3r</title>
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css"> -->
</head>
<body>
   <!--  <div class="container">
       <form class="form-signin" role="form" id="searchform">
           <h2 class="form-signin-heading">Envoyez vos demandes à <?= $name ?></h2>
           <input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus speech onspeechchange="request();">
           <input type="text" name="query" id="query" class="form-control" placeholder="Que voulez vous que <?= $name ?> exécute ?" required autofocus x-webkit-speech onwebkitspeechchange="request();">
           <input type="submit" name="btn_send" id="btn_send" class="btn btn-lg btn-primary btn-block" value="Envoyer">
       </form>
         <div class="form-signin">
             <hr>
             <p id="url"></p>
             <p id="answer"></p>
         </div>
   </div>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
   <script type="text/javascript">
       function request() {
           $('#url').empty();
           $('#answer').empty();
           var query = $('#query').val();
           $.get( "./engine.php", {q : encodeURIComponent(query), profile : "Florian" }) 
               .done(function( data ) {
                   //var dataJSON = JSON.parse(data);
                   console.log(data);
                   //$('#url').append("URL: <a href=\"" + dataJSON.url + "\">" + dataJSON.url + "</a>");
                   $('#answer').append("Answer: " + data);
           });
       }
       $('#searchform').submit(function(event) {
           event.preventDefault();
           request();
       });
   </script> -->

    <textarea cols="50" id="speech" ></textarea>
    <input id="mic" onwebkitspeechchange="transcribe(this.value)" speech x-webkit-speech>

    <script type="text/javascript">
        function transcribe(words) {
            document.getElementById("speech").value = words;
            document.getElementById("micro").value = "";
            document.getElementById("speech").focus();
        }
    </script>
    



</body>
</html>