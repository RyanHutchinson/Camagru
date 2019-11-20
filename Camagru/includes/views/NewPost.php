<div class="container" style="padding-top: 50px; padding-bottom: 100px">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 newPost">
			<div class="feed col-lg-12">
				<video id="video" width="340" height="260" autoplay></video>
			</div>
			<div style="text-align: center; margin-bottom: 20px">
				<p style="font-size: 10px">Please snap a photo or upload one of your own!</p>
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
						<div class="canvas" id="canvasDiv" style="margin-bottom: 15px; display:none">
							<canvas id="canvas" name="canvas" width="340" height="260"></canvas>
							<!-- <canvas id="blank" style="display: hidden"></canvas> -->
							<input id="hidden" name ="hidden" type="hidden">
						</div>
						<div id="snapPrompt">
							<h1>Please snap or upload a pic above!</h1>
						</div>
						<div id="stickerBlock" style="display: none">
						<hr>
							<div style="text-align: center; margin-bottom: 20px">
								<p style="font-size: 10px">Please select at least one of the stickers below!</p>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<img class="sticker" onclick="addSticker('<?php echo IMG_ROUTE . 'ufo.png'?>', 1)" width="75" height="75" src="<?php echo IMG_ROUTE . 'ufo.png'?>" alt="sticker 1">
								</div>
								<div class="col-lg-4">
									<img class="sticker" onclick="addSticker('<?php echo IMG_ROUTE . 'falling-star.png'?>', 2)" width="75" height="75" src="<?php echo IMG_ROUTE . 'falling-star.png'?>" alt="sticker 2">
								</div>
								<div class="col-lg-4">
									<img class="sticker" onclick="addSticker('<?php echo IMG_ROUTE . 'mars.png'?>', 3)" width="75" height="75" src="<?php echo IMG_ROUTE . 'mars.png'?>" alt="sticker 3">
								</div>
							</div>
						</div>
						<hr>
						<div id="titleTextArea" style="display: none">
							<p style="font-size: 10px">Please write a title below!</p>
							<textarea name="Caption" rows="2" cols="45" minlength= "1" maxlength="50" placeholder="Title of 50 characters..."></textarea>
						</div>
						<button style="display:none" type="submit" name="Post" id="postButton" value="OK">Post</button>
						<?php if(isset($_POST['Post'])) NewPost::savePost();?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?=NEWPOST_JAVASCRIPT_PATH?>"></script>