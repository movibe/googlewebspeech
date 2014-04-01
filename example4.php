
<!DOCTYPE html>
<html>
<head>
  <title>Demo of web speech API Text to Speech / Speech Synthesis function</title>

  <style>
    body {
      font-family: Helvetica;
      font-size:100%;
      padding:20px;
      margin:0px
    }
    .highlight {
      color: red;
    }
    h2 {
      color: darkred;
      font-weight: normal;
    }
  </style>

  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

  <script>

     var voices = [];

    $(document).ready(function() {

      // var ischrome = navigator.userAgent.match(/chrome/i);
      // if(ischrome) {

        // var u2 = new SpeechSynthesisUtterance();
        // var u3 = new SpeechSynthesisUtterance();
       // voices = window.speechSynthesis.getVoices();
       voices = window.speechSynthesis.getVoices();

       console.log('Get voices ' + voices.length.toString());

          for(var i = 0; i < voices.length; i++ ) {
            console.log("Voice " + i.toString() + ' ' + voices[i].name);
          }

        // Demo 1
        $("#demo_1").on('click', function(e) {
          // e.preventDefault();
          var u1 = new SpeechSynthesisUtterance('You have reached your destination');
          u1.lang = 'pt-BR';
          u1.pitch = 1;
          u1.rate = 1;
          u1.voice = voices[10];
          u1.voiceURI = 'native';
          u1.volume = 1;
          speechSynthesis.speak(u1);
          console.log("Voice " + u1.voice.name);

        });

        // // Demo 2
        $("#demo_2").click(function(e) {
          e.preventDefault();
          var u2 = new SpeechSynthesisUtterance('You have reached your destination');
          u2.text = 'You have reached your destination';
          u2.lang = 'pt';
          u2.rate = 1.2;
          u2.onend = function(event) { console.log('Speech complete'); }
          speechSynthesis.speak(u2);
          console.log('lang ' + u2.lang + "\n" + 'rate ' + u2.rate );
        });

        // // Demo 3
        // $("#demo_3").click(function(e) {
        //   e.preventDefault();
        //   u3.text = 'The quick brown fox jumps over the lazy dog';
        //   u3.lang = 'pt-BR';
        //   u3.rate = 0.75;
        //   u3.pitch = 2.0;
        //   u3.volume = 0.5;
        //   speechSynthesis.speak(u3);
        // });

        $("#demo_4").click(function(e) {
          e.preventDefault();
          var voices = speechSynthesis.getVoices();
          for(var i = 0; i < voices.length; i++ ) {
            console.log("Voice " + i.toString() + ' ' + voices[i].name);
          }
        });

      // } else {
      //   alert("Sorry - these demos only work in the Google Chrome Browser at present");
      // }

    });
  </script>

</head>
<body>
  <h2>Demo of Web Speech API Speech Synthesis interface (Text to Speech)</h2>

  <p>Here are some very simple demos based on the Web Speech API <a href="https://dvcs.w3.org/hg/speech-api/raw-file/tip/speechapi.html#tts-section">SpeechSynthesis Interface</a></p>

  <p>As of 2013-06-05, this is an experimental feature in the Google Chrome Canary browser (not the regular release version). </p>

  <p>To use it you must go to the <span class='highlight'>chrome://flags</span> settings page, enable <span class='highlight'>experimental WebKit features</span> and <span class='highlight'>restart</span> your browser.</p>

  <p>This interface is under <span class='highlight'>active</span> development... there are some bugs and not all parts of the API are implemented... caveat emptor</p>

  <p class='highlight'>Open up the Javascript console in Google Chrome (under Developer Tools) to see the output from some of these demos</p>
  <p> &nbsp; <br/> &nbsp; </p>

  <h2>Demo 1:  Minimal Example</h2>

  <p>Create a new SpeechSynthesisUtterance and speak it...</p>
  <pre>
    var u = new SpeechSynthesisUtterance('You have reached your destination');
    speechSynthesis.speak(u);
  </pre>

  <input type="button" id="demo_1" value="Speak">


  <h2>Demo 2:  Example with options</h2>

  <p>Create a new SpeechSynthesisUtterance and speak it...</p>
  <pre>
     var u = new SpeechSynthesisUtterance();
     u.text = 'You have reached your destination';
     u.lang = 'pt-BR';
     u.rate = 1.2;
     u.onend = function(event) { console.log('Speech complete'); }
     speechSynthesis.speak(u);
  </pre>

  <input type="button" id="demo_2" value="Speak">

  <h2>Demo 3:  More options</h2>

  <p>Decreased rate of speech and volume, increased pitch... language and voiceURI do not seem to have any effect as yet</p>
  <pre>
      var u = new SpeechSynthesisUtterance();
      u.text = 'The quick brown fox jumps over the lazy dog';
      u.lang = 'pt-BR';
      u.rate = 0.75;
      u.pitch = 2.0;
      u.volume = 0.5;
      speechSynthesis.speak(u);
  </pre>

  <input type="button" id="demo_3" value="Speak">

  <h2>Demo 4:  Get Voices</h2>

  <p>Fetch a list of the available voices - on my system (Mac OS X), these correspond to the MacOSX 'English (United States) - Novelty' list</p>
  <p>No doubt this will be expanded as the software matures - I can't tell if the browser is relying on the system voices or not</p>
  <p>The voiceURI attribute of SpeechSynthesisUtterance does not seem to be implemented as yet</p>
  <pre>
      var voices = speechSynthesis.getVoices();
      for(var i = 0; i < voices.length; i++ ) {
        console.log("Voice " + i.toString() + ' ' + voices[i].name + ' ' + voices[i].uri);
      }
  </pre>

  <input type="button" id="demo_4" value="fetch">


  <p> &nbsp; <br/> &nbsp; </p>

  <p>These demos were written by <a href="http://craic.com">Rob Jones - Craic Computing LLC</a>, based on the API document, and are made freely available under the MIT License</p>
  <p>I am not involved in the development of the API or browser software in any way.</p>

  <p> &nbsp; <br/> &nbsp; </p>

</body>
</html>
