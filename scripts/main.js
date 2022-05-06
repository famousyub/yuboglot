const btn = document.querySelector("button");
const reply =document.querySelector(".reply");
const msg =document.querySelector(".msg");
const re =document.querySelector("#er");
btn.addEventListener('click',()=>{
    fetch("http://localhost:8096/save_cached.php").then(res=>
      res=res.json()
    ).then(data=>{
    //  console.log(data);
      localStorage.setItem("data_posts",JSON.stringify(data));
    //  console.table(data);

      if(data.status){
          var radr = JSON.stringify(data.status);
          window.location.reload();
        re.innerHtml = radr;
        reply.innerHtml = radr
        msg.innerHtml = radr;
        alert(data.status);
      }
      else  {
        reply.replaceChildren('')
        data.forEach(el=>{



          var db = openDatabase('mydb', '1.0', 'myposts', 2 * 1024 * 1024);
                 var msg;

                 db.transaction(function (tx) {
                    tx.executeSql('CREATE TABLE IF NOT EXISTS POSTS2 (id postText,user_id, log)');
                    tx.executeSql(`INSERT INTO POSTS2 (id, postText,user_id,log) VALUES (${el.id}, foobar${el.postText},${el.user_id}),"logging"`);
                    //tx.executeSql('INSERT INTO POSTS (id, log) VALUES (2, "logmsg")');
                    msg = '<p>Log message created and row inserted.</p>';
                    document.querySelector('#status').innerHTML =  msg;
                 });

                 db.transaction(function (tx) {
                    tx.executeSql('SELECT * FROM POSTS2', [], function (tx, results) {
                       var len = results.rows.length, i;
                       msg = "<p>Found rows: " + len + "</p>";
                       document.querySelector('#status').innerHTML +=  msg;

                       for (i = 0; i < len; i++) {
                          msg = "<p><b>" + results.rows.item(i).user_id + "</b></p>";
                          document.querySelector('#status').innerHTML +=  msg;
                       }
                    }, null);
                 });






        //  console.log(el);
          const p1  = document.createElement('p');
          p1.innerHtml = `<small>${el.id}</small><h1 class="text text-success">${el.postText}</h1>`;

          var div = document.createElement('div');

        var person = document.createElement('span');
      //  person.className = 'person ' + personClass;
        person.appendChild(document.createTextNode(el.id));

var when = document.createElement('span');

when.appendChild(document.createTextNode(el.postText));

div.appendChild(person);
div.appendChild(when);
var worker = new Worker('./mydb.js');

         worker.onmessage = function (event) {
            alert("Completed " + event.data + "iterations" );
         };

         function sayHello() {
            alert("Hello sir...." );
         }

          reply.appendChild(p1);
          reply.appendChild(div);

        })
      }

    })



})
