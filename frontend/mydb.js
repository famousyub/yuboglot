




fetch("http://localhost:8096/save_cached.php").then(res=>
  res=res.json()
).then(data=>{
  localStorage.setItem("fi",data);
  if(data.status){
    console.log(data.status);


  }
else  {

  console.log(new Date());
}


})
