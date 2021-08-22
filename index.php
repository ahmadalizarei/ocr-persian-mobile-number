<html>
<head>
<title>An OCR application for Persian mobile number</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src='https://unpkg.com/tesseract.js@v2.0.2/dist/tesseract.min.js'></script>
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

<script>
function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', text);
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}
var str= window.location.href;
  var url = str.substring(
    str.lastIndexOf("http://"), 
    str.lastIndexOf("?filename=")
);

function hiddenF(){
  document.getElementById("input").value=""; 
}
function doOCR(){
var str= window.location.href;
  var part = str.substring(
    str.lastIndexOf("?filename=") + 10, 
    str.lastIndexOf("")
);

var pNum=/[^۰-۹]/;
Tesseract.recognize(
part,
'fas',
{ logger: m => document.getElementById("progress").innerText=Math.round(m.progress*100)+"%" }).then(({ data: { text } }) => {
 const words = text.split(" ");
 var cnt=0;
 
  for (i = 0; i < words.length; i++) {
  if(!pNum.test(words[i])){
    if(words[i].length==11){
     if(words[i].charAt(1)=="۹"){

          
          if(words[i].charAt(0)=="۰"){
            
   $.ajax({
   type : "POST", 
   url  : "sindex.php",  
   data :  {word :words[i], name:document.getElementById("input").value},
   success: function()
   {  

   console.log("Successful!"); 
   
    document.getElementById("download").innerText="download";   
       document.getElementById("download").setAttribute('href', url+document.getElementById("input").value+".txt");    
      
     download( document.getElementById("input").value, url+document.getElementById("input").value+".txt");
       document.getElementById("tics").innerText=""; 
   document.getElementById("tics").setAttribute('style', "opacity:0; cursor:default;margin-left:40%;");    
    document.getElementById("tics").setAttribute('onclick', ""); 
    
  
      },
   
}
);
            


    }
}
}
}
}

}

);

}
</script>
</head>
<body>
 
<div class="col-md-12 col-xs-12">
<div class="card">
<h1 id="progress">Select your file</h1>

<form  action=".">
   <div class="row">
  
       <div class="col-md-6">
  <input type="file"  id="myFile" class="hidden" name="filename" hidden>

</input>
<label for="myFile" id="l1" >Browse File</label>
</div>
<div class="col-md-6">
  <button type="submit" class="btn"><i class="fa fa-upload"></i></button>
  </div>

</form>

</div>
 <input value="File Name" id="input" onclick="hiddenF()" class="tin"  type="text"></input>
 <div class="col-md-12">
     
  <button id="tics" class="tic" value="start" onClick="return doOCR()">
    
Start
    <a id="download" download>
  </button>
  
  </div>

</div>

</div>

</body>
</html>


