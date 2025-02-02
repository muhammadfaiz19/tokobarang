<?php
include("../controllers/Transaksi.php");
include("../controllers/Pelanggan.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$pelanggan = new PelangganController();
$list = $pelanggan->getPelangganList();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];

    // Insert the database record using your controller's method
$dat = $obj->addTransaksi($kode_transaksi, $kode_pelanggan, $tanggal_transaksi);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
$kode_transaksi = generateRandomString();
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'transaksi/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>Transaksi</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Kode Transaksi:</label>
                    <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly="readonly"/>
                </div>
            
                <div class="form-group">
                    <label>Kode Pelanggan:</label>
                    <select class="form-control" name="kode_pelanggan" id="kode_pelanggan">
                        <option value="">Pilih Pelanggan...</option>
                        <?php foreach($list as $ang): ?>
                            <option value="<?php echo htmlspecialchars($ang['kode_pelanggan']); ?>">
                                <?php echo htmlspecialchars($ang['kode_pelanggan']) . ' - ' . htmlspecialchars($ang['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            
                <div class="form-group">
                    <label>Tanggal Transaksi:</label>
                    <input type="date" class="form-control" name="tanggal_transaksi"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
