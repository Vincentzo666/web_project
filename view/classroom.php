<?php

if (!isset($_SESSION['id_teacher'])) {

  $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
  echo "<script>window.location.href='auth/login.php';</script>";
  exit;
}

if (isset($_GET['subid'])) {

  $subid = $_GET['subid'];
} else {

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

<!-- <div class="spinner-wrapper text-primary" id="loadp">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  &nbsp;<h4>&nbsp;Loading...</h4>
</div> -->

<div id="parent1" style="display:flex;background-color:#f0f8ff;min-height:740px;">
  <div class="margin" style="position: relative; float:center; margin: 50px 0px 0px 30px;">
    <video id="vidDisplay" style="width: 800px; height: 600px; display: inline-block; 
    vertical-align: baseline; border: 3px solid black;" autoplay="true"></video>
    <canvas id="overlay" style="position: absolute; top: 0; left: 0;" width="800" height="600" />
  </div>

  <div id="parent2" style="margin:50px 0 0 30px;" class="col-sm-5">
    <div class="text-end me-5">
      <a class="btn btn-warning" id="backpage"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
    </div><br>
    <div style="display:inline-flex;">
      <button id="statusss" class="btn btn-success btn-md ssstart">Start Classroom</button>
      <h4 id="timer" class="ms-4 "></h4>
    </div><br><br>
    <div style="display:flex;">
      <div style="width:105px;">
        <img id="prof_img" style="height:70px; width: 70px; border: 1px solid black; border-radius: 10px;object-fit:cover;"></img>
      </div>
      <div style="width:400px;padding-top:17px;">
        <h5 id="log_name" style="height:40px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"></h5>
      </div>
      <input type="hidden" id="subid" value="<?= $subid ?>">
      <input type="hidden" id="last_id">
    </div><br>
    <table class="table user-list" id="checkinTable">
      <thead>
        <tr>
          <th style="width:25%;"><span>Student ID</span></th>
          <th style="width:15%;"><span>คำนำหน้า</span></th>
          <th style="width:30%;"><span>ชื่อ</span></th>
          <th style="width:30%;"><span>นามสกุล</span></th>
        </tr>
      </thead>
      <tr id="exerow">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#checkinTable').DataTable();
  });

  var totalSeconds = 0;

  function countTimer() {
    ++totalSeconds;
    var hour = Math.floor(totalSeconds / 3600);
    var minute = Math.floor((totalSeconds - hour * 3600) / 60);
    var seconds = totalSeconds - (hour * 3600 + minute * 60);
    if (hour < 10)
      hour = "0" + hour;
    if (minute < 10)
      minute = "0" + minute;
    if (seconds < 10)
      seconds = "0" + seconds;
    document.getElementById("timer").innerHTML = hour + ":" + minute + ":" + seconds;
  }

  function callssstart() {

    $("#statusss").removeClass("ssstart btn-success")
    $("#statusss").addClass("ssstop btn-danger")
    $("#statusss").html('Stop Classroom');

    callagain = true;
    onPlay();
    //myTimeout = setInterval(()=>onPlay());
    var subid = $("#subid").val();


    $.ajax({
      type: "POST",
      url: "http://localhost/web_project/php/ajax.php",
      data: {
        timestart: '<?= $date ?>',
        subid: subid
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          console.log("yess cr");
          $("#last_id").val(jsonData.last_id);
          totalSeconds = 0;
          timerVar = setInterval(countTimer, 1000);
        }
      }
    });

  };

  function callssstop() {

    $("#statusss").removeClass("ssstop btn-danger")
    $("#statusss").addClass("ssstart btn-success")
    $("#statusss").html('Start Classroom');

    callagain = false;
    clearInterval(timerVar);
    //clearInterval(myTimeout);

    var last_id = $("#last_id").val();
    var totaltime = $("#timer").text();
    $.ajax({
      type: "POST",
      url: "http://localhost/web_project/php/ajax.php",
      data: {
        timestop: '<?= $date ?>',
        thisid: last_id,
        totaltime: totaltime
      },
      success: function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          console.log("yess up");
        }
      }
    });

  };

  var canClick = true;
  var callagain = true;

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

  $(document).on('click', '#backpage', function() {
    window.history.back()
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
    // if (videoEl.paused || videoEl.ended){
    //   return myTimeout = setTimeout(() => onPlay())
    // }
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
      const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
      const resizedDetections = faceapi.resizeResults(detections, displaySize)
      const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
      results.forEach((result, i) => {
        const box = resizedDetections[i].detection.box
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
          if (rating > 0.35) {
            console.log("Match TRUE!")
            dtf.filter(function(item, index) {
              if (item._label == str) {
                $("#prof_img").attr('src', dtf[index].imgpath);
                var subid = $("#subid").val();
                var last_id = $("#last_id").val();
                $.ajax({
                  type: "POST",
                  url: "http://localhost/web_project/php/ajax.php",
                  data: {
                    cr_checkin: last_id,
                    std_checkin: dtf[index].std_id,
                    sub_checkin: subid,
                    time_checkin: '<?= $date ?>'
                  },
                  success: function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                      $('#exerow').remove();
                      $('#checkinTable').append(`<tr><td>${jsonData.resultck1}</td><td>${jsonData.resultck2}</td><td>${jsonData.resultck3}</td><td>${jsonData.resultck4}</td></tr>`);

                      // $('#result1').attr("src", "upload/img_student/" + jsonData.result1);
                      // $('#result2').html(jsonData.result2);

                    }
                  }
                });
              }
            });
            $("#log_name").html(str);
          }
        }
      });

      // const detection = await faceapi.detectSingleFace(input).withFaceLandmarks().withFaceDescriptor()
      // const resizedDetection = faceapi.resizeResults(detection, displaySize)
      // const result = faceMatcher.findBestMatch(detection.descriptor)

      // if (result) {

      //   const box = resizedDetection.detection.box
      //   const drawBox = new faceapi.draw.DrawBox(box, {
      //     label: result.toString()
      //   })
      //   drawBox.draw(canvas)
      //   console.log(result.toString())
      //   var str = result.toString()
      //   rating = parseFloat(str.substring(str.indexOf('(') + 1, str.indexOf(')')))
      //   str = str.substring(0, str.indexOf('('))
      //   str = str.substring(0, str.length - 1)

      //   if (str != "unknown") {
      //     if (rating > 0.5) {
      //       console.log("Match TRUE!")
      //       dtf.filter(function(item, index) {
      //         if (item._label == str) {
      //           $("#prof_img").attr('src', dtf[index].imgpath);
      //           var subid = $("#subid").val();
      //           var last_id = $("#last_id").val();
      //           $.ajax({
      //             type: "POST",
      //             url: "http://localhost/web_project/php/ajax.php",
      //             data: {
      //               cr_checkin: last_id,
      //               std_checkin: dtf[index].std_id,
      //               sub_checkin: subid,
      //               time_checkin: '<?= $date ?>'
      //             },
      //             success: function(response) {
      //               var jsonData = JSON.parse(response);
      //               if (jsonData.success == "1") {
      //                 console.log(jsonData.resultck);
      //                 // $('#result1').attr("src", "upload/img_student/" + jsonData.result1);
      //                 // $('#result2').html(jsonData.result2);

      //               }
      //             }
      //           });
      //         }
      //       });
      //       $("#log_name").html(str)

      //     }
      //   }
      // }
    }

    if (callagain) {
      setTimeout(() => onPlay());
    } else {
      $("#overlay").hide()
    }
  }

  async function run() {
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {}
    })
    const videoEl = $('#vidDisplay').get(0)
    videoEl.srcObject = stream
  }
</script>