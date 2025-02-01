<?php
include("../controllers/Detailtransaksi.php");
include("../lib/functions.php");
$obj = new DetailtransaksiController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    // Update the database record using your controller's method
$dat = $obj->updatedetailtransaksi($id, $kode_transaksi, $kode_pelanggan);
$msg = getJSON($dat);
}
$rows = $obj->getDetailtransaksi($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'detailtransaksi/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>detailtransaksi</strong> <small>Edit Data</small> </h2>
        </div>
        <hr style="margin-bottom:-2px;"/>
        <form name="formEdit" method="POST" action="">
            <input type="hidden" class="form-control" name="submitted" value="1"/>
            <?php foreach ($rows as $row): ?>
            
                    <div class="form-group">
                        <label>id:</label>
                        <input type="text" class="form-control" id="id" name="id" 
                            value="<?php echo $row['id']; ?>" readonly/>
                    </div>
                
                    <div class="form-group">
                        <label>kode_transaksi:</label>
                        <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" 
                            value="<?php echo $row['kode_transaksi']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>kode_pelanggan:</label>
                        <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" 
                            value="<?php echo $row['kode_pelanggan']; ?>" />
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
