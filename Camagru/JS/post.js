function addLike(postID){
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/camagru/Camagru/addLike', true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
        {
            document.getElementById('likeButton').innerText = xhr.responseText;
        }
    }
    xhr.send('postID=' + postID);
}