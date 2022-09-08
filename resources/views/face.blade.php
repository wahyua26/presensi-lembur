<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=0.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Face Detector</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap');
        body{
            margin:0;
            padding:0;
            display: grid;
            font-family: 'Bree Serif', serif;
            place-content: center;
            background: #cc2b5e;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #753a88, #cc2b5e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            
        }
        video{
            display: none;
        }
        h1{
            text-align: center;
            color: white;
        }


        canvas{
            margin-top: 4%;
            display: none;
            
        }
        #btn {
            box-sizing: border-box;
            background-color: transparent;
            margin:auto;
            width: 500px;
            padding : 20px;
            border: 2px solid white;
            border-radius: 0.6em;
            color: white;
            text-align: center;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 400;
            text-decoration: none; 
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        #btn:hover, #btn:focus {
            color: #fff;
            outline: 0;
        }
        #btn:hover {
            box-shadow: 0 0 40px 40px #abaeb1 inset;
        
        }
    </style>

</head>
<link rel="stylesheet" href="../assets/css/face_detector.css">

<body>


    <h1>Face Detector   <span><i class="fa fa-camera" style="font-size:50px;color:white;"></i></span>
    </h1>
    <button id="btn">Open Webcam</button>
    <video id="video" autoplay></video>
    <canvas id="canvas" width="600px" height="400px"></canvas>


    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface"></script>
    <script defer src="../assets/js/face_detector.js"></script>


</body>

<script>
    let video = document.getElementById("video");
    let model;
    let canvas = document.getElementById("canvas");
    let ctx = canvas.getContext("2d");

    const setUpCamera = () => {
    navigator.mediaDevices.getUserMedia({
        video: { width: 600, height: 400 },
        audio: false,
    }).then(stream => {
        video.srcObject = stream;
    })
    }

    const detectFaces = async () => {
    const prediction = await model.estimateFaces(video, false);
    ctx.drawImage(video, 0, 0, 600, 400)
    prediction.forEach((e) => {
        ctx.beginPath();
        ctx.lineWidth = "4";
        ctx.strokeStyle = "purple"
        ctx.rect(
        e.topLeft[0],
        e.topLeft[1],
        e.bottomRight[0] - e.topLeft[0],
        e.bottomRight[1] - e.topLeft[1]

        );
        ctx.stroke();
        ctx.fillStyle = "#d24";
        e.landmarks.forEach((landmark) => {
        ctx.fillRect(landmark[0], landmark[1], 5, 5);
        }
        );
    })
    }
    document.getElementById("btn").addEventListener("click", () => {
    if (document.getElementById("btn").innerHTML == "Close Webcam") {
        canvas.style.display = "none";
        const mediaStream = video.srcObject;
        const tracks = mediaStream.getTracks();
        tracks.forEach(track => track.stop())
        document.getElementById("btn").innerHTML = "Open Webcam";
    }
    else if (document.getElementById("btn").innerHTML == "Open Webcam") {
        document.getElementById("btn").innerText = "Wait for a few seconds...";
        setUpCamera();
        video.addEventListener("loadeddata", async () => {
        canvas.style.display = "block";
        model = await blazeface.load();
        
        setInterval(detectFaces, 40);
        await sleep(1000);
        console.log("hello again");
        document.getElementById("btn").innerText = "Close Webcam";
        })
        
    }
    });
    const sleep = (milliseconds) => {
    console.log("sleep for 100 sec in case of slow system");
    return new Promise(resolve => setTimeout(resolve, milliseconds))
    }
</script>
</html>