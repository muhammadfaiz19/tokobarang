<?php
include("../controllers/Pelanggan.php");
include("../lib/functions.php");
$obj = new PelangganController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    // Update the database record using your controller's method
$dat = $obj->updatepelanggan($id, $kode_pelanggan, $nama, $jk, $email, $telepon);
$msg = getJSON($dat);
}
$rows = $obj->getPelanggan($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'pelanggan/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>Pelanggan</strong> <small>Edit Data</small> </h2>
        </div>
        <hr style="margin-bottom:-2px;"/>
        <form name="formEdit" method="POST" action="">
            <input type="hidden" class="form-control" name="submitted" value="1"/>
            <?php foreach ($rows as $row): ?>
            
                    <div class="form-group">
                        <label>ID:</label>
                        <input type="text" class="form-control" id="id" name="id" 
                            value="<?php echo $row['id']; ?>" readonly/>
                    </div>
                
                    <div class="form-group">
                        <label>Kode Pelanggan:</label>
                        <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" 
                            value="<?php echo $row['kode_pelanggan']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                            value="<?php echo $row['nama']; ?>" />
                    </div>
                
                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <select id="jk" name="jk" style="width:150px" 
                        class="form-control show-tick" required>
                    <option value="<?php echo $row['jk']; ?>">
                    <?php echo $row['jk']; ?></option>
                        <option value="L">L</option><option value="P">P</option>
                    </select>
                </div>
            
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" id="email" name="email" 
                            value="<?php echo $row['email']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>No.Telepon:</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" 
                            value="<?php echo $row['telepon']; ?>" />
                    </div>
                
            
            <?php endforeach; ?>
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>
                                        
<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
