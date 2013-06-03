<div class="popup disable">
    <div class="popup-back"></div>
    <div class="popup-form login">
        <div class="popup-wrapper">
            <div class="login-avt"></div>
            <div class="login-info">
                <div class="login-info-title">
                    Login Form !
                    <div class="popup-progress undisplayed"></div>
                </div>
                <div class="login-info-row"><span class="login-info-label">Email </span>
                    <input id="txtemail" class="login-info-input" name='txtemail' type="text"/>
                </div>
                <div class="login-info-row"><span class="login-info-label">Password </span>
                    <input id="txtpass" class="login-info-input"  name='txtpass' type="password"/>
                </div>
                <div class="login-info-row large">
                    <a class="login-info-link">Forgot password ?</a>
                    <input id="btn-login" class="login-info-button" name='btn-login'  type='submit' value='Submit'/>
                    <div class="fb-btnLogin">
                        <fb:login-button show-faces="false" width="400" max-rows="1" perms="email"></fb:login-button>
                    </div>
                </div>
                <div class="login-info-row">
                    <a class="login-info-link" id="login-info-link-register">Register account </a>
                    
                </div>
            </div>
            <span class="login-popup-error-mess"> </span>
        </div>
    </div>
    <div class="popup-form register">
        <div class="popup-wrapper">
            <form id="registerForm" name="registerForm" action="BLL/registerBll.php" 
                          onsubmit="return AIM.submit(this, {'onStart': startResCallback, 'onComplete': completeResCallback})"
                          method="post" enctype="multipart/form-data">
                <div class="register-info">
                    <div class="login-info-title">
                        Register Form
                        <div class="popup-progress undisplayed"></div>
                    </div>

                    <div class="login-info-row">
                        <span class="login-info-label">Email:</span>
                        <input id="email" class="login-info-input" type="text" name="email"/>
                    </div>
                    <div class="login-info-row">
                        <span class="login-info-label">Full Name :</span>
                        <input id="fname" class="login-info-input" type="text" name="fname"/>
                    </div>
                    <div class="login-info-row"><span class="login-info-label">Password :</span>
                        <input id="pass" class="login-info-input" type="password" name="pass"/>
                    </div>
                    <div class="login-info-row"><span class="login-info-label">Confirm Password :</span>
                        <input id="cpass" class="login-info-input" type="password" name="cpass"/>
                    </div>
                    <div class="login-info-row"><span class="login-info-label">Gender :</span>
                        <div class="login-info-radio-group">
                            <input class="login-info-radio" type="radio" name="sex" value="male" checked="true">Male
                            <input class="login-info-radio" type="radio" name="sex" value="female">Female
                        </div>
                    </div>
                    <div class="login-info-row large">
                        <a id="btn-register" type="button" class="login-info-button">Register</a>
                    </div>
                </div>
                <div class="login-message">
                    
                    <img id="thumbimage" class="register-avt" src="images/icon/avata-ico.png"/>
                    <div class="register-info-row">
                        <a id="btn-register" href="javascript:" name='btn-register' class="register-info-button">Upload Avatar</a>
                        <input id="uploadfile" name="file" class="file" type="file" onchange="readURL(this);"/>
                    </div>
                    <div class="login-message-content undisplayed"></div>
                    <div class="login-message-footer undisplayed"></div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>