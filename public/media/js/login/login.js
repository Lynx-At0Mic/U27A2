let messageBox = document.getElementById('errorMessage');
let form = document.getElementById('loginForm');

function login() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText)
            if(response.valid){
                messageBox.innerText = "Logged In!";
                window.location.replace(Config.BASE_URL);
            }
            else {
                messageBox.innerText = response.error;
            }
            messageBox.classList.remove('hidden');
        }
    }

    req.open("POST", Config.BASE_URL + 'login/validateLogin');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('username=' + encodeURIComponent(form.username.value) + '&password=' + encodeURIComponent(form.password.value));
}

function getEnterKey(event){
    if(event.keyCode === 13){
        login();
    }
}