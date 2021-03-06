
<div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form action="/signin" method="POST" class="user" >
                <div asp-validation-summary="All" class="text-danger"></div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input name="FirstName" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                        <span asp-validation-for="FirstName" class="text-danger"></span>
                    </div>
                    <div class="col-sm-6">
                        <input name="LastName" type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                        <span asp-validation-for="LastName" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <input name="UserName"  class="form-control form-control-user" placeholder="User Name">
                    <span asp-validation-for="UserName" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <input name="Email" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                    <span asp-validation-for="Email" class="text-danger"></span>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input name="Password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                        <span asp-validation-for="Password" class="text-danger"></span>
                    </div>
                    <div class="col-sm-6">
                        <input asp-for="ConfirmPassword" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="ConfirmPassword">
                        <span asp-validation-for="ConfirmPassword" class="text-danger"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Register Account
                </button>
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" asp-controller="Account" asp-action="ForgotPassword">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" asp-controller="Account" asp-action="Login">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</div>