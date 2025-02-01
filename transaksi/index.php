<?php
include("../controllers/Transaksi.php");
include("../controllers/Detailtransaksi.php");
include("../lib/functions.php");
$obj = new TransaksiController();
$detail = new DetailtransaksiController();
$rows = $obj->getTransaksiList();
$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
<i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
<h2><strong>Penjualan</strong> <small>List All Transactions</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Add New Transaction</a>
<table class="table table-bordered table-striped"></table>

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
            foreach($rows as $row): 
                $dibeli = $detail->countDetailtransaksi($row['id']);
                $total_harga = $row['total_harga'] ?? 0; // Total harga, jika tidak ada, default 0
            ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["kode_transaksi"]; ?></td>
            <td><?php echo $row["kode_pelanggan"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["tanggal_transaksi"]; ?></td>
            <td><?php echo $dibeli; ?></td>
            <td><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
            <td class="text-center" width="200">
            <?php if ($row["dibeli"] == 0): ?>
                <!-- Jika dibeli = 0: Tampilkan tombol Edit, Detail, dan Delete -->
                <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i>
                </a>
                <a class="btn btn-success btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="View Detail">
                    <i class="fa fa-briefcase"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>
            <?php elseif ($row["dibeli"] > 0 && $row["dibeli"] != 2): ?>
                <!-- Jika dibeli > 0 tapi belum di-set beli (dibeli != 2): Tampilkan tombol Detail dan Delete -->
                <a class="btn btn-success btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="View Detail">
                    <i class="fa fa-briefcase"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>
            <?php elseif ($row["dibeli"] == 2): ?>
                <!-- Jika dibeli = 2 (sudah di-set beli): Tampilkan tombol Eye dan Delete -->
                <a class="btn btn-info btn-sm" href="detail.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="View Only">
                    <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>
            <?php endif; ?>
        </td>


                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
