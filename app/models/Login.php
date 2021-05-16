<?php


class Login extends Model
{
    function getUserID($username){ // utility function to grab user id from username
        $result = $this->query("SELECT account_id FROM login WHERE username = '$username'");
        if($result === false){ // if database returned an error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        if($this->get_num_rows() === 0){ // if no user with specified username found
            $this->error = Util::errorOut("User invalid, Username $username Number of rows: " . $this->get_num_rows());
            return false;
        }
        $userID = $result['account_id']; // result contains user id in assoc array
        $this->free_result();
        return $userID;
    }

    function getAccessLevel($userID){
        $result = $this->query("SELECT access_level FROM login WHERE account_id = '$userID'");
        if($result === false){ // if database returned an error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        if($this->get_num_rows() === 0){ // if no user with specified username found
            $this->error = Util::errorOut("User invalid, UserID: $userID Number of rows: " . $this->get_num_rows());
            return false;
        }
        $accessLvl = $result['access_level']; // result contains user id in assoc array
        $this->free_result();
        return $accessLvl;

    }

    function signUpUser($username, $password){ // adds a new user to the database
        $username = trim($username); // remove trailing whitespace
        $password = trim($password);

        if($username === '' or $password === ''){
            $this->error = Util::errorOut("Username and password blank username[$username], password[$password]", 'Invalid username/password');
            return false;
        }
        $result = $this->query("SELECT username FROM login WHERE username = '$username'"); // check for existing users with same username
        if($result === false){ // if database returned an error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        if($this->get_num_rows() > 0){ // if a user with same username found
            $this->error = Util::errorOut("Username already in use $username", 'Username is already in use');
            return false;
        }
        $this->free_result();

        $salt = md5($username); // create additional salt for password hash
        $hash = password_hash($password . $salt, PASSWORD_DEFAULT); // hash password, this also adds salt
        if(!$this->query("INSERT INTO login (username, pwd_hash, hash_salt) VALUES ('$username', '$hash', '$salt')")){ // insert new user into the database
            $this->error  = Util::errorOut($this->get_error());
            return false;
        }
        else{
            return true;
        }
    }

    function validateLogin($userID, $password){ // validate userID and password combination
        // get validation information from database
        $result = $this->query("SELECT pwd_hash, hash_salt, access_token FROM login WHERE account_id='$userID'");
        if($result === false){ // if database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        // if no rows returned (No user with userID in database)
        if($this->get_num_rows() == 0){ // if no account with specified username found
            $this->error = Util::errorOut('Login invalid, Number of rows: ' . $this->get_num_rows(), Util::$LoginInvalidMessage);
            $this->free_result();
            return false;
        }
        $hash = $result['pwd_hash'];
        $salt = $result['hash_salt'];
        $token = $result['access_token'];
        $this->free_result();

        // if password passes verification
        if(password_verify($password . $salt, $hash)){
            if($token === ""){ // if no access token present in the database
                $token = $this->generateAccessToken($userID); // generate access token
                if(!$token){ // on error
                    $this->error = Util::errorOut("Failed to generate token for userID $userID");
                    return false;
                }
                // insert token into database if it's not already there
                if(!$this->query("UPDATE login SET access_token='$token' WHERE account_id='$userID'")){
                    $this->error = Util::errorOut("Error adding access token to database " . $this->get_error());
                    return false;
                }
            }
            $_SESSION['token'] = $token; // set session token
            $_SESSION['access_level'] = $this->getAccessLevel($userID);
//            echo "set session token to $token";
            return true;
        }
        $this->error = Util::errorOut("Login invalid, login failed all validation checks\nUserID: $userID Password: $password\nHash:$hash\nSalt:$salt", Util::$LoginInvalidMessage);
        return false;
    }

    function validateAccessToken($userID, $token){ // validate access token with userID
        // get access token that corresponds to userID
        $result = $this->query("SELECT access_token FROM login WHERE account_id='$userID'");
        if($result === false){ // on database error
            $this->error = Util::errorOut("Database error! " . $this->get_error());
            return false;
        }
        // if no rows returned (No user with userID)
        if($this->get_num_rows() === 0){
            $this->free_result();
            $this->error = Util::errorOut("Access token invalid, could not find user. UserID: $userID Token: $token", Util::$LoginInvalidMessage);
            return false;
        }
        // if access token matches the one in the database
        if($token === $result['access_token']){
            return true;
        }
        // else
        $this->error = Util::errorOut("Access token invalid. UserID: $userID Tokens (server, client):---" . $result['access_token'] . '---' . $token, Util::$LoginInvalidMessage);
        return false;
    }

    function generateAccessToken($userID){ // generate user access token and insert into database
        if(!$userID){return false;} // return false if userID supplied if false
        $result = $this->query("SELECT username, pwd_hash, creation_date, access_token FROM login WHERE account_id = '$userID'");
        if($result === false){ // on database error
            $this->error = Util::errorOut($this->get_error());
            return false;
        }
        if($result['access_token']){ // if access token already present
            return $result['access_token'];
        }
        if($this->get_num_rows() === 0){ // if no users with userID are found
            $this->free_result();
            $this->error = Util::errorOut("Could not find user with id '$userID'");
            return false;
        }
        // create token by hashing username, password hash, and account creation date
        $token = password_hash($result['username'] . $result['pwd_hash'] . $result['creation_date'], PASSWORD_DEFAULT);
        $this->free_result();
        return $token;
    }
}