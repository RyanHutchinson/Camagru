<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <ul id='postFeed'>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- TODO: everything -->












































<script>
    var listElm = document.querySelector('#postFeed');

    // Add 20 items.
    var nextItem = 1;
    var loadMore = function() {

        /*
        TODO: This posts should end up being an array of fully formed posts with html tags et al.
        var posts = ?PHP Home::allPosts();?>
        */
        for (var i = 0; i < 20; i++) {
            var item = document.createElement('li');
            // The line below should be changed to insert the next index of the array passed in above.
            item.innerText = 'Item ' + nextItem++;
            listElm.appendChild(item);
        }
    }

    // Detect when scrolled to bottom.
    listElm.addEventListener('scroll', function() {
    if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
        loadMore();
    }
    });

    // Initially load some items.
    loadMore();
</script>

<!--  -->