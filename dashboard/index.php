<?php
    include "../lib/auth.php";
    include "../lib/functions.php";
    include "../controllers/Barang.php";
    include "../controllers/Pelanggan.php";
    include "../controllers/Transaksi.php";

    $barang               = new BarangController();
    $pelanggan            = new PelangganController();
    $transaksi            = new TransaksiController();
    $totalBarang          = $barang->getTotalBarang();
    $totalTransaksi       = $transaksi->getTotalTransaksi();
    $totalPelanggan         = $pelanggan->getTotalPelanggan();
    $totalTransaksi30Hari = $transaksi->getTransaksiLast30Days();
    $theme                = setTheme();

    getHeader($theme);
?>
<div>
    <h1 class="py-5 px-4 fs-1">Halo,                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $_SESSION['nama']; ?> 👋</h1>
<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-3 row-cols-xxl-3">
    <div class="col-sm">
        <div class="card radius-10 text-white bg-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1 text-white">Total Barang</p>
                        <h4 class="mb-0 text-white"><?php echo number_format($totalBarang); ?></h4>
                    </div>
                    <div class="ms-auto text-white fs-2">
                        <ion-icon role="img" class="md hydrated" name="grid"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm">
        <div class="card radius-10 text-white bg-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1 text-white">Total Pelanggan</p>
                        <h4 class="mb-0 text-white"><?php echo number_format($totalPelanggan); ?></h4>
                    </div>
                    <div class="ms-auto text-white fs-2">
                        <ion-icon role="img" class="md hydrated" name="people-circle"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm">
        <div class="card radius-10 text-white bg-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-1 text-white">Total Transaksi</p>
                        <h4 class="mb-0 text-white"><?php echo number_format($totalTransaksi); ?></h4>
                    </div>
                    <div class="ms-auto text-white fs-2">
                        <ion-icon role="img" class="md hydrated" name="card"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Chart -->
<div style="max-width: 100%; height: 400px;" class="pt-15">
    <canvas id="transaksiChart"></canvas>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data transaksi dari PHP
var dataTransaksi =<?php echo json_encode($totalTransaksi30Hari); ?>;

// Ambil tanggal dan jumlah transaksi
const labels = dataTransaksi.map(item => item.hari);
const transaksi = dataTransaksi.map(item => item.total_transaksi);

// Inisialisasi Chart.js
var ctx = document.getElementById("transaksiChart").getContext("2d");
var transaksiChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            label: "Total Transaksi",
            data: transaksi,
			backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(255, 159, 64, 0.2)',
			'rgba(255, 205, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
			'rgb(255, 99, 132)',
			'rgb(255, 159, 64)',
			'rgb(255, 205, 86)',
			'rgb(75, 192, 192)',
			'rgb(54, 162, 235)',
			'rgb(153, 102, 255)',
			'rgb(201, 203, 207)'
			],
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                title: {
                    display: true,
                    text: "Tanggal"
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: "Jumlah Transaksi"
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return "Total: " + context.raw;
                    }
                }
            }
        }
    }
});
</script>

<?php getFooter($theme, ''); ?>