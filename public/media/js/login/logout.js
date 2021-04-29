

function logout(){
    let req = new XMLHttpRequest();
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            window.location.reload(true);
        }
    }
    req.open("POST", Config.BASE_URL + 'login/logout');
    req.send();
}