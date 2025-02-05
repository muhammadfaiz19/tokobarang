<?php
header('Content-Type: application/json');
include("../controllers/Barang.php");
include("../lib/functions.php");

$obj = new BarangController();
$response = array();

// Pastikan ID valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID barang tidak ditemukan.']);
    exit;
}
$id = $_GET['id'];

$upload_dir = '../images/'; // Pastikan folder ini ada
$thumb_dir = '../images/thumbs/';

// Buat folder jika belum ada
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
if (!is_dir($thumb_dir)) {
    mkdir($thumb_dir, 0777, true);
}

// Pastikan file dikirim
if (!isset($_FILES['foto'])) {
    echo json_encode(['success' => false, 'message' => 'Tidak ada file yang diunggah.']);
    exit;
}

$file = $_FILES['foto'];

// Cek apakah terjadi error saat upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat upload file. Error code: ' . $file['error']]);
    exit;
}

// Validasi tipe file
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
$file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($file_extension, $allowed_types)) {
    echo json_encode(['success' => false, 'message' => 'Format file tidak valid. Hanya JPG, PNG, dan GIF yang diperbolehkan.']);
    exit;
}

// Generate nama unik untuk file
$filename = uniqid() . '.' . $file_extension;
$target_path = $upload_dir . $filename;
$thumb_path = $thumb_dir . $filename;

// Pindahkan file ke folder tujuan
if (move_uploaded_file($file['tmp_name'], $target_path)) {
    // Buat thumbnail jika fungsi tersedia
    if (function_exists('createThumbnail')) {
        createThumbnail($target_path, $thumb_path);
    }
    
    // Simpan informasi file ke database
    $obj->updatefotoBarang($id, $filename);

    echo json_encode([
        'success' => true,
        'message' => 'Gambar berhasil diunggah.',
        'file_path' => $target_path
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memindahkan file ke folder tujuan.']);
}
?>
