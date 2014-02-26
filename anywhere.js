
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
		$('#query').val('');
		$("#btn_cont").val("Dictée continue: Off");
		$("#btn_cont").removeClass("btn-success btn-warning").addClass("btn-danger");
		
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
			$('#query').attr("placeholder", "Que voulez vous que " + $('#name').val() + " exécute ?");
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
	$('#query').val('');
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
			if ($('#voc').attr('checked')) {
				// alert('yes');
				console.log('LOL: ' + data);
				vocalise(data);
			}
			// $('#query').val('');
	});
}

$('#searchform').submit(function(event) {
	event.preventDefault();
	sendToSARAH($("#query").val());
});

function vocalise(text) {
	console.log("Bonjour");
	var msg = new SpeechSynthesisUtterance();
	var voices = window.speechSynthesis.getVoices();
	msg.voice = voices[10]; // Note: some voices don't support altering params
	msg.voiceURI = 'native';
	msg.volume = 1; // 0 to 1
	msg.rate = 1; // 0.1 to 10
	msg.pitch = 2; //0 to 2
	msg.text = text;
	console.log(msg.text);
	msg.lang = 'fr-FR';
	
	msg.onend = function(e) {
	  console.log('Finished in ' + event.elapsedTime + ' seconds.');
	};
	msg.onerror = function(e) {
		console.error("Ah que problème !");
	};
	speechSynthesis.speak(msg);
}