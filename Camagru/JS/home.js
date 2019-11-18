var listElm = document.querySelector('#postFeedContainer');
var feed = document.getElementById("postFeed");
var nextItem = 0;
var loadMore = function() {
    let request = new XMLHttpRequest();
    request.open('GET', '/camagru/Camagru/getPost?postId=' + nextItem , true);
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
// }