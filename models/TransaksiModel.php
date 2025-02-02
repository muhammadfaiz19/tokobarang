    <?php

    include_once('../db/database.php');

    class TransaksiModel
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function addTransaksi($kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
        {
            $sql = "INSERT INTO transaksi (kode_transaksi, kode_pelanggan, tanggal_transaksi) 
                    SELECT :kode_transaksi, :kode_pelanggan, :tanggal_transaksi
                    FROM pelanggan P
                    LEFT JOIN transaksi T ON T.kode_pelanggan = P.kode_pelanggan 
                    WHERE P.kode_pelanggan = :kode_pelanggan";

            $params = array(
                ":kode_transaksi" => $kode_transaksi,
                ":kode_pelanggan" => $kode_pelanggan,
                ":tanggal_transaksi" => $tanggal_transaksi
            );

            $result = $this->db->executeQuery($sql, $params);
            return json_encode([
                "success" => $result,
                "message" => $result ? "Insert successful" : "Insert failed"
            ]);
        }

        public function getTransaksi($id)
        {
            $sql = "SELECT T.*, P.nama 
                    FROM transaksi T 
                    LEFT JOIN pelanggan P ON T.kode_pelanggan = P.kode_pelanggan 
                    WHERE T.id = :id";

            $params = array(":id" => $id);
            return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateTransaksi($id, $kode_transaksi, $kode_pelanggan, $tanggal_transaksi)
        {
            $sql = "UPDATE transaksi 
                    SET kode_transaksi = :kode_transaksi, 
                        kode_pelanggan = :kode_pelanggan, 
                        tanggal_transaksi = :tanggal_transaksi 
                    WHERE id = :id";

            $params = array(
                ":kode_transaksi" => $kode_transaksi,
                ":kode_pelanggan" => $kode_pelanggan,
                ":tanggal_transaksi" => $tanggal_transaksi,
                ":id" => $id
            );

            $result = $this->db->executeQuery($sql, $params);
            return json_encode([
                "success" => $result,
                "message" => $result ? "Update successful" : "Update failed"
            ]);
        }

        public function updateStatus($id, $status)
        {
            try {
                $sql = "UPDATE transaksi SET dibeli = :dibeli WHERE id = :id";
                $params = array(":dibeli" => $status, ":id" => $id);
                $this->db->executeQuery($sql, $params);
                return json_encode(["success" => true, "message" => "Status updated"]);
            } catch (Exception $e) {
                return json_encode(["success" => false, "message" => $e->getMessage()]);
            }
        }

        public function deleteTransaksi($id)
        {
            $sql = "DELETE FROM transaksi WHERE id = :id";
            $params = array(":id" => $id);

            $result = $this->db->executeQuery($sql, $params);
            return json_encode([
                "success" => $result,
                "message" => $result ? "Delete successful" : "Delete failed"
            ]);
        }

        public function getTransaksiList($search = '', $bulan = '', $tahun = '')
    {
        $sql = 'SELECT T.id, T.kode_transaksi, T.kode_pelanggan, T.tanggal_transaksi, T.dibeli, P.id AS idpelanggan, P.nama 
                FROM transaksi T 
                LEFT JOIN pelanggan P ON T.kode_pelanggan = P.kode_pelanggan';

        // Apply filters if search, bulan or tahun are set
        if ($search) {
            $sql .= " WHERE T.kode_transaksi LIKE :search OR P.nama LIKE :search";
        }

        if ($bulan && $tahun) {
            $sql .= $search ? " AND MONTH(T.tanggal_transaksi) = :bulan AND YEAR(T.tanggal_transaksi) = :tahun" : " WHERE MONTH(T.tanggal_transaksi) = :bulan AND YEAR(T.tanggal_transaksi) = :tahun";
        } elseif ($bulan) {
            $sql .= $search ? " AND MONTH(T.tanggal_transaksi) = :bulan" : " WHERE MONTH(T.tanggal_transaksi) = :bulan";
        } elseif ($tahun) {
            $sql .= $search ? " AND YEAR(T.tanggal_transaksi) = :tahun" : " WHERE YEAR(T.tanggal_transaksi) = :tahun";
        }

        $sql .= " LIMIT 100";

        $params = [];
        if ($search) {
            $params[':search'] = '%' . $search . '%';
        }
        if ($bulan) {
            $params[':bulan'] = $bulan;
        }
        if ($tahun) {
            $params[':tahun'] = $tahun;
        }

        return $this->db->executeQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }


        public function getDataCombo()
        {
            $sql = 'SELECT * FROM transaksi';
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTotalHarga($transaksi_id)
        {
            // SQL query untuk mendapatkan total harga dari detail transaksi berdasarkan transaksi_id
            $sql = "SELECT SUM(b.harga * d.jumlah) as total_harga
                    FROM detailtransaksi d
                    JOIN barang b ON d.kode_barang = b.kode_barang
                    WHERE d.transaksi_id = :transaksi_id";
            
            // Menyiapkan perintah SQL
            $stmt = $this->db->getPdo()->prepare($sql);
            
            // Mengikat parameter
            $stmt->bindParam(":transaksi_id", $transaksi_id, PDO::PARAM_INT);
            
            // Menjalankan query dan mengambil hasilnya
            $stmt->execute();
            
            // Mengambil hasil dan mengembalikan total harga
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_harga'] ?? 0;  // Jika tidak ada hasil, kembalikan 0
        }
        


        
    public function updateTotalHarga($transaksi_id, $total_harga)
    {
        // SQL query untuk mengupdate total harga di tabel transaksi
        $sql = "UPDATE transaksi SET total_harga = :total_harga WHERE id = :transaksi_id";
        
        // Menyiapkan perintah SQL
        $stmt = $this->db->getPdo()->prepare($sql);
        
        // Mengikat parameter
        $stmt->bindParam(":total_harga", $total_harga, PDO::PARAM_STR);
        $stmt->bindParam(":transaksi_id", $transaksi_id, PDO::PARAM_INT);
        
        // Menjalankan query untuk mengupdate total harga
        return $stmt->execute();
    }

        
        
    }
    ?>
