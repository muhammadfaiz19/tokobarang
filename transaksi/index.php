<?php
include("../controllers/Transaksi.php");
include("../controllers/Detailtransaksi.php");
include("../lib/functions.php");

$obj = new TransaksiController();
$detail = new DetailtransaksiController();

// Ambil parameter search dan periode (bulan+tahun) dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$periode = isset($_GET['periode']) ? $_GET['periode'] : ''; 

// Pisahkan periode menjadi bulan dan tahun
list($tahun, $bulan) = $periode ? explode('-', $periode) : [null, null];

// Dapatkan list transaksi yang sudah difilter berdasarkan search, bulan, dan tahun
$rows = $obj->getTransaksiList($search, $bulan, $tahun);
$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading text-center mb-3">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Penjualan</strong> <small>List All Transactions</small></h2>
</div>

<hr style="margin-bottom:20px;"/>

<!-- Print Report Button -->
<a href="cetak_laporan.php?search=<?php echo $search; ?>&periode=<?php echo $periode; ?>" class="btn btn-danger mb-3">
    <i class="fa fa-print"></i> Cetak Laporan
</a>

<!-- Add New Transaction Button -->
<a href="add.php" class="btn btn-info mb-3">
    <i class="fa fa-plus"></i> Add New Transaction
</a>

<!-- Search Form & Filter Bulan dan Tahun -->
<div class="search-filter d-flex justify-content-between mb-3" style="gap: 15px;">
    <!-- Search Form -->
    <form method="get" action="" class="d-flex gap-2" style="flex-grow: 3;">
        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan kode transaksi atau nama pelanggan" value="<?php echo $search; ?>" />
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- Filter Periode (Bulan dan Tahun) -->
    <form method="get" action="" class="d-flex">
        <select name="periode" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Periode</option>
            <?php 
                $currentYear = date('Y');
                for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                    for ($j = 1; $j <= 12; $j++) {
                        $bulan_str = str_pad($j, 2, '0', STR_PAD_LEFT); 
                        $selected = ($bulan == $bulan_str && $tahun == $i) ? 'selected' : '';
                        echo "<option value='$i-$bulan_str' $selected>" . date("F", mktime(0, 0, 0, $j, 1)) . " $i</option>";
                    }
                }
            ?>
        </select>
    </form>
</div>

<!-- Transaksi List Table -->
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th width="30">ID</th>
                <th width="100">Kode Transaksi</th>
                <th width="100">Kode Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th width="100">Tanggal Transaksi</th>
                <th width="100">Jumlah</th>
                <th width="150">Total Harga</th>
                <th width="140">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($rows as $row):
                    $dibeli = $detail->countDetailtransaksi($row['id']);
                    $total_harga = $detail->getTotalHarga($row['id']); // Ambil langsung dari detail transaksi
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["kode_transaksi"]); ?></td>
                    <td><?php echo htmlspecialchars($row["kode_pelanggan"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nama"]); ?></td>
                    <td><?php echo htmlspecialchars($row["tanggal_transaksi"]); ?></td>
                    <td><?php echo htmlspecialchars($dibeli); ?></td>
                    <td><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                    <td class="text-center">
                    <?php if ($row["dibeli"] == 0): ?>
                        <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-success btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="View Detail">
                            <i class="fa fa-briefcase"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    <?php elseif ($row["dibeli"] > 0 && $row["dibeli"] != 2): ?>
                        <a class="btn btn-success btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="View Detail">
                            <i class="fa fa-briefcase"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    <?php elseif ($row["dibeli"] == 2): ?>
                        <a class="btn btn-info btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="View Only">
                            <i class="fa fa-eye"></i>
                        </a>
                    <?php endif; ?>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php getFooter($theme, "<script src='../lib/forms.js'></script>"); ?>

<script>
    $(document).ready(function () {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>
