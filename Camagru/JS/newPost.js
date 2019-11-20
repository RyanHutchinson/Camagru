// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}
// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 340, 260);
    document.getElementById('canvasDiv').style.display="";
    document.getElementById('stickerBlock').style.display="";
    document.getElementById('snapPrompt').style.display="none";
});

// Element for Uploading to canvas
var imageLoader = document.getElementById('imageLoader');

// Function to diplay the image on canvas
imageLoader.addEventListener('change', handleImage, false);

function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            context.drawImage(img,0,0, 340, 260);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
    document.getElementById('canvasDiv').style.display="";
    document.getElementById('stickerBlock').style.display="";
    document.getElementById('snapPrompt').style.display="none";
}

document.getElementById('post').addEventListener('click', function(e){
    document.getElementById('hidden').value = canvas.toDataURL('image/png');
});

function addSticker(imgSRC, imgPosition){
    console.log(imgSRC);
    var image = new Image();
    image.src = imgSRC;
    if(imgPosition == 1){
        image.onload = function(){
            context.drawImage(image,10,10, 50, 50);
        }
    }else if(imgPosition == 2){
        image.onload = function(){
            context.drawImage(image,145,10, 50, 50);
        }
    }else if(imgPosition == 3){
        image.onload = function(){
            context.drawImage(image,280,10, 50, 50);
        }
    }
    document.getElementById('titleTextArea').style.display="";
    document.getElementById('postButton').style.display="";
}

function test(){
    alert('stuff?');
}