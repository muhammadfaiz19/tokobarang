<?php
include("../controllers/Transaksi.php");
include("../lib/functions.php");
$obj = new TransaksiController();
if(isset($_GET["id"])){
    $id=$_GET["id"];
}

$msg=null;
if (isset($_POST["submitted"])==1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $id = $_POST['id'];
    $kode_transaksi = $_POST['kode_transaksi'];
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    
    // Update the database record using your controller's method
$dat = $obj->updatetransaksi($id, $kode_transaksi, $kode_pelanggan, $tanggal_transaksi);
$msg = getJSON($dat);
}
$rows = $obj->getTransaksi($id);
$theme=setTheme();
getHeader($theme);
?>

    <?php 
    if($msg===true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'transaksi/">';
    } elseif($msg===false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    } else {

    }
    
    ?>
        <div class="header icon-and-heading">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
        <h2><strong>Transaksi</strong> <small>Edit Data</small> </h2>
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
                        <label>Kode Transaksi:</label>
                        <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" 
                            value="<?php echo $row['kode_transaksi']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>Kode Pelanggan:</label>
                        <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" 
                            value="<?php echo $row['kode_pelanggan']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>Tanggal Transaksi:</label>
                        <input type="text" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" 
                            value="<?php echo $row['tanggal_transaksi']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>Jumlah:</label>
                        <input type="text" class="form-control" id="dibeli" name="dibeli" 
                            value="<?php echo $row['dibeli']; ?>" />
                    </div>
                
                    <div class="form-group">
                        <label>Total Harga:</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga" 
                            value="<?php echo $row['total_harga']; ?>" />
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
