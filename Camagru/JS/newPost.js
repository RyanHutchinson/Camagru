// Grab elements, create settings, etc.
var video = document.getElementById('video');

try {
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({ video: true, audio: false }).then(function(stream) {
            //video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
            video.play();
        });
    }
    console.log("eh?");
} catch (error) {
    console.log(error);
}
// Get access to the camera!
// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var canvas_hidden = document.getElementById('canvas-hidden');
var context = canvas.getContext('2d');
var context_hidden = canvas_hidden.getContext('2d');
var video = document.getElementById('video');

let newForm = new FormData();

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 340, 260);
    context_hidden.drawImage(video, 0, 0, 340, 260);
    document.getElementById('canvasDiv').style.display="";
    document.getElementById('stickerBlock').style.display="";
    document.getElementById('snapPrompt').style.display="none";
    document.getElementById('titleTextArea').style.display="";
    document.getElementById('postButton').style.display="";
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
            context_hidden.drawImage(img, 0, 0, 340, 260);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

document.getElementById('postButton').addEventListener('click', function(e){
    document.getElementById('hidden').value = canvas_hidden.toDataURL('image/png');
    newForm.forEach((v,k) => {
    let ogForm = document.getElementById('post');
        ogForm.innerHTML += "<input type='hidden' id='" + k + "' name='" + k + "' value='" + v + "'>";
    });
});

function addToForm(key, value)
{
    if (newForm.has(key))
        newForm.set(key, value);
    else
        newForm.append(key, value);
}

function addSticker(imgSRC, imgPosition){
    console.log(imgSRC);
    var image = new Image();
    image.src = imgSRC;
    if(imgPosition == 1){
        addToForm("stick-1", "true")
        image.onload = function(){
            context.drawImage(image,10,10, 50, 50);
        }
    }else if(imgPosition == 2){
        addToForm("stick-2", "true");
        image.onload = function(){
            context.drawImage(image,145,10, 50, 50);
        }
    }else if(imgPosition == 3){
        addToForm("stick-3", "true");
        image.onload = function(){
            context.drawImage(image,280,10, 50, 50);
        }
    }
}
