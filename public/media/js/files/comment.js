let textbox = document.getElementById("commentBox");
let messageBox = document.getElementById("messageBox");
let commentArea = document.getElementById("commentArea");

function loadComments(postID){
    commentArea.innerHTML = "";
    let req = new XMLHttpRequest(); // create XMLHttpRequest for AJAX
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText); // parse JSON response
            if(response.success){
                for (let comment of response.comments){
                    let commentElement = document.createElement("div");
                    commentElement.innerHTML = "<h6>By user " + comment.user + " at " + comment.time + "</h6><p>" + comment.text + "</p><hr>"
                    commentArea.appendChild(commentElement);
                }
            }
            else {
                messageBox.innerText = response.error; // put error in box
            }
        }
    }

// open request and send form data
    req.open("POST", Config.BASE_URL + 'comment/get');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('post_id=' + encodeURIComponent(postID));
}




function addComment(postID){
    let req = new XMLHttpRequest(); // create XMLHttpRequest for AJAX
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText); // parse JSON response
            if(response.success){
                messageBox.innerText = "Comment successfully added!";
                loadComments(postID);
            }
            else {
                messageBox.innerText = response.error; // put error in box
            }
        }
    }

    // open request and send form data
    req.open("POST", Config.BASE_URL + 'comment/add');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('comment=' + encodeURIComponent(textbox.value) + '&post_id=' + encodeURIComponent(postID));
}