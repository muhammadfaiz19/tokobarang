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
    $transaksi_id = $id;  
    $kode_barang = isset($_POST['kode_barang']) ? trim($_POST['kode_barang']) : "";

    // Pastikan kode_barang ada dan stok barang cukup
    if (empty($kode_barang)) {
        $msg = false;
    } else {
        // Cek stok barang sebelum menambahkan detail transaksi
        $barang = $barangController->getBarangByKode($kode_barang); // Ambil data barang berdasarkan kode
        if ($barang['stok'] <= 0) {
            $msg = false;
        } else {
            // Jika stok cukup, lanjutkan proses penambahan detail transaksi
            $dat = $detailTransaksiController->addDetailtransaksi($transaksi_id, $kode_barang);
            
            // Jika berhasil ditambahkan, kurangi stok barang
            if ($dat) { 
                $barangController->kurangiStokBarang($kode_barang, 1);
            }
            
            $msg = getJSON(json_encode($dat)); 
        }
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
    echo '<div class="alert alert-danger" style="display: block" id="message_error">Stok Habis. Silahkan Pilih Barang Lain.</div>'; 
}
?>

<div class="header icon-and-heading fs-1">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x"></i>
    <h2><strong>Detail Transaksi</strong> <small>Add New Data</small></h2>
</div>
<hr/>

<!-- Form untuk menambah detail transaksi -->
<form name="formAdd" method="POST" action="" class="p-4 border rounded shadow-lg bg-light">
    <h3 class="text-center mb-4"><strong>Tambah Detail Transaksi</strong></h3>
    
    <!-- Pilih Barang -->
    <div class="form-group">
        <label for="kode_barang" class="font-weight-bold">Pilih Barang:</label>
        <select class="form-control mb-3" name="kode_barang" id="kode_barang" required>
            <option value="">Pilih barang...</option>
            <?php foreach ($barangList as $barang): ?>
                <option value="<?php echo htmlspecialchars($barang['kode_barang']); ?>" 
                        data-harga="<?php echo htmlspecialchars($barang['harga']); ?>"
                        data-kategori="<?php echo htmlspecialchars($barang['kategori']); ?>">
                    <?php echo htmlspecialchars($barang['kode_barang']) . ' - ' . htmlspecialchars($barang['nama_barang']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Kategori Barang (akan terisi otomatis berdasarkan barang yang dipilih) -->
    <div class="form-group">
        <label for="kategori" class="font-weight-bold">Kategori Barang:</label>
        <input type="text" class="form-control mb-3" id="kategori" name="kategori" disabled>
    </div>

    <!-- Harga Barang (akan terisi otomatis berdasarkan barang yang dipilih) -->
    <div class="form-group">
        <label for="harga" class="font-weight-bold">Harga Barang:</label>
        <input type="text" class="form-control mb-3" id="harga" name="harga" disabled>
    </div>

    <!-- Tombol Submit dan Batal -->
    <div class="form-group text-center">
        <button class="btn btn-primary btn-lg" type="submit">Simpan</button>
        <!-- Tombol Batal mengarah ke halaman detail transaksi -->
        <a href="detail.php?id=<?php echo $id; ?>" class="btn btn-secondary btn-lg ml-2">Batal</a>
    </div>


</form>

<script>
    // Update kategori dan harga berdasarkan barang yang dipilih
    document.getElementById('kode_barang').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        const kategori = selectedOption.getAttribute('data-kategori');
        const stok = parseInt(selectedOption.getAttribute('data-stok'));

        if (harga && kategori) {
            // Update kategori dan harga
            document.getElementById('kategori').value = kategori;
            document.getElementById('harga').value = harga.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        // Disable tombol submit jika stok kosong
        const submitBtn = document.getElementById('submitBtn');
        if (stok <= 0) {
            submitBtn.disabled = true;
            alert('Stok barang ini kosong, tidak dapat menambahkannya.');
        } else {
            submitBtn.disabled = false;
        }
    });
</script>

<?php
getFooter($theme, "<script src='../lib/forms.js'></script>");
?>
</body>
</html>
