<?php
// Mengimpor autoload mPDF jika menggunakan Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Masukkan koneksi database atau controller yang digunakan
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

// Membuat instance mPDF
$mpdf = new \Mpdf\Mpdf();

// Menyiapkan HTML untuk laporan
$html = '
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; font-size: 18px; margin-bottom: 10px; }
        .footer { text-align: right; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>

<div class="header">
    <h2><strong>Laporan Penjualan</strong></h2>
    <p>Periode: ' . ($periode ? date("F Y", mktime(0, 0, 0, $bulan, 1)) : 'Semua Periode') . '</p>
    <p>Cari berdasarkan: ' . ($search ? "Kode Transaksi / Nama Pelanggan: " . htmlspecialchars($search) : 'Semua Data') . '</p>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Transaksi</th>
            <th>Kode Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal Transaksi</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>';

foreach ($rows as $row) {
    $dibeli = $detail->countDetailtransaksi($row['id']);
    $total_harga = $detail->getTotalHarga($row['id']); // Total harga, jika tidak ada, default 0

    $html .= "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['kode_transaksi']}</td>
            <td>{$row['kode_pelanggan']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['tanggal_transaksi']}</td>
            <td>{$dibeli}</td>
            <td>" . number_format($total_harga, 0, ',', '.') . "</td>
        </tr>
    ";
}

$html .= '
    </tbody>
</table>

<div class="footer">
    <p>Generated on: ' . date("d-m-Y H:i:s") . '</p>
</div>

</body>
</html>
';

// Menulis HTML ke file PDF
$mpdf->WriteHTML($html);

// Output file PDF ke browser
$mpdf->Output('laporan_penjualan.pdf', 'I');
exit;
?>
