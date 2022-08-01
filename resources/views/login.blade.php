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
                <?php password_hash('1', PASSWORD_DEFAULT); ?>
                <form id="login-form" class="form" action="/authenticate" method="post">
                  @csrf
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="email" placeholder="Enter Username/Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="pswd" required>
                                </div>
                                <div id="ps_forget" class="text-right">
                                <a href="#" class="text-info">Forgot password <i class="fa fa-question"></i></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md btn-block pull-right" value="submit">
                            </div>
                            <div id="register_link" class="text-left">
                                <a href="/register" class="text-info">Register here <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </form>

                </div>
            </div>
        </div>

<style>
 .center {
  margin: auto;
  padding-top: 10%;
}
#ps_forget{
    margin-top: 10px;
}
#register_link{
    display: block;
    padding-top: 50px;
}
</style>

  
@include('js')


</body>
</html>
