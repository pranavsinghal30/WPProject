<!DOCTYPE html>
<html>
    <head>
        <title>
            Sign In
        </title>
        <link rel="stylesheet" type="text/css" href="StyleSignInFFF.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Cabin+Condensed');
         </style>
    </head>
    <body class="login">
        <div class="toolbar">
            <br/>
            <h1> Website Name</h1>
            <br/>
        </div>
        <div class="left all">
            
            About our website
        </div>
        <div class="right all">
            
            <form id="f1" action="verify.php" method="POST">
                <div>
                    <ul>
                        <li>
                            Sign In
                        </li>
                        <li>
                            <input type="text" id="user_name" name="u_name" placeholder="User Name" />
                        </li>
                        <li>
                            <input type="password" id="password" name="p_word" placeholder="Password" />
                        </li>
                        <li>
                            <input type="submit" id="sign_in" name="s_in" value="Sign In" />
                        </li>                    
                    </ul>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        
                </div>
            </form>

            <!--form id="f2" action="" method="POST">
                <div class="signin">
                    <ul>
                        <li>
                            Sign Up
                        </li>
                        <li>
                            <input type="text" placeholder="User Name" />
                        </li>
                        <li>
                            <input type="password" placeholder="Password" />
                        </li>
                        <li>
                            <input type="submit" value="Sign In" />
                        </li>                    
                    </ul>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                        
                </div>
            </form-->
        </div>
    </body>
</html>