<div class="contentContainer">
    <h1>Homepage - I didn't have time to do anything fancy here</h1>

    <style>
        table, th, td {
            border: 1px solid white;
        }
    </style>
    <h2>Git repo for this assignment - <a href="https://github.com/Lynx-At0Mic/U27A2/" style="text-decoration: none; color: lightseagreen">https://github.com/Lynx-At0Mic/U27A2/</a></h2>
    <h2>P2</h2>
    <p>User agent: <?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
    <p>Screen resolution: <?php if(!@$_GET['res']){
            echo "<a style='text-decoration: none; color: inherit;' id='screenResTag'>Click here to get screen resolution</a>";
            echo "<style>#box{background-color: gray; padding: 2rem;}</style>";
        }
        else{
            $size = $_GET['res'];
            echo $size;
            $width = preg_split("/x/", $size)[0];
            if($width < 1000){
                echo "<style>#box{background-color: red; padding: 2rem;}</style>";
            }
            else{
                echo "<style>#box{background-color: greenyellow; padding: 2rem;}</style>";
            }
        }?></p>
    <h4 id="box">This is gray by default, red id width is less than 1000, and green if it is greater than 1000</h4>
    <script>
        let aTag = document.getElementById('screenResTag');
        aTag.href = Config.BASE_URL + "?res=" + window.innerWidth + 'x' + window.innerHeight;
    </script>
    <h2>Site users</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Account access level</th>
        </tr>
        <tr>
            <td>Admin</td>
            <td>admin</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Manager</td>
            <td>man</td>
            <td>2</td>
        </tr>
        <tr>
            <td>User</td>
            <td>user</td>
            <td>3</td>
        </tr>
    </table>
    <h4>Users created through sign up page have level 3 access</h4>
    <h4>At least level 3 access is needed to access the browse and view pages</h4>

    <h2>Test logs</h2>
    <table>
        <tr>
            <th>Test</th>
            <th>Expected result</th>
            <th>Result</th>
            <th>Pass/Fail</th>
        </tr>
        <tr>
            <td>Valid Login</td>
            <td>Login accepted</td>
            <td>Login accepted</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Invalid Login</td>
            <td>Login not accepted</td>
            <td>Login not accepted</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Null Login</td>
            <td>Login not accepted</td>
            <td>Login not accepted</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Delete login</td>
            <td>Account is deleted</td>
            <td>Account is deleted</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Create account</td>
            <td>Account is created when it is valid</td>
            <td>Account is created when it is valid</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Invalid Access Rights</td>
            <td>Access denied</td>
            <td>Access denied</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Correct Access Rights</td>
            <td>Access granted</td>
            <td>Access granted</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>File upload</td>
            <td>File appears in browse tab</td>
            <td>File appears in browse tab</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Comments</td>
            <td>Comments only appear on correct post</td>
            <td>Comments only appear on correct post</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>URL rewrite</td>
            <td>URL rewritten and points to existing file or controller</td>
            <td>URL rewritten and points to existing file or controller</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>404 Page</td>
            <td>404 page is shown and no error occurs</td>
            <td>404 page is shown and no error occurs</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Logging</td>
            <td>Activities and errors are loged to sitelog.log</td>
            <td>Activities and errors are loged to sitelog.log</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Error log</td>
            <td>Error log shows errors in correct format</td>
            <td>Error log shows errors in correct format</td>
            <td>PASS</td>
        </tr>
        <tr>
            <td>Stats</td>
            <td>Statistics are shown correctly</td>
            <td>Statistics are shown correctly</td>
            <td>PASS</td>
        </tr>
    </table>
</div>
