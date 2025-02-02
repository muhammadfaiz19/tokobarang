<?php
include("../controllers/Transaksi.php");
include("../controllers/DetailTransaksi.php");
include("../lib/functions.php");

$transaksi = new TransaksiController();
$obj = new DetailTransaksiController();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$msg = null;

if (isset($_POST["submitted"]) == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = 2; // Status 2 = transaksi selesai (checkout)
    
    $dat = $transaksi->updateStatus($id, $status);
    $msg = getJSON($dat);
}

// Mengambil data transaksi dan detail transaksi
$transaksiData = $transaksi->getTransaksi($id);
$detailTransaksiList = $obj->getDetailTransaksiList($id);
$totalItems = $obj->countDetailTransaksi($id);
$theme = setTheme();
getHeader($theme);
?>

<?php 
    if($msg === true){ 
        echo '<div class="alert alert-success" style="display: block" id="message_success">Update Data Berhasil</div>';
        echo '<meta http-equiv="refresh" content="2;url='.base_url().'transaksi/detail.php?id='.$id.'">';
    } elseif($msg === false) {
        echo '<div class="alert alert-danger" style="display: block" id="message_error">Update Gagal</div>'; 
    }
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Detail Transaksi</strong> <small>List All Data</small></h2>
</div>

<dl class="row mt-3">
    <?php foreach ($transaksiData as $transaksi): ?>
        <dt class="col-sm-3" style="margin-left:50px">ID:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $transaksi['id']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Kode Transaksi:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $transaksi['kode_transaksi']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Kode Pelanggan:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $transaksi['kode_pelanggan']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Tanggal Transaksi:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $transaksi['tanggal_transaksi']; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Total Barang:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo $totalItems; ?></dd>

        <dt class="col-sm-3" style="margin-left:50px">Total Harga:</dt>
        <dd class="col-sm-7" style="margin-left:-150px"><?php echo number_format($transaksi['total_harga'], 2, ',', '.'); ?></dd>
    <?php endforeach; ?>
</dl>

<hr style="margin-bottom:-2px;"/>

<?php
if($transaksi['dibeli'] == 0){
    echo '<a style="margin:10px 0px;" class="btn btn-large btn-info" href="detailadd.php?id='.$id.'"><i class="fa fa-plus"></i> Tambah Data</a>';
}
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <?php if ($transaksi['dibeli'] == 0): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($detailTransaksiList)): ?>
            <?php $i = 1; ?>
            <?php foreach ($detailTransaksiList as $barang): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $barang['kode_barang']; ?></td>
                    <td><?php echo $barang['nama_barang']; ?></td>
                    <td><?php echo $barang['kategori']; ?></td>
                    <td><?php echo number_format($barang['harga'], 2, ',', '.'); ?></td>
                    <?php if ($transaksi['dibeli'] == 0): ?>
                        <td class="text-center">
                            <a class="btn btn-danger btn-sm" href="detaildelete.php?id=<?php echo $id; ?>&iddetail=<?php echo $barang['id']; ?>">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No details found for this transaction.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Form untuk Submit -->
<form name="formStatus" method="POST" action="">
    <input type="hidden" class="form-control" name="submitted" value="1"/>
    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
    <div class="d-flex justify-content-end mt-3">
        <?php
        if($transaksi['dibeli'] == 0){
            echo '<button class="save btn btn-large btn-success" type="submit"><i class="fa fa-handshake"></i> Checkout</button>';
        }
        ?>
    </div>     
</form>

<?php
getFooter($theme, "");
?>
