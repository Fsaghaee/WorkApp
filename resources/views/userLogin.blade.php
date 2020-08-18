@extends('Layout.pageLayout')


@section('MainPart')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <form method="POST" class="login100-form validate-form flex-sb flex-w" action="/login">
        {{ csrf_field() }}


        <span class="login100-form-title p-b-32">
						Account Login
					</span>

        <span class="txt1 p-b-11">
						Username
					</span>

        <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
        <input type="email" class="input100" id="login" name="email" placeholder="Email">
            <span class="focus-input100"></span>
        </div>


        <span class="txt1 p-b-11">
						Password
					</span>
        <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>

        <input type="password" class="input100" id="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
        </div>
        <div class="container-login100-form-btn">
            <button  type="submit" class="login100-form-btn" >Log in</button>
        </div>
    </form>
    <div id="formFooter">
        <a href="/register" class="underlineHover"> Register new Company </a>
    </div>


            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

@stop

