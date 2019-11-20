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

function makethedeletefornowremovemelater(postID)
{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/camagru/Camagru/getPost', true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            alert(xhr.responseText);
            window.location.reload();
        }
    }
    xhr.send('method=Delete&postID=' + postID);
}