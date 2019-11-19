var listElm = document.querySelector('#postFeedContainer');
var feed = document.getElementById("postFeed");
var nextItem = 0;
var loadMore = function() {
    let request = new XMLHttpRequest();
    request.open('GET', '/camagru/Camagru/getPost?postId=' + nextItem + '&Location=' + window.location.pathname, true);
    request.onreadystatechange = function(){
        if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            feed.style.minHeight = feed.offsetHeight + "px";
            feed.innerHTML += request.responseText;
            nextItem++;
        };
    }
    request.send();
}
// Detect when scrolled to bottom.
listElm.addEventListener('scroll', function() {
    if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
        loadMore();
    }
});
// Initially load some items.
loadMore();
//button redirect.
function postRedirect(postID){
    window.location = window.location.href + 'Post?postid=' + postID;
}
