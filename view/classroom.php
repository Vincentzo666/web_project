<?php

if (!isset($_SESSION['id_teacher'])) {

  $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
  echo "<script>window.location.href='auth/login.php';</script>";
  exit;
}

if(isset($_GET['subid'])){

  $subid = $_GET['subid'];

}else{

  $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบข้อมูล!";
  echo "<script> window.history.back()</script>";
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

<div id="parent1" style="display:flex;background-color:#f0f8ff;min-height:740px;">
  <div class="margin" style="position: relative; float:center; margin: 50px; ">
    <video id="vidDisplay" style="width: 800px; height: 600px; display: inline-block; vertical-align: baseline; border: 3px solid black;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
    <canvas id="overlay" style="position: absolute; top: 0; left: 0;" width="800" height="600" />
  </div>

  <div id="parent2" style="margin:50px 0 0 25px;" class="col-sm-4">
    <div class="text-end">
      <a class="btn btn-warning" id="backpage"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
    </div><br>
    <button id="statusss" class="btn btn-success btn-md ssstart">Start Classroom</button><br><br>
    <div style="display:flex;">
      <div style="width:105px;">
        <img id="prof_img" style="height:100px; width: 100px; border: 1px solid black; border-radius: 10px;object-fit:cover;"></img>
      </div>
      <div style="width:400px;padding-top:30px;">
        <h4 id="log_name" style="margin-left:20px;height:40px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"></h4>
      </div>
      <input type="hidden" id="subid" value="<?= $subid ?>">
      <input type="hidden" id="last_id" >
    </div>
  </div>
</div>

<script>
  function callssstart() {

    $("#statusss").removeClass("ssstart btn-success")
    $("#statusss").addClass("ssstop btn-danger")
    $("#statusss").html('Stop Classroom');

    var subid = $("#subid").val();

    $.ajax({
      type: "POST",
      url: "http://localhost/web_project/php/ajax.php",
      data: {
        timestart: '<?= $date ?>',
        subid:subid
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          console.log("yess cr");
          $("#last_id").val(jsonData.last_id)
        }
      }
    });

  };

  function callssstop() {
    $("#statusss").removeClass("ssstop btn-danger")
    $("#statusss").addClass("ssstart btn-success")
    $("#statusss").html('Start Classroom');

    var last_id = $("#last_id").val();

    $.ajax({
      type: "POST",
      url: "http://localhost/web_project/php/ajax.php",
      data: {
        timestop: '<?= $date ?>',
        thisid: last_id
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if(jsonData.success == "1") {
          console.log("yess up");
        }
      }
    });

  };

  $(document).on('click', '#backpage', function() {
    window.history.back()
  });

  var canClick = true;
  $("#statusss").click(function() {
    if (canClick) {
      canClick = false;
      if ($("#statusss").hasClass('ssstart')) {
        callssstart();
      } else if ($("#statusss").hasClass('ssstop')) {
        callssstop();
      }
      setTimeout(() => {
        canClick = true
      }, 5000);
    }
  });
</script>

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

  //var dataFetch = undefined;
  var dataFetch = undefined;
  //asyncCall();
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
        const drawBox = new faceapi.draw.DrawBox(box, {
          label: result.toString()
        })
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
                var subid = $("#subid").val();
                $.ajax({
                  type: "POST",
                  url: "http://localhost/web_project/php/ajax.php",
                  data: {
                    std_checkin: dtf[index].std_id,
                    sub_checkin: subid,
                    time_checkin: '<?= $date ?>'
                  },
                  success: function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {

                      // $('#result1').attr("src", "upload/img_student/" + jsonData.result1);
                      // $('#result2').html(jsonData.result2);

                    }
                  }
                });
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