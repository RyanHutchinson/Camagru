<div class="container" style="padding-top: 50px; padding-bottom: 50px">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 newPost">
            <div class="feed">
                <video id="video" width="640" height="480" autoplay></video>
            </div>
            <div class="col-lg-6 col-lg-offset-3">
                <div class="col-lg-5">
                    <button id="snap">Snap Photo</button>
                </div>
                <div class="col-lg-2">
                    <p style="padding-top: 20px">or</p>
                </div>
                <div class="col-lg-5">
                    <form style="padding-top: 15px" method="post" enctype="multipart/form-data">
                        <input id="fileToUpload" type="file" name="fileToUpload">
                        <input id="upload" type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
            <div class="feed">
                <canvas id="canvas" width="640" height="480"></canvas>
            </div>
        </div>
    </div>
</div>
<?php NewPost::Javascript()?>