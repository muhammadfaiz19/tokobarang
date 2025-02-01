<?php
include("../controllers/Detailtransaksi.php");
include("../lib/functions.php");
$obj = new DetailtransaksiController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    // Insert the database record using your controller's method
$dat = $obj->adddetailtransaksi($kode_transaksi, $kode_pelanggan);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'detailtransaksi/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>detailtransaksi</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Kode_transaksi:</label>
                    <input type="text" class="form-control" name="kode_transaksi"  />
                </div>
            
                <div class="form-group">
                    <label>Kode_pelanggan:</label>
                    <input type="text" class="form-control" name="kode_pelanggan"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
