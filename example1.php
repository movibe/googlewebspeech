<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Exemplo 1 - Fala Natural Feminina</title>
	  

    <script type="text/javascript">
     var u = new SpeechSynthesisUtterance();
     u.text = 'Boa noite Natália, você está fazendo uma comida muito cheirosa!';
     u.lang = 'pt-BR';
     u.rate = 1;
     // u.onend = function(event) { alert('Evento finalizado em ' + event.elapsedTime + ' segundos.'); }
     speechSynthesis.speak(u);
  </script>
            
            
</head>
<body>
	
</body>
</html>