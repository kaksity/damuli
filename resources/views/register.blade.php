<?php
$x= 0;
$page = 'Login';
?>

<!DOCTYPE html>
<html>
<head>
  @include('css')
</head>
<body>
        <div class="container">
            <div  class="row justify-content-center align-items-center center">
                <div class="col-md-5 col-xs-12 col-md-push-3">
                <form class="form" action="/store" method="post">
                  @csrf
                            <div class="form-group">
                                <label for="u_name" class="text-info">First Name:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="firstName" placeholder="Enter First name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_name" class="text-info">Last Name:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="lastName" placeholder="Enter Last name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_email" class="text-info">Email:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_phone" class="text-info">Phone:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter phone number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_name" class="text-info">Position:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="position" placeholder="Enter Position" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_password" class="text-info">Password:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="u_comfirm" class="text-info">Comfirm:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="comfirm" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="Register">
                            </div>
                            <div id="login_link" class="text-left">
                            Already have account? <a href="/" class="text-info"> Login here <i class="fa fa-lock"></i></a>
                            </div>
                    </form>

                </div>
            </div>
        </div>

<style>
 .center {
  margin: auto;
  padding-top: 5%;
}

#login_link{
    display: block;
    padding-top: 50px;
}
</style>

@include('js')

</body>
</html>