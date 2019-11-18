<div class="container" style="padding-top: 50px; padding-bottom: 100px">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 newPost">
            <div class="feed col-lg-12">
                <video id="video" width="340" height="260" autoplay></video>
            </div>
            <div class="col-lg-6 col-lg-offset-3">
                <div class="col-lg-5">
                    <button id="snap">Snap Photo</button>
                </div>
                <div class="col-lg-2">
                    <p style="padding-top: 20px">or</p>
                </div>
                <div class="col-lg-5" style="padding-top: 15px">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="imageLoader" id="imageLoader">
                </form>
                </div>
            </div>
            <div class="feed col-lg-12">
                <hr>
                <div class="comment">
                    <form id="post" name="post" method="post">
                        <div class="canvas" style="margin-bottom: 15px">
                            <canvas id="canvas" name="canvas" width="340" height="260"></canvas>
                            <input id="hidden" name ="hidden" type="hidden">
                        </div>
                        <div>
                            <textarea name="Caption" rows="2" cols="45" maxlength="50" placeholder="Title of 50 characters..."></textarea>
                        </div>
                        <button type="submit" name="Post" id="post" value="OK">Post</button>
                        <?php if(isset($_POST['Post'])) NewPost::savePost();?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php NewPost::LoadJavaScript()?>