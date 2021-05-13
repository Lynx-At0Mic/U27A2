let messageBox = document.getElementById('errorMessage');
let form = document.getElementById('loginForm');

function login() {
    let req = new XMLHttpRequest(); // create XMLHttpRequest for AJAX
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText); // parse JSON response
            if(response.valid){
                messageBox.innerText = "Logged In!";
                window.location.replace(Config.BASE_URL); // redirect to home page
            }
            else {
                messageBox.innerText = response.error; // put error in box
            }
            messageBox.classList.remove('hidden');
        }
    }

    // open request and send form data
    req.open("POST", Config.BASE_URL + 'login/validateLogin');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('username=' + encodeURIComponent(form.username.value) + '&password=' + encodeURIComponent(form.password.value));
}

function getEnterKey(event){ // on enter key press
    if(event.keyCode === 13){
        login();
    }
}