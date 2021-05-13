

function logout(){
    let req = new XMLHttpRequest(); // create AJAX XMLHttpRequest to logout.php and reload page
    req.onreadystatechange = () =>{
        if (req.readyState == 4 && req.status == 200) {
            window.location.reload(true);
        }
    }
    req.open("POST", Config.BASE_URL + 'login/logout');
    req.send();
}