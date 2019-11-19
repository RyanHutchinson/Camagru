<div class="content" style="padding-top: 5px">
    <div class="profileWrapper">
        <div class="">
            <?php Profile::loadProfile($_SESSION['user']);?>
        </div>
    </div>
    <hr style="margin-top: 7px; margin-bottom: 3px">
    <div class="container" style="width: 100%; padding: 0;">
        <div class="row" style="margin: 0">
            <div class="col-lg-12" style="padding: 0">
                <div id='postFeedContainer' style="padding-top: 2px" class="">
                    <ul id='postFeed'>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=PROFILE_JAVASCRIPT_PATH?>"></script>