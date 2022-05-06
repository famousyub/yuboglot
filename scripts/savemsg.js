var db = openDatabase('mydb', '1.0', 'UserLog', 2 * 1024 * 1024);
       var msg;

       db.transaction(function (tx) {
          tx.executeSql('CREATE TABLE IF NOT EXISTS UserLog (id unique, log)');
          tx.executeSql('INSERT INTO UserLog (id, log) VALUES (1, "foobar")');
          tx.executeSql('INSERT INTO UserLog (id, log) VALUES (2, "logmsg")');
          msg = '<p>Log message created and row inserted.</p>';
          document.querySelector('#status').innerHTML =  msg;
       })

       db.transaction(function (tx) {
          tx.executeSql('SELECT * FROM UserLog', [], function (tx, results) {
             var len = results.rows.length, i;
             msg = "<p>Found rows: " + len + "</p>";
             document.querySelector('#status').innerHTML +=  msg;

             for (i = 0; i < len; i++) {
                msg = "<p><b>" + results.rows.item(i).log + "</b></p>";
                document.querySelector('#status').innerHTML +=  msg;
             }
          }, null);
       });


       if (('localStorage' in window) && window.localStorage !== null) {

         // easy object property API
         localStorage.wishlist = '["Unicorn","Narwhal","Deathbear"]';

       } else {

         // without sessionStorage we'll have to use a far-future cookie
         //   with document.cookie's awkward API :(
         var date = new Date();
         date.setTime(date.getTime()+(365*24*60*60*1000));
         var expires = date.toGMTString();
         var cookiestr = 'wishlist=["Unicorn","Narwhal","Deathbear"];'+
                         ' expires='+expires+'; path=/';
         document.cookie = cookiestr;
       }
       function gotStream(stream) {
          window.AudioContext = window.AudioContext || window.webkitAudioContext;
          var audioContext = new AudioContext();

          // Create an AudioNode from the stream
          var mediaStreamSource = audioContext.createMediaStreamSource(stream);

          // Connect it to destination to hear yourself
          // or any other node for processing!
          mediaStreamSource.connect(audioContext.destination);
       }
       navigator.getUserMedia({audio:true}, gotStream);

       function createCORSRequest(method, url) {
          var xhr = new XMLHttpRequest();

          if ("withCredentials" in xhr) {

             // XHR for Chrome/Firefox/Opera/Safari.
             xhr.open(method, url, true);
          } else if (typeof XDomainRequest != "undefined") {

             // XDomainRequest for IE.
             xhr = new XDomainRequest();
             xhr.open(method, url);
          } else {

             // CORS not supported.
             xhr = null;
          }
          return xhr;
       }

       // Helper method to parse the title tag from the response.
       function getTitle(text) {
          return text.match('<title>(.*)?</title>')[1];
       }

       // Make the actual CORS request.
       function makeCorsRequest() {

          // All HTML5 Rocks properties support CORS.
          var url = 'http://www.tutorialspoint.com';

          var xhr = createCORSRequest('GET', url);

          if (!xhr) {
             alert('CORS not supported');
             return;
          }

          // Response handlers.
          xhr.onload = function() {
             var text = xhr.responseText;
             var title = getTitle(text);
             alert('Response from CORS request to ' + url + ': ' + title);
          };

          xhr.onerror = function() {
             alert('Woops, there was an error making the request.');
          };
          xhr.send();
       }
