<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vozes</title>
	<script>
var msg = new SpeechSynthesisUtterance();
var voices = window.speechSynthesis.getVoices();
// Opção de voz
msg.voice = voices[10]; // Obs: algumas vozes não dão suporte a alterar alguns parâmetros
// Tipo de voz
msg.voiceURI = 'native';
// Volume
msg.volume = 1; // 0 to 1
// Velocidade
msg.rate = 1; // 0.1 to 10
// Tom
msg.pitch = 1; //0 to 2
// Texto
msg.text = 'Boa noite, testando sistema de voz pelo Google Chrome';
// Idioma
msg.lang = 'pt-BR';

msg.onend = function(e) {
  console.log('Finished in ' + event.elapsedTime + ' seconds.');
};



// Falar
speechSynthesis.speak(msg);

</script>
</head>
<body>
	
</body>
</html>