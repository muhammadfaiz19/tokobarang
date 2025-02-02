<?php 
include("../lib/auth.php"); 
include("../lib/functions.php");
$theme=setTheme();
getHeader($theme);
?>

					<div class="col col-md-9">
						<div class="row">
							<div class="col col-md-5">
								<h4>Today Stats:</h4>
										Nama:<span class="pull-right strong"><?php echo $_SESSION['nama']; ?></span>
										 <div class="progress">
											<div class="progress-bar progress-bar-danger" role="progressbar" 
                                            aria-valuenow="15"aria-valuemin="0" aria-valuemax="100" style="width:15%">15%
                                            </div>
										</div>
									
										Email:<span class="pull-right strong"><?php echo $_SESSION['email']; ?></span>
										 <div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" 
                                            aria-valuenow="30"aria-valuemin="0" aria-valuemax="100" style="width:30%">30%
                                            </div>
										</div>
									
										level:<span class="pull-right strong"><?php echo $_SESSION['level']; ?></span>
										 <div class="progress">
											<div class="progress-bar progress-bar-warning" role="progressbar" 
                                            aria-valuenow="8"aria-valuemin="0" aria-valuemax="100" style="width:8%">8%
                                            </div>
										</div>
							</div>
							<div class="col col-md-5">
								<h4>This Month Stats:</h4>
										Visits<span class="pull-right strong">+ 45%</span>
										 <div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" 
                                            aria-valuenow="45"aria-valuemin="0" aria-valuemax="100" style="width:45%">45%
                                            </div>
										</div>
									
										395 New Users<span class="pull-right strong">+ 57%</span>
										 <div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" 
                                            aria-valuenow="57"aria-valuemin="0" aria-valuemax="100" style="width:57%">57%
                                            </div>
										</div>
									
										12.593 Downloads<span class="pull-right strong">+ 25%</span>
										 <div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" 
                                            aria-valuenow="25"aria-valuemin="0" aria-valuemax="100" style="width:25%">25%
                                            </div>
										</div>
							</div>
						</div>
					</div>
<?php
getFooter($theme,'');
?>  	
