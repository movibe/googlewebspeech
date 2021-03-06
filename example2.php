
<!--
Copyright 2014 - Eric Bidelman <ebidel@gmail.com>
-->
<!DOCTYPE html>
<html>
<head>
  <title>Talk to your computer</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">
  <style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: "Open Sans", sans-serif;
    font-weight: 300;
  }
  .flex {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
  }
  .align-items-center {
    -webkit-align-items: center;
    align-items: center;
  }
  .green {
    color: green;
  }
  .red {
    color: darkred;
  }
  .bold {
    font-weight: bold;
  }
  body {
    -webkit-flex-direction: column;
    -mox-flex-direction: column;
    -ms-flex-direction: column;
    -o-flex-direction: column;
    flex-direction: column;
  }
  section button {
    padding: 10px;
  }
  section.top {
    padding: 0.5em 1em;
  }
  section.bottom {
    -webkit-flex: 1;
    flex: 1;
    -webkit-justify-content: center;
    justify-content: center;
  }
  output {
  /*  -webkit-align-self: stretch;
    align-self: stretch;*/
    height: 240px;
    width: 100%;
    font-size: 100px;
    color: rgba(0,0,0,0.1);
    overflow: auto;
    line-height: 1.2;
    padding: 0 0.5em;
  }
  output :last-child {
    color: black;
  }
  .support {
    color: red;
    text-align: center;
    font-weight: 600;
  }
  #recog-support, #synth-support {
    display: none;
  }
  .show {
    display: block !important;
  }
  summary {
    text-align: center;
    margin: 2em;
  }
  </style>
</head>
<body class="flex">

<div class="support">
  <p id="recog-support">Your browser doesn't support <a href="https://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html#speechreco-section"><code>window.SpeechRecognition</code></a> from the Web Speech API.</p>
  <p id="synth-support">Your browser doesn't support <a href="https://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html#tts-section"><code>window.speechSynthesis</code></a> from the Web Speech API.</p>
</div>

<summary>Auto-translate! Esta demonstração usa a <a href="https://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html">Web Speech API</a> a voz de entrada do microfone (voz para texto) e síntese de fala (text to speech) para reproduzir o seu discurso traduzido usando o Google Translate API.</summary>

<section class="top flex align-items-center">
  <button class="green">Iniciar</button>
  <button class="red" disabled>Parar</button>
  <span style="margin-left: 10px">Idioma: <select id="lang">
    <option>de</option>
    <option>en</option>
    <option>es</option>
    <option selected>pt-BR</option>
    <option>fr</option>
    <option>it</option>
    <option>nl</option>
    <option>zh</option>
    <option>zh</option>
  </select></span>
  <span id="status"></span>
</section>
<section class="bottom flex align-items-center">
  <output></output>
</section>

<script src="js/latinize.js"></script>
<script src="js/computer_speak.js?2014"></script>
<script>
var recogStatus = document.querySelector('#status');
var out = document.querySelector('output');
var langSelect = document.querySelector('#lang');
var startButton = document.querySelector('button.green');
var stopButton = document.querySelector('button.red');

var justSpoke = false;

// Toggle browser support messages.
if (!('speechSynthesis' in window)) {
  document.querySelector('#synth-support').classList.add('show');
}

if (!('SpeechRecognition' in window)) {
  document.querySelector('#recog-support').classList.add('show');
}

var computer = new Computer(true, out);

computer.onresult = function(e) {
  if (e.results.length) {
    var result = e.results[e.resultIndex];
    if (result.isFinal) {

      // Protection from spoken response through speakers creating a cycle.
      if (justSpoke) {
        justSpoke = false;
        return;
      }

      console.log('Recebendo voz: ' + result[0].transcript);
      this.translate(result[0].transcript);
    }
  }
};

computer.onstart = function(e) {
  recogStatus.textContent = 'Ouvindo....';
  stopButton.disabled = false;
  startButton.disabled = true;
  justSpoke = false;
};

computer.onend = function(e) {
  recogStatus.textContent = '';
  startButton.disabled = false;
  stopButton.disabled = true;
  justSpoke = false;
};

langSelect.addEventListener('change', function(e) {
  computer.DEST_LANG = e.target.value;
});

startButton.addEventListener('click', function(e) {
  // e.target.classList.toggle('bold');
  // stopButton.classList.remove('bold');
  computer.listen();
});

stopButton.addEventListener('click', function(e) {
  // e.target.classList.toggle('bold');
  // startButton.classList.remove('bold');
  computer.stopListening();
});

document.addEventListener('DOMContentLoaded', function(e) {
  computer.DEST_LANG = langSelect.value;

  // computer.speak('Situação');
});
</script>

</body>
</html>