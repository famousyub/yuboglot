
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js" integrity="sha256-S1J4GVHHDMiirir9qsXWc8ZWw74PHHafpsHp5PXtjTs=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" charset="utf-8"></script>

<style>
* {
  box-sizing: border-box;
  transition: all 250ms;
  font-family: "Roboto", sans-serif;
  color: white;
}

body {
  margin: 0;
  height: 100vh;
  background: #263238;
  position: relative;
}

/* App Bar */

header {
  width: 100%;
  position: sticky;
  top: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;

  font-size: 24px;
  padding: 8px 16px;
}

header p {
  margin: 0;
}

header img {
  width: 48px;
  aspect-ratio: 1/1;
  border-radius: 50%;
}

/* Creddit Card */

.credit-card {
  position: relative;
  width: calc(100% - 32px);
  margin: 32px 16px;
  padding: 32px;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0px 0px 15px 1px #212121;
}

.credit-card::before {
  content: " ";
  position: absolute;
  inset: 0;
  background: url("https://media.istockphoto.com/vectors/warm-to-cool-abstract-layered-wavy-background-vector-id1291199071?k=20&m=1291199071&s=612x612&w=0&h=QYBTfMQy-a-fTMlRSN3AoGRt74BCsX_YsvQ3UAPS_L0=");
  background-size: cover;
  background-position: center;
  z-index: -1;
  filter: blur(10px) brightness(0.8);
}

.credit-card :is(p, h2) {
  margin: 0;
}

.credit-card p:first-of-type {
  margin-top: 32px;
  font-weight: 100;
}

.credit-card p:last-of-type {
  margin-top: 48px;
}

/* Status */

.stats {
  position: relative;
  width: calc(100% - 32px);
  margin: 0px 16px;

  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

.stats div {
  width: 100%;
  background-color: #212121;
  border-radius: 16px;
  padding: 16px 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0px 0px 15px 1px #212121;
}

.stats div p {
  margin: 0;
}

.stats div p:first-of-type {
  font-weight: 100;
}

.stats div p:last-of-type {
  font-weight: bold;
  font-size: 18px;
}

/* Transactions */

.transactions {
  position: fixed;
  width: calc(100% - 32px);
  margin: 0px 16px;
  background-color: #212121;
  bottom: 0;
  height: 35vh;
  border-radius: 16px 16px 0 0;
  padding: 16px;

  box-shadow: 0px 0px 15px 1px #212121;
}

.transactions .indicator {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);

  width: 72px;
  height: 10px;
  border: none;
  background-color: #bdbdbd;
  border-radius: 6px;

  display: flex;
  flex-direction: column;
  justify-content: stretch;
  align-items: flex-start;
}

.transactions .indicator:is(:hover, :active) {
  background-color: #ffffff;
}

/* RECORDS */

.transactions .expense {
  margin-top: 32px;
  width: 100%;
  height: 64px;
  display: grid;
  grid-template-columns: 64px auto auto;
  grid-template-areas:
    "avatar date amount"
    "avatar title amount";
  gap: 16px;
}

.transactions .expense p.avatar {
  grid-area: avatar;
  width: 100%;
  border-radius: 16px;
}

.transactions .expense p.date {
  grid-area: date;
}
.transactions .expense p.amount {
  grid-area: amount;
}
.transactions .expense p.title {
  grid-area: title;
  font-weight: 100;
  color: #eeeeee;
}

.transactions .expense p {
  margin: 0;
}

.transactions .expense p:is(.avatar, .amount) {
  display: flex;
  justify-content: center;
  align-items: center;

  font-size: 24px;
}

.transactions .expense.income p.avatar {
  background-color: #4caf50;
}

.transactions .expense.income p.amount {
  color: #4caf50;
}

.transactions .expense.outcome p.avatar {
  background-color: #f44336;
}

.transactions .expense.outcome p.amount {
  color: #f44336;
}

/*  */
/* OPEN */
/*  */

/* TODO : MORPH CARD */

.open .transactions {
  /*margin: 0;*/
  height: 80vh;
  width: 100%;
}
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}


.modal.in .modal-dialog {
 width:100% !important;
 min-height: 100%;
 margin: 0 0 0 0 !important;
 bottom: 0px !important;
 top: 0px;
}
.modal {
        padding: 0 !important;
    }
        .modal .modal-dialog {
            width: 100%;
            max-width: none;
            height: 100%;
            margin: 0;
        }
        .modal .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0;
        }
        .modal .modal-body {
            overflow-y: auto;
        }

.modal-content {
    border:0px solid rgba(0,0,0,.2) !important;
    border-radius: 0px !important;
    -webkit-box-shadow: 0 0px 0px rgba(0,0,0,.5) !important;
    box-shadow: 0 3px 9px rgba(0,0,0,.5) !important;
    height: auto;
    min-height: 100%;
}

.modal-dialog {
 position: fixed !important;
 margin:0px !important;
}

.bootstrap-dialog .modal-header {
    border-top-left-radius: 0px !important;
    border-top-right-radius: 0px !important;
}



</style>
</head>
<body>



<div class="container">


  <div id="root">


  </div>
  <div id="app" :class="{open: view}">




 <div class="container mt-3" >
   <h2>more </h2>
   <!-- Trigger the modal with a button -->
   <button type="button" class="btn btn-primary" id="myBtn">view more</button>

   <!-- The Modal -->
   <div class="modal fade" id="myModal">
     <div class="modal-dialog">
       <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
           <h4 class="modal-title">Modal Heading</h4>
           <button type="button" class="close" data-dismiss="modal">×</button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">

           <div v-if="info" class="jumbotron">
            <header>
              <i class="mdi mdi-menu"></i>
              <p> Balance </p>
              <img src="http://picsum.photos/200" alt="avatar">
            </header>

            <section class="credit-card">
              <p> BALANCE </p>
              <h2> 20000 </h2>
              <p> **** **** **** 1234 </p>
            </section>

            <section class="stats">
              <div>
                <p> INCOME <i class="mdi mdi-chevron-up"></i> </p>
                <p style="color: #66BB6A;"> 21</p>
              </div>
              <div>
                <p> OUTCOME <i class="mdi mdi-chevron-down"></i> </p>
                <p style="color: #EF5350;"> 18 </p>
              </div>
            </section>

            <section class="transactions">
              <button class="indicator" @click="view = !view"> </button>
              <div class="expense" v-for="(expense, i) in info" :key="`exp-${i}`" :class="expense.type">
                <p class="avatar">
                  <i class="mdi" :class="(expense.type == 'user') ? 'mdi-chevron-up' : 'mdi-chevron-down'"></i>
                </p>
                <p class="date"> {{ expense.user_id }} </p>
                <p class="title"> {{ expense.username }} </p>
                <p class="amount"> {{ expense.email }} </p>
              </div>
            </section>
           </div>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>

       </div>
     </div>
   </div>

 </div>








    <section v-if="errored">
   <p>Nous sommes désolés, nous ne sommes pas en mesure de récupérer ces informations pour le moment. Veuillez réessayer ultérieurement.</p>
 </section>

 <section v-else>
   <div v-if="loading">Chargement...</div>

   <div
     v-else
     v-for="currency in info"
     class="jumbotron"
   >
     {{ currency.user_id }}:
     <span class="lighten">
       <span v-html="currency.username"></span>{{ currency.username  }}
     </span>
     <p>
       {{currency.email}}
     </p>















                          <table class="table table-dark table-hover">
                            <thead>
                              <tr>
                                <th>id</th>
                                <th>Lastname</th>
                                <th>Email</th>
                              </tr>
                            </thead>
                            <tbody>

                     <tr  v-for="el in info">
                       <td>{{el.user_id}}</td>
                       <td>{{el.username}}</td>
                       <td>{{el.email}}</td>
                     </tr>





         </tbody>
        gender
         </table>










   </div>




 </section>

 <button @click="onClick()">get</button>
  </div>


  <h2>user in local </h2>
  <p>hello </p>

<?php


$ip =$_SERVER["REMOTE_ADDR"];

if(isset($_GET["gender"])){

  $gender = $_GET["gender"];
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8093/api/userip/'.$ip.'/genders?gender='.$gender,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    //CURLOPT_POSTFIELDS => array('server_key' => '243ff5897fcd6ec23f4dbf822535ce0f','username' => $username,'password' => $password),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $details = json_decode($response, TRUE);
//echo json_encode($details);

//var_dump ($details);

echo  '
<table class="table table-dark table-hover">
  <thead>
    <tr>
      <th>id</th>
      <th>Lastname</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>';
 foreach($details  as $key=>$det){
     //echo $det["user_id"];
     //echo $det["username"];




echo "
<tr>
  <td>{$det["user_id"]}</td>
  <td>{$det["username"]}</td>
  <td>{$det["email"]}</td>
</tr>

";


 }
 echo ' </tbody>
</table>';
//  return $details;
// json_encode($details);
}


else  {

  $gender = "male";
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8093/api/userip/'.$ip.'/genders?gender='.$gender,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    //CURLOPT_POSTFIELDS => array('server_key' => '243ff5897fcd6ec23f4dbf822535ce0f','username' => $username,'password' => $password),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $details = json_decode($response, TRUE);
//  var_dump($details);
//  return $details;

echo json_encode($details);


//return json_encode($details);

echo  '
<table class="table table-dark table-hover">
  <thead>
    <tr>
      <th>id</th>
      <th>Lastname</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>';
 foreach($details  as $key=>$det){
     //echo $det["user_id"];
     //echo $det["username"];




echo "
<tr>
  <td>{$det["user_id"]}</td>
  <td>{$det["username"]}</td>
  <td>{$det["email"]}</td>
</tr>

";


 }
 echo ' </tbody>
</table>';

// json_encode($details);
}





?>








</div>

<?php  echo $_SERVER['PHP_SELF'];?>
<?php   if(isset($_GET["gender"])) : ?>
<script type="text/javascript">

    var app = new Vue({
      el: '#app',
      data () {
    return {
      info: null,
      loading: true,
      errored: false,
      view: false,
    }
  },
      methods: {
          onClick() {
              axios({
                    url: "<?php echo 'http://localhost:8093/api/userip/'.$ip.'/genders?gender='.$_GET['gender'] ?>",
                    method: 'GET',
                    responseType: 'json',
                }).then((response) => {
 console.log(response.data);
 const data  = response.data ;

console.table(data);

this.loading=false;

this.info = data;
                  // response =response.json();
                     /*var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                     var fileLink = document.createElement('a');

                     fileLink.href = fileURL;
                     fileLink.setAttribute('download', 'file.pdf');
                     document.body.appendChild(fileLink);

                     fileLink.click();*/

                }).then(data=>{

              console.log(data);



                })
          }
      }
    })

</script>
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>
<?php endif?>

</body>
</html>
