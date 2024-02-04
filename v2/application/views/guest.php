<html>
<head>
  <title>Guest</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <link href="<?=base_url()?>res/css/micons.css" rel="stylesheet">
  <script src="<?=base_url()?>res/js/jquery.js"></script>
  <style type="text/css">
    body{
      font-family: sans-serif;
      margin:0px;
      overflow-x:hidden;
      user-select:none;
      touch-action:manipulation;
    }
  </style>
</head>
<body onload="snap();">
<script type="text/javascript">
  setInterval( function(){
    $.ajax("<?=base_url()?>index.php/guest/rec/")
    .then(function(rec){
      $("#rec").html(rec);
      if(document.getElementById("rec").innerHTML==""){
        $("#rec").hide('slow');
      }
      else{
        $("#rec").show('slow');
        window.scrollTo({top:1000,behavior:'smooth'});
      }
    });
    $.ajax("<?=base_url()?>index.php/guest/nmsg/")
    .then(function(resp){
      if(resp=='1'){
        $("#rec").css("font-size","50px");
        $("#rec").css("background","darkslategray");
      }
      else{
        $("#rec").css("font-size","25px");
        $("#rec").css("background","gray");
      }
    });
  },200);
  setInterval( function(){
    $.ajax("<?=base_url()?>index.php/user/mk/")
    .then(function(mk){
      $("#img").attr("src","<?=base_url()?>res/img/user"+mk+".jpg");
    });
  },1000);
  var ggps = '0.00, 0.00';
  setInterval( function(){
    gps();
    $.ajax("<?=base_url()?>index.php/guest/getgps")
    .then(function(gps){
      if(ggps!=gps){
        $("#iframe").attr("src","https://maps.google.com/maps?q="+gps+"&z=15&output=embed");
        ggps = gps;
      }
    });
  },3000);
</script>
<canvas style="display:none;" id="canvas" width="50" height="50"></canvas>
<video autoplay="true" id="video" style="
    transform:scaleX(-1);
    position:absolute;
    width: 30vw;
    height: 30vw;
    background: gray;
    right: 0px;
    top: 50vh;
    margin-top: -20vw;
    border-top: 4px solid yellow;
    border-right: 4px solid yellow;
    border-bottom: 4px solid yellow;
    border-radius: 0px 50px 50px 0px;
    ">
</video>



<div style="width:100%;height:50vh;
  text-align:center;
  border-bottom:2px solid yellow;
  border-right:0px;
  border-left:0px;
  border-top:0px;
">
  <img src="" id="img" style="
  width:50vh;height:50vh;
  border:none;
  " />
</div>



<div style="width:100%;height:50vh;
    text-align:center;
    border-bottom:0px;
    border-right:0px;
    border-left:0px;
    border-top:2px solid yellow;
">
  <iframe id="iframe" style="width:50vh;height:50vh;border:none;
  " src="https://maps.google.com/maps?q=0.00, 0.00z=15&output=embed"></iframe>
</div>



<div style="width:100%;">
  <div style="padding: 0px 20px 0px 20px;" id="chat">
    <br>
    <div style="text-align:left;">
        <text id="rec" align="left" style="
      display:none;
      /*box-shadow: 0px 0px 30px -5px black;*/
      transition: 0.5s;
      transform-origin:0% 0%;
      padding: 5px 20px 5px 20px;
      background: gray;
      color: white;
      border-radius: 0px 20px 40px 20px;
      font-size: 25px;
      "></text>
    </div>
    <br><br>
    <div style="text-align:right;">
      <text id="snd" align="right" style="
      display:none;
      width: fit-content;
      margin-right: 0px;
      margin-left: auto;
      /*box-shadow: 0px 0px 30px -5px black;*/
      transition: 0.5s;
      transform-origin:100% 100%;
      padding: 5px 20px 5px 20px;
      background: forestgreen;
      color: white;
      border-radius: 40px 20px 0px 20px;
      font-size: 25px;"></text>
    </div>
    <br>
  </div>

  <div style="width:100%;height:50px;bottom:0px;position:sticky;">
    <table width="100%" height="100%">
      <tr>
        <td align="center">
          <button style="outline:none;width:50px;height:100%;border:2px solid gray;font-size:25px;border-radius:50px;" 
            type="button"><i class="material-icons">&#xe226;</i></button>
        </td>
        <td align="center">
          <input 
            onkeyup="msg(this.value);" 
            value="" 
            type="text" 
            id="text" 
            style="
            border-radius: 50px 0px 0px 50px;
            border: 2px solid gray;
            font-size: 25px;
            width:100%;
            height:100%;
            outline:none;
            padding-left:15px;" />
        </td>
        <td align="center">
          <button onclick="sendm();" style="outline:none;width:50px;height:100%;border:2px solid gray;font-size:25px;border-radius:0px 50px 50px 0px;" 
            type="button"><i class="material-icons">&#xe163;</i></button>
        </td>
      </tr>
    </table>
  </div>
</div>

<form style="display:none;" method="post" accept-charset="utf-8" name="form1">
 <input name="hdata" id='hdata' type="hidden"/>
</form>
<script type="text/javascript">
  function sendm(){
    $.ajax("<?=base_url()?>index.php/guest/sendm/")
    .then(function(resp){
      $("#snd").css("font-size","50px");
      $("#snd").css("background","darkgreen");
      window.scrollTo({top:1000,behavior:'smooth'});
    });
  }
  function msg(thi){
    $("#snd").css("font-size","25px");
    $("#snd").css("background","forestgreen");
    $.ajax({
      url: "<?=base_url()?>index.php/guest/msg/",
      type: "POST",
      data: { msg: thi } ,
      cache: false,
    success: function(resp){
      if(resp==''){
        $("#snd").hide('slow');
        setTimeout(function(){ $("#snd").css("opacity","0%"); $("#snd").css("text-size","0px"); },1000);
      }
      else{
        $("#snd").html(resp);
        $("#snd").css("display","block");
        setTimeout(function(){ $("#snd").css("opacity","100%"); $("#snd").css("text-size","25px"); },1000);
      }
      window.scrollTo({top:1000,behavior:'smooth'});
    }});
  }
</script>
<script>
var video = document.querySelector("#video");
if (navigator.mediaDevices.getUserMedia){
  navigator.mediaDevices.getUserMedia({ video: true })
  .then(function(stream){video.srcObject=stream; });
}

function snap(){
  var video = document.getElementById("video");
  var canvas = document.getElementById('canvas');
  var context = canvas.getContext('2d');
  var snap = setInterval( function(){

    context.drawImage(video,0,0, 50, 50);
    var dataURL = canvas.toDataURL("image/png");
    document.getElementById('hdata').value = dataURL;
    var fd = new FormData(document.forms["form1"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=base_url()?>index.php/guest/snap/', true);
    xhr.send(fd);
  },1000);
}
</script>
<script>
function gps(){
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(function(position){
      $.ajax("<?=base_url()?>index.php/guest/pushgps/"+position.coords.latitude+"/"+position.coords.longitude);
    });
  }
  else{
    $.ajax("<?=base_url()?>index.php/guest/pushgps/0.00/0.00");
  }
}
</script>
</body>
</html>