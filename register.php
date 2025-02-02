<?php
include("controllers/Login.php");
include("lib/functions.php");
$obj = new LoginController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $email = $_POST["email"];
    $nama = $_POST["nama"];
    $sandi = $_POST["sandi"];
    $confirmpassword=$_POST["confirmpassword"];
    
    if($sandi===$confirmpassword){
        // Insert the database record using your controller's method
        $dat = $obj->addUsers($email,$nama,$sandi);
        $msg = getJSON($dat);
    } else {
        $msg="no";
    }
}
$theme=setTheme();
getHeaderLogin($theme);
?>

				
				<div class="container-fluid">
					<h4>Register</h4>
					<div class="col col-md-3 panel panel-default" style="padding-top:10px; padding-bottom:10px">	
                            <?php 
                                if($msg===true){ 
                                    echo '<div class="alert alert-success" style="display: block" id="message_success">Register Success</div>';
                                    echo '<meta http-equiv="refresh" content="1;url='.base_url().'index.php">';
                                } elseif($msg===false) {
                                    echo '<div class="alert alert-danger" style="display: block" id="message_error">Register Gagal</div>'; 
                                } elseif($msg==="no") {
                                    echo '<div class="alert alert-danger" style="display: block" id="message_error">Password dan Confirm password hrs sama</div>';
                                } else {

                                }
                            ?>		
                        <form id="login-form" method="POST">
                        <div class="form-group">
                            <label for="nrp">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
						<div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="sandi">Password:</label>
                            <input type="password" class="form-control" id="sandi" name="sandi" required>
                        </div>
						<div class="form-group">
                            <label for="confirmpassword">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
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
