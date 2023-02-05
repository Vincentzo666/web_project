<html>
<head>
	<title>Webcam with Face Detection</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tracking.js/2.0.0/tracking.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tracking.js/2.0.0/data/face-min.js"></script>
</head>
<body>
	<div id="video_container">
		<video id="video" width="640" height="480" autoplay></video>
		<canvas id="canvas" width="640" height="480"></canvas>
	</div>
	<script type="text/javascript">
		// Get the video and canvas elements
		var video = document.getElementById('video');
		var canvas = document.getElementById('canvas');
		var context = canvas.getContext('2d');

		// Get the user's camera
		navigator.mediaDevices.getUserMedia({video: true})
			.then(function(stream) {
				video.srcObject = stream;

				// Start face tracking
				var tracker = new tracking.ObjectTracker("face");
				tracker.setInitialScale(4);
				tracker.setStepSize(2);
				tracker.setEdgesDensity(0.1);
				tracking.track("#video", tracker, { camera: true });
				tracker.on("track", function(event) {
					// Clear the canvas
					context.clearRect(0, 0, canvas.width, canvas.height);

					// Draw rectangles around faces
					event.data.forEach(function(rect) {
						context.strokeStyle = "#111111";
						context.strokeRect(rect.x, rect.y, rect.width, rect.height);
					});
				});
			})
			.catch(function(error) {
				console.log("Error opening camera:", error);
			});
	</script>
</body>
</html>
