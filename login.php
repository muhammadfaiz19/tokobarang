<?php
session_start();
error_reporting(0);
include("controllers/Login.php");
include("lib/functions.php");
$obj = new LoginController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the validation begin here
    $email = $_POST["email"];
    $password = $_POST["sandi"];
    
    // Validasi login
    $dat = $obj->login_validation($email, $password);
    $msg = getJSON($dat);
}
$theme=setTheme();
getHeaderLogin($theme);
?>

				
				<div class="container-fluid">
					<h4>Login</h4>
					<div class="col col-md-3 panel panel-default" style="padding-top:10px; padding-bottom:10px">
                            <?php 
                                if($msg<>null){ 
                                    echo '<div class="alert alert-success" style="display: block" id="message_success">Login Success</div>';
                                    echo '<meta http-equiv="refresh" content="1;url='.base_url().'index.php">';
                                } elseif($msg===false) {
                                    echo '<div class="alert alert-danger" style="display: block" id="message_error">Login Gagal</div>'; 
                                } else {

                                }
                            ?>			
                        <form id="login-form" method="POST">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="sandi">Password:</label>
                            <input type="password" class="form-control" id="sandi" name="sandi" required>
                        </div>
                        
                            <button type="submit" class="btn btn-primary">Log In</button>
                        </form>
                        
                        <div style="margin-top:20px">Daftarkan diri Anda <a href="register.php">disini</a></div>
					</div>
					<div class="col col-md-9">
						<div class="row">
                            <div class="col-md-4">
                                
                                
                            </div>
							<div class="col col-md-5">
								
							</div>
						</div>
					</div>
				</div>	

<?php
getFooterLogin($theme,'');
?> 
