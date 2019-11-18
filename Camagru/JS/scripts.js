var listElm = document.querySelector('#postFeedContainer');
var feed = document.getElementById("postFeed");

    // Add 20 items.
    var nextItem = 0;
    var loadMore = function() {

        /*
        TODO: This posts should end up being an array of fully formed posts with html tags et al.
        var posts = ?PHP Home::allPosts();?>
        */
            // var item = document.createElement('li');
            // The line below should be changed to insert the next index of the array passed in above.
            let request = new XMLHttpRequest();
            request.open('GET', '/camagru/Camagru/getPost?postId=' + nextItem , true);
            request.onreadystatechange = function(){
                if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {
                    // console.log(request.responseText);
                    feed.style.minHeight = feed.offsetHeight + "px";
                    feed.innerHTML += request.responseText;
                    nextItem++;
                };
            }
            // listElm.style.minHeight = listElm.height;
            request.send();
            
            // item.innerText = 'stuff ' + nextItem;
            // listElm.appendChild(item);
    }
    // Detect when scrolled to bottom.
    listElm.addEventListener('scroll', function() {
    if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
        loadMore();
    }
    });

    // Initially load some items.
    loadMore();



    /**The below is for the sticky menu stuff which is kinda broken now*/
    // window.onscroll = function() {myFunction()};

    // var header = document.getElementById("myHeader");
    // var sticky = header.offsetTop;

    // function myFunction() {
    //   if (window.pageYOffset > sticky) {
    //     header.classList.add("sticky");
    //   } else {
    //     header.classList.remove("sticky");
    //   }
    //}