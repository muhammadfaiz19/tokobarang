<?php
include("../controllers/Detailtransaksi.php");
include("../controllers/Transaksi.php"); // Pastikan controller transaksi dimuat
include("../lib/functions.php");

$obj = new DetailTransaksiController();
$transaksiController = new TransaksiController(); // Buat objek untuk update total harga

// Ambil ID dari parameter URL
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$iddetail = isset($_GET["iddetail"]) ? intval($_GET["iddetail"]) : 0;

if ($id <= 0 || $iddetail <= 0) {
    die("ID penjualan atau detail tidak valid.");
}

$msg = null;

// Proses penghapusan data HARUS menggunakan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_detail = intval($_POST["iddetail"]);
    $transaksi_id = intval($_POST["id"]);

    // Eksekusi penghapusan
    $result = $obj->deleteDetailtransaksi($id_detail, $transaksi_id);

    if ($result["success"]) {
        // Perbarui total harga setelah penghapusan
        $obj->updateTotalHarga($transaksi_id);
        $msg = true;
    } else {
        $msg = false;
    }

    // Redirect setelah proses selesai
    header("Location: detail.php?id=" . htmlspecialchars($transaksi_id));
    exit();
}

// Ambil detail transaksi sebelum dihapus
$rows = $obj->getDetailTransaksi($iddetail);

// Atur tema tampilan
$theme = setTheme();
getHeader($theme);
?>

<?php 
if ($msg === true) { 
    echo '<div class="alert alert-success" id="message_success">Delete Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="3;url=' . base_url() . 'transaksi/detail.php?id=' . htmlspecialchars($id) . '">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" id="message_error">Delete Gagal</div>'; 
}
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Detail Transaksi</strong> <small>Delete Data</small></h2>
</div>
<hr/>
<form name="formDelete" method="POST" action="">
    <input type="hidden" name="submitted" value="1"/>
    <dl class="row mt-1">
    <?php 
        if (!empty($rows)): 
            foreach ($rows as $row): 
    ?>
        <dt class="col-sm-3">Id:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['id']); ?></dd>
        <input type="hidden" name="iddetail" value="<?= htmlspecialchars($row['id']); ?>" />
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>" />

        <dt class="col-sm-3">Kode Penjualan:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['transaksi_id'] ?? 'Tidak ada data'); ?></dd>
        <dt class="col-sm-3">Kode Barang:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['kode_barang'] ?? 'Tidak ada data'); ?></dd>
        <dt class="col-sm-3">Nama Barang:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['nama_barang'] ?? 'Tidak ada data'); ?></dd>
        <dt class="col-sm-3">Kategori:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['kategori'] ?? 'Tidak ada data'); ?></dd>
        <dt class="col-sm-3">Harga:</dt><dd class="col-sm-9"><?= htmlspecialchars($row['harga'] ?? 'Tidak ada data'); ?></dd>

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
