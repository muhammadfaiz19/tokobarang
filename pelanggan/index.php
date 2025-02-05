<?php
include("../controllers/Pelanggan.php");
include("../lib/functions.php");

$obj = new PelangganController();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$jk = isset($_GET['jk']) ? $_GET['jk'] : '';

$rows = $obj->getPelangganList($search, $jk);
$jenis_kelamin = $obj->getJenisKelamin();

$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Pelanggan</strong> <small>List All Data</small></h2>
</div>
<hr/>
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>
<div class="search-filter d-flex justify-content-between" style="width: 100%; gap: 15px;">
    <!-- Search Form -->
    <form method="get" action="" class="d-flex gap-2" style="flex-grow: 3;">
        <div class="form-group" style="width: 100%;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode pelanggan" value="<?php echo $search; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- Filter Form -->
    <form method="get" action="" class="d-flex" style="flex-grow: 1;">
        <div class="form-group" style="width: 100%;">
            <select name="jk" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Jenis Kelamin</option>
                <?php foreach ($jenis_kelamin as $gender): ?>
                    <option value="<?php echo $gender['jk']; ?>" <?php echo ($jk == $gender['jk']) ? 'selected' : ''; ?>>
                        <?php echo $gender['jk']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

<hr/>

<table class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Pelanggan</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["kode_pelanggan"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["jk"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["telepon"]; ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
getFooter($theme, "");
?>
