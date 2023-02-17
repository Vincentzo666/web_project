<?php

if(isset($_GET['id'])){

  $id = $_GET['id'];
  
  $student = $lms->select('student',"*","id='$id'");
  
}else{
    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบข้อมูล!";
    echo "<script> window.history.back()</script>";
    exit;
}

?>
<style>
  .spinner-wrapper{
    background-color:#000;
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index: 9999;
    display:flex;
    justify-content:center;
    align-items:center;
  }

  .spinner-border{
    height:60px;
    width:60px;
  }

</style>

<div class="spinner-wrapper text-primary" id="loadp">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  &nbsp;<h4>&nbsp;Loading...</h4>
</div>

<div id="parent1" style="display:flex;background-color:#f0f8ff;">
    <div class="margin" style="position: relative; float:center; margin: 50px; ">
      <video id="vidDisplay" style="width: 800px; height: 600px; display: inline-block; vertical-align: baseline; border: 3px solid black;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
      <canvas id="overlay" style="position: absolute; top: 0; left: 0;" width = "800" height = "600"/>
    </div>
    
    <div id="parent2" style="margin:100px 0 0 35px;" class="col-sm-4">
      <div>
        <button id="capture" class="btn btn-primary btn-md" >Start Capture</button>
        <a class="btn btn-warning ms-5" id="backpage"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
      </div><br><br>
      <h5 id="tries" style="margin-left:5px;">Trials Left : </h5><br><br>
      <img src="upload/img_student/<?= $student[0]['std_pic'] ?>" style="width: 200px; height: 200px; object-fit: cover;"><br><br>
      <h5  style="margin-left:5px;">Student ID : <?= $student[0]['std_id'] ?></h5><br>
      <h5  style="margin-left:5px;">First Name : <?= $student[0]['fname'] ?></h5><br>
      <h5  style="margin-left:5px;">Last Name : <?= $student[0]['lname'] ?></h5>
      <input type="hidden" id="std_id" value="<?= $student[0]['std_id'] ?>">
      <input type="hidden" id="fname" value="<?= $student[0]['fname'] ?>">
      <input type="hidden" id="lname" value="<?= $student[0]['lname'] ?>">
    </div>
</div>


<script>
    $(document).on('click', '#backpage', function() {
      window.history.back()
    });

    // $('#i_file').change( function(event) {
    //   var tmppath = URL.createObjectURL(event.target.files[0]);
    //   $("#vidDisplay").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
      
    //   $("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
    // });
</script>

<script>

  //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined;
  //----------------------------------------------------------------------------------------------
  $('#loadp').show();
  $("#parent1").hide();
  $("#parent2").hide();
  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('/web_project/data/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/web_project/data/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/web_project/data/models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('/web_project/data/models')
  ]).then(start)

  async function start() {
    $.ajax({
        datatype: 'json',
        url: "http://localhost/web_project/php/fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y])
              content.parent[x]._descriptors[y] = new Float32Array(results)
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        $('#loadp').hide();
        $('#parent1').show()
        $('#parent2').show()        
        run();
    });
  }

  // Create Face Matcher
  async function createFaceMatcher(data) {
    const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
      const descriptors = [];
      for (var i = 0; i < className._descriptors.length; i++) {
        descriptors.push(className._descriptors[i]);
      }
      return new faceapi.LabeledFaceDescriptors(className._label, descriptors);
    }))
    return new faceapi.FaceMatcher(labeledFaceDescriptors,0.6);
  }


  async function onPlay() {
      const videoEl = $('#vidDisplay').get(0)
      if(videoEl.paused || videoEl.ended )
        return setTimeout(() => onPlay())

        $("#overlay").show()
        const canvas = $('#overlay').get(0)
        
        if($("#fname").val() !="" && $("#fname").val() !="" && $("#std_id").val() !="")
        {
          const options = getFaceDetectorOptions()
          const result = await faceapi.detectSingleFace(videoEl, options)
          if (result) {
            const dims = faceapi.matchDimensions(canvas, videoEl, true)
            dims.height = 600
            dims.width = 800
            canvas.height = 600
            canvas.width = 800
            const resizedResult = faceapi.resizeResults(result, dims)
            faceapi.draw.drawDetections(canvas, resizedResult)  
          }     
          else{
            $("#overlay").hide()
          } 
        }
      setTimeout(() => onPlay())
    }

  async function run() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#vidDisplay').get(0)
      videoEl.srcObject = stream
  }
  
  // tiny_face_detector options
  let inputSize = 320
  let scoreThreshold = 0.5

  function getFaceDetectorOptions() {
    return  new faceapi.TinyFaceDetectorOptions({ inputSize, scoreThreshold });
  }

  async function load_neural(){
    $.ajax({
        datatype: 'json',
        url: "http://localhost/web_project/php/fetch.php",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          console.log(content)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y]);
              content.parent[x]._descriptors[y] = new Float32Array(results);
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        $('#loadp').hide();
    });
  }

</script>

<script>
  
  $(document).ready(async function(){

    var counter = 5;
    const descriptions = [];

    $("#tries").html("Trials left : " + counter)

    $("#capture").click(async function(){
      var data = $("#fname").val() + "-" + $("#std_id").val();
      const label = data;

      if(counter <= 5 && counter >= 0 ){

        //for(let i=counter-1; i>=0; i--){
          //console.log(i)
          var video = document.getElementById('vidDisplay');
          var canvas = document.createElement('canvas');
          canvas.width = 800;
          canvas.height = 600;
          var ctx = canvas.getContext('2d');
          ctx.drawImage(video, 0, 0, 800, 600);
          var new_image_url = canvas.toDataURL();
          var img = document.createElement('img');
          img.src = new_image_url;

          const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
          if( detections != null){
            descriptions.push(detections.descriptor);
            var descrip = descriptions;
            counter--;
            $("#tries").html("Trials left : " + counter)
            if(counter == 0){

              $('#loadp').show();
              var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
              $.ajax({
                  url: 'http://localhost/web_project/php/json.php',
                  type: 'POST',
                  data: { myData: JSON.stringify(postData) },
                  datatype: 'json'
              })
              .done(async function (data) {
                  load_neural()
                  console.log("Success!")
                  counter = 5
                  $("#tries").html("Trials left : " + counter)
                  Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Training',
                    showConfirmButton: true,
                    timer: '2000'
                  })
                  
              })
              .fail(function (jqXHR, textStatus, errorThrown) { 
                  alert("Error due to internet connection! Please try again!");
              });
              const descriptions = [];
            }          
          }
          else{
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'No Detect Face',
              showConfirmButton: true,
              timer: '2000'
            })
          }
        // } 
      }
      else{
        counter = 5;
        const descriptions = [];
      }
    });
  });
</script>