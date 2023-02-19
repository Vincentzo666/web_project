<?php

if (!isset($_SESSION['id_teacher'])) {

  $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
  echo "<script>window.location.href='auth/login.php';</script>";
  exit;
}

?>
<style>
  .spinner-wrapper {
    background-color: #000;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .spinner-border {
    height: 60px;
    width: 60px;
  }
</style>

<div class="spinner-wrapper text-primary" id="loadp">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  &nbsp;<h4>&nbsp;Loading...</h4>
</div>

<div id="parent1">
  <div class="margin" style="position: relative; float:center; margin: 50px; ">
    <video id="vidDisplay" style="width: 800px; height: 600px; display: inline-block; vertical-align: baseline; border: 3px solid black;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
    <canvas id="overlay" style="position: absolute; top: 0; left: 0;" width="800" height="600" />
  </div>

  <div id="parent2" style="float:left;">
    <a class="btn btn-warning ms-5" id="backpage"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
    <br><br>
    <img id="prof_img" style="margin-left: 210px; height:200px; width: 200px; border: 3px solid black; border-radius: 10px;object-fit:cover;"></img><br><br>
    <div id="log_name" style="font-size: 35px; font-weight: bold; margin-left: 40px; width: 570px; white-space: pre-wrap; text-align: center;object-fit:cover;"></div><br>
    <div style="margin-left: 40px; width: 570px; border: 3px solid black;"></div><br>
  </div>
</div>

<script>
  //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined
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
      if (data.length > 2) {
        var json_str = "{\"parent\":" + data + "}"
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
      $('#parent1').show();
      $('#parent2').show();
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
      lalabel = className._label;
      return new faceapi.LabeledFaceDescriptors(lalabel, descriptors);
    }))
    return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
  }

  //var dataFetch = undefined;

  function dtfetch() {
    var resultt = $.ajax({
      datatype: 'json',
      url: "http://localhost/web_project/php/fetch.php",
      data: ""
    }).done(function(data) {
      console.log('fetch success');
    });

    return resultt;
  }

  // async function jparse(data) {
  //   return dataFetch = JSON.parse(data);
  // }

  // async function asyncCall() {
  //   console.log('calling');
  //   console.log( await dtfetch());
  //   // var result = await dtfetch();
  //   // console.log(result);
  // }

  //asyncCall();
  var dataFetch = undefined;

  async function onPlay() {

    if (dataFetch == undefined) {
      dataFetch = await dtfetch();
    }
    var dtf = JSON.parse(dataFetch);

    const videoEl = $('#vidDisplay').get(0)
    if (videoEl.paused || videoEl.ended)
      return setTimeout(() => onPlay())

    $("#overlay").show()
    const canvas = $('#overlay').get(0)

    if (faceMatcher != undefined) {
      //--------------------------FACE RECOGNIZE------------------
      const input = document.getElementById('vidDisplay')
      const displaySize = {
        width: 800,
        height: 600
      }
      faceapi.matchDimensions(canvas, displaySize)
      // const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
      // const resizedDetections = faceapi.resizeResults(detections, displaySize)
      // const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
      // results.forEach((result, i) => {
      //   const box = resizedDetections[i].detection.box
      //   const drawBox = new faceapi.draw.DrawBox(box, {
      //     label: result.toString()
      //   })
      //   drawBox.draw(canvas)
      //   console.log(result.toString())
      //   var str = result.toString()
      //   rating = parseFloat(str.substring(str.indexOf('(') + 1, str.indexOf(')')))
      //   str = str.substring(0, str.indexOf('('))
      //   str = str.substring(0, str.length - 1)
      //   console.log(rating)
      //   console.log(str)

      //   if (str != "unknown") {
      //     if (rating > 0.5) {
      //       console.log("Match TRUE!")
      //       dtf.filter(function(item, index) {
      //         if (item._label == str) {
      //           $("#prof_img").attr('src', dtf[index].imgpath);
      //         }
      //       });
      //       $("#log_name").html(str)

      //     }
      //   }
      // })

      const detection = await faceapi.detectSingleFace(input).withFaceLandmarks().withFaceDescriptor()
      const resizedDetections = faceapi.resizeResults(detection, displaySize)
      const result = faceMatcher.findBestMatch(detection.descriptor)

      if (result) {
        
        const box = resizedDetections.detection.box
        const drawBox = new faceapi.draw.DrawBox(box, {label: result.toString()})
        drawBox.draw(canvas)
        console.log(result.toString())
        var str = result.toString()
        rating = parseFloat(str.substring(str.indexOf('(') + 1, str.indexOf(')')))
        str = str.substring(0, str.indexOf('('))
        str = str.substring(0, str.length - 1)

        if (str != "unknown") {
          if (rating > 0.5) {
            console.log("Match TRUE!")
            dtf.filter(function(item, index) {
              if (item._label == str) {
                $("#prof_img").attr('src', dtf[index].imgpath);
              }
            });
            $("#log_name").html(str)

          }
        }
      }
    }

    setTimeout(() => onPlay())
  }

  async function run() {
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {}
    })
    const videoEl = $('#vidDisplay').get(0)
    videoEl.srcObject = stream
  }
</script>