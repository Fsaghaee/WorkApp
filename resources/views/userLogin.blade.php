<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Work Page</title>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">


    <!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55" style="min-width: 700px;">
                <form method="POST" class="login100-form validate-form flex-sb flex-w" action="/login">
                    {{ csrf_field() }}
                    <span class="login100-form-title p-b-32">
						Account Login
					</span>
                    <span class="txt1 p-b-11">
						Email
					</span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
                        <input type="email" class="input100" id="login" name="email" placeholder="Email" style="min-height: 70px;">
                        <span class="focus-input100"></span>
                    </div>
                    <span class="txt1 p-b-11">
						Password
					</span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
                        <input type="password" class="input100" id="password" name="password" placeholder="Password" style="min-height: 70px;">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">Log in</button>
                    </div>
                </form>
                <div id="formFooter" style="margin-top: 60px;text-align: center;">
                    <a href="/register" class="underlineHover"> Register new Company </a>
                </div>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
</body></html>

