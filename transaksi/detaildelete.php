<?php
include("../controllers/DetailTransaksi.php");
include("../lib/functions.php");

$obj = new DetailTransaksiController();

// Ambil ID dari parameter URL
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$iddetail = isset($_GET["iddetail"]) ? intval($_GET["iddetail"]) : 0;

if ($id <= 0 || $iddetail <= 0) {
    die("ID penjualan atau detail tidak valid.");
}

$msg = null;

// Proses penghapusan data
if (isset($_POST['submitted']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $iddetail = $_POST['iddetail'];
    $id = $_POST['id'];

    $result = $obj->deleteDetailTransaksi($iddetail);  // Menggunakan $obj, bukan $detailController
    $msg = getJSON($result);  // Pastikan getJSON() sudah didefinisikan di functions.php
}

// Ambil detail transaksi sebelum dihapus
$rows = $obj->getDetailTransaksi($iddetail);

// Atur tema tampilan
$theme = setTheme();
getHeader($theme);
?>

<?php 
if ($msg === true) { 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Delete Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="3;url=' . base_url() . 'transaksi/detail.php?id=' . $id . '">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Delete Gagal</div>'; 
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Detail Transaksi</strong> <small>Delete Data</small></h2>
</div>
<hr/>
<form name="formDelete" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1"/>
    <dl class="row mt-1">
    <?php 
        // Pastikan rows tidak kosong sebelum iterasi
        if (!empty($rows)): 
            foreach ($rows as $row): 
    ?>
        <dt class="col-sm-3">Id:</dt><dd class="col-sm-9"><?php echo htmlspecialchars($row['id']); ?></dd>
        <input type="hidden" class="form-control" name="iddetail" value="<?php echo htmlspecialchars($row['id']); ?>" readonly />
        <input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly />

        <dt class="col-sm-3">Kode Penjualan:</dt><dd class="col-sm-9"><?php echo isset($row['transaksi_id']) ? htmlspecialchars($row['transaksi_id']) : 'Tidak ada data'; ?></dd>

        <dt class="col-sm-3">Kode Barang:</dt><dd class="col-sm-9"><?php echo isset($row['kode_barang']) ? htmlspecialchars($row['kode_barang']) : 'Tidak ada data'; ?></dd>

        <dt class="col-sm-3">Nama Barang:</dt><dd class="col-sm-9"><?php echo isset($row['nama_barang']) ? htmlspecialchars($row['nama_barang']) : 'Tidak ada data'; ?></dd>

        <dt class="col-sm-3">Kategori:</dt><dd class="col-sm-9"><?php echo isset($row['kategori']) ? htmlspecialchars($row['kategori']) : 'Tidak ada data'; ?></dd>

        <dt class="col-sm-3">Harga:</dt><dd class="col-sm-9"><?php echo isset($row['harga']) ? htmlspecialchars($row['harga']) : 'Tidak ada data'; ?></dd>

    <?php 
            endforeach; 
        endif;
    ?>
    </dl>
    <button class="btn btn-large btn-danger" type="submit">Delete</button>
    <a href="detail.php?id=<?= htmlspecialchars($id); ?>" class="btn btn-large btn-default">Cancel</a>
</form>

<?php
getFooter($theme, "");
?>
