<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login Form Administrator</title>
        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="css/login-style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.bootbox.min.js"></script>
        <script type="text/javascript" src="scripts/bootstrap.js"></script>
        <script type="text/javascript" src="scripts/ajax-admin.js"></script>
    </head>
    <body>
        <div class="container">
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
<!--                            <form  action="mysuperscript.php" autocomplete="on"> -->
                                <h1>LOG IN FORM OF ADMINISTRATOR</h1>
                                <p> 
                                    <label for="txtemail" class="uname" data-icon="u" > Your Email </label>
                                    <input id="txtemail" name="txtemail" type="text" placeholder="mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="txtpass" class="youpasswd" data-icon="p"> Your Password </label>
                                    <input id="txtpass" name="txtpass" type="password" placeholder="eg. ******" />
                                </p>
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                <div class="admin-progress undisplayed"></div>
                                <p class="login button"> 
                                    <input id="btn-admin-login" type="button" value="Login" />
								</p>
                                <p class="change_link">
<!--									Not a member yet ?-->
<!--									<a href="#toregister" class="to_register">Join us</a>-->
								</p>
<!--                            </form>-->
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>