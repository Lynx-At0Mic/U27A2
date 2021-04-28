let messageBox = document.getElementById('errorMessage');
let form = document.getElementById('signupForm');

function signup() {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () =>{
        console.log(req.status);
        if (req.readyState == 4 && req.status == 200) {
            let response = JSON.parse(req.responseText)
            if(response.success){
                form.style.display = 'none';
                messageBox.innerText = "Successfully created account!";
                // window.location.replace("http://localhost/u27a2/")
            }
            else {
                messageBox.innerText = response.error;
            }
            messageBox.classList.remove('hidden');
        }
    }

    req.open("POST", 'http://localhost/u27a2/login/addUser');
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send('username=' + encodeURIComponent(form.username.value) + '&password=' + encodeURIComponent(form.password.value));
}