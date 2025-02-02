<?php
include("../controllers/Barang.php");
include("../lib/functions.php");

$obj = new BarangController();

// Get search and filter parameters from the GET request
$search = isset($_GET['search']) ? $_GET['search'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Pass the search and category parameters to the model via the controller
$rows = $obj->getBarangList($search, $kategori);

// Get available categories for the filter
$categories = $obj->getCategories();

$theme = setTheme();
getHeader($theme);
?>

<div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Barang</strong> <small>List All Data</small> </h2>
</div>
<hr style="margin-bottom:-2px;"/>
<a style="margin:10px 0px;" class="btn btn-large btn-info" href="add.php"><i class="fa fa-plus"></i> Create New Data</a>

<div class="search-filter d-flex justify-content-between" style="width: 100%; gap: 15px;">
    <!-- Search Form -->
    <form method="get" action="" class="d-flex gap-2" style="flex-grow: 3;">
        <div class="form-group" style="width: 100%;">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasar nama barang atau kode barang" value="<?php echo $search; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- Category Filter Form (Automatic submit on change) -->
    <form method="get" action="" class="d-flex" style="flex-grow: 1;">
        <div class="form-group" style="width: 100%;">
            <select name="kategori" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['kategori']; ?>" <?php echo ($kategori == $category['kategori']) ? 'selected' : ''; ?>>
                        <?php echo $category['kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

<hr style="margin-bottom:-2px;"/>

<!-- Barang List Table -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>kode_barang</th>
            <th>nama_barang</th>
            <th>kategori</th>
            <th>harga</th>
            <th>stok</th>
            <th width="140">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $row){ ?>
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["kode_barang"]; ?></td>
        <td><?php echo $row["nama_barang"]; ?></td>
        <td><?php echo $row["kategori"]; ?></td>
        <td><?php echo $row["harga"]; ?></td>
        <td><?php echo $row["stok"]; ?></td>
        <td class="text-center" width="200">
            <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">
                <i class="fa fa-pencil"></i>
            </a>
            <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?php
getFooter($theme, "");
?>
