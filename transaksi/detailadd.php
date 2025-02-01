<?php
include("../controllers/DetailTransaksi.php");
include("../controllers/Barang.php");
include("../lib/functions.php");

$detailTransaksiController = new DetailTransaksiController();
$barangController = new BarangController();
$barangList = $barangController->getBarangList();

// Validasi parameter ID dari URL
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($id <= 0) {
    die("ID tidak valid.");
}

$msg = null;

// Cek apakah form dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $id;  // Ambil ID transaksi dari URL
    $kode_barang = isset($_POST['kode_barang']) ? trim($_POST['kode_barang']) : "";

    // Validasi input
    if (empty($kode_barang)) {
        $msg = false; // Gagal karena kode_barang kosong
    } else {
        // Simpan data ke database
        $dat = $detailTransaksiController->addDetailtransaksi($transaksi_id, $kode_barang);
        
        // Pastikan `getJSON` dapat menangani array dan JSON
        $msg = getJSON(json_encode($dat)); // Konversi array ke JSON sebelum dikirim ke getJSON()
    }
}

// Atur tema tampilan
$theme = setTheme();
getHeader($theme);
?>

<?php 
// Menampilkan notifikasi sukses atau gagal
if ($msg === true) { 
    echo '<div class="alert alert-success" style="display: block" id="message_success">Insert Data Berhasil</div>';
    echo '<meta http-equiv="refresh" content="2;url=' . base_url() . 'transaksi/detail.php?id=' . $id . '">';
} elseif ($msg === false) {
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Insert Gagal. Mohon pilih barang.</div>'; 
}
?>

<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Detail Transaksi</strong> <small>Add New Data</small></h2>
</div>
<hr/>

<!-- Form untuk menambah detail transaksi -->
<form name="formAdd" method="POST" action="">
    <div class="form-group">
        <label for="barang">Pilih Barang:</label>
        <select class="form-control mb-3" name="kode_barang" id="kode_barang">
            <option value="">Pilih barang...</option>
            <?php foreach ($barangList as $barang): ?>
                <option value="<?php echo htmlspecialchars($barang['kode_barang']); ?>">
                    <?php echo htmlspecialchars($barang['kode_barang']) . ' - ' . htmlspecialchars($barang['nama_barang']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="save btn btn-large btn-info" type="submit">Simpan</button>
    <a href="#index" class="btn btn-large btn-default">Batal</a>
</form>

<?php
getFooter($theme, "<script src='../lib/forms.js'></script>");
?>
</body>
</html>
