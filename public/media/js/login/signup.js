let messageBox = document.getElementById('errorMessage');
let form = document.getElementById('signupForm');

function signup() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText)
            if(response.success){
                form.style.display = 'none';
                messageBox.innerHTML = "Successfully created account!<br><a href='" + Config.BASE_URL + "login'>Click here to login</a>";
            }
            else {
                messageBox.innerText = response.error;
            }
            messageBox.classList.remove('hidden');
        }
    }

    req.open("POST", Config.BASE_URL + 'login/addUser');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('username=' + encodeURIComponent(form.username.value) + '&password=' + encodeURIComponent(form.password.value));
}

function getEnterKey(event){
    if(event.keyCode === 13){
        login();
    }
}