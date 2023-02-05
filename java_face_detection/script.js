const video = document.getElementById('webcamVideo')

function startVideo(){
    navigator.getUserMedia(
        {video:{}},
        steam => video.srcObject = stream,
        err => console.error(err)
    )
}

startVideo