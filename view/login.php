<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
</head>

<body style="background: #00b7ff;
            background: linear-gradient(180deg, rgba(255, 255, 255, 1) 70%, rgba(135, 206, 235, 1) 90%);">

    <div class="container">
        <div class="row" style="height:100px">
        </div>
        <form action="../controller/login_controller.php?status=login" method="post">
            <div class="row">
                <div id="msg" class="col-md-5 col-md-offset-3 text-center justify-content-center align-items-center">
                </div>
                <?php
                if (isset($_GET["msg"])) {
                    ?>
                    <div class="col-md-5 col-md-offset-3 alert alert-danger text-center justify-content-center align-items-center">
                        <?php
                        echo base64_decode($_GET["msg"]);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- Main box -->
 
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-5 panel panel-default"
                    style="height:450px;box-shadow: 0 0 10px  rgba(47, 56, 57, 0.2);background: transparent;">
                    
                    <div class="col-md-12" style="height:300px;">
                        <div class="row text-center justify-content-center align-items-center" style="padding-top:10px;">
                            <img src="../images/logo2T.png" alt="" style="height: 130px;">
                        </div>

                        <div>
                            &nbsp;
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-6">
                                <a href="login.php"><button type="button" class="btn btn-primary btn-lg" style="background-color: #49a3ed; border-style:none; border-radius: 25px; font-size:20px; font-weight:600;"><span class="glyphicon glyphicon-user"></span> System</button></a>
                            </div>
                            <div class="col-md-4">
                                <a href="login_driver.php"><button type="button" class="btn btn-info btn-lg" style="background-color: #8cc8fa; border-style:none; border-radius: 25px; font-size:20px; font-weight:600;"><span class="glyphicon glyphicon-road"></span> Driver</button></a>
                            </div>
                            
                        </div>

                        <div>
                            &nbsp;
                        </div>
                        <div class="row text-center">
                            <label style="font-size:20px"><b>Login</b></label>
                        </div>
                        <div>
                            &nbsp;
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-12">
                                <span class="input-group">
                                    <span class="input-group-addon" style="border-radius: 25px 0px 0px 25px;">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </span>
                                    <input type="email" id="loginusername" name="loginusername" class="form-control" style="border-radius: 0px 25px 25px 0px;" />
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="input-group">
                                    <span class="input-group-addon" style="border-radius: 25px 0px 0px 25px;">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </span>
                                    <input type="password" id="loginpassword" name="loginpassword"
                                        class="form-control" style="border-radius: 0px 25px 25px 0px;" />
                                       
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block"
                                    style="background-color: #1C98ED; border-style:none; border-radius: 25px; font-size:20px; font-weight:600;"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>   
</body>
<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/loginValidation.js"></script>

</html>