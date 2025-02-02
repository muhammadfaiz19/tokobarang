<?php
include("../controllers/Barang.php");
include("../lib/functions.php");
$obj = new BarangController();
$msg=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form was submitted, process the update here
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    // Insert the database record using your controller's method
$dat = $obj->addbarang($kode_barang, $nama_barang, $kategori, $harga, $stok);
$msg = getJSON($dat);
}
$theme=setTheme();
getHeader($theme);
?>

<?php 
if($msg===true){ 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url='.base_url().'barang/">';
} elseif($msg===false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal</div>'; 
} else {

}

?>
        <div class="header icon-and-heading fs-1">
        <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
            <h2><strong>Barang</strong> <small>Add New Data</small> </h2>
        </div>
        <hr/>
        <form name="formAdd" method="POST" action="">
            
                <div class="form-group">
                    <label>Kode_barang:</label>
                    <input type="text" class="form-control" name="kode_barang"  />
                </div>
            
                <div class="form-group">
                    <label>Nama_barang:</label>
                    <input type="text" class="form-control" name="nama_barang"  />
                </div>
            
                <div class="form-group">
                    <label>Kategori:</label>
                    <input type="text" class="form-control" name="kategori"  />
                </div>
            
                <div class="form-group">
                    <label>Harga:</label>
                    <input type="text" class="form-control" name="harga"  />
                </div>
            
                <div class="form-group">
                    <label>Stok:</label>
                    <input type="text" class="form-control" name="stok"  />
                </div>
            
            <button class="save btn btn-large btn-info" type="submit">Save</button>
            <a href="#index" class="btn btn-large btn-default">Cancel</a>
        </form>

<?php
getFooter($theme,"<script src='../lib/forms.js'></script>");
?>
</body>
</html>
