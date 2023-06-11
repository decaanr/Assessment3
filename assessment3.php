<?php 
header('Content-Type: application/json'); 

$koneksi = mysqli_connect("localhost", "root", "", "assessment3web"); 

if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
    $sql = "SELECT * FROM produk"; // Membuat pernyataan SQL untuk mengambil semua data dari tabel produk
    $query = mysqli_query($koneksi, $sql); 
    $array_data = array(); // Membuat array kosong untuk menyimpan data
    while ($data = mysqli_fetch_assoc($query)) { // Melakukan looping 
        $array_data[] = $data; // Menambahkan data ke array
    }
    echo json_encode($array_data); // Mengubah array data menjadi JSON dan mencetaknya
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nama_cat = $_POST['nama_cat']; // Mengambil nilai 
    $jenis_cat = $_POST['jenis_cat']; 
    $stock_cat = $_POST['stock_cat']; 
    $sql = "INSERT INTO produk (nama_cat, jenis_cat, stock_cat) VALUES('$nama_cat', '$jenis_cat', '$stock_cat')"; 
    $cek = mysqli_query($koneksi, $sql); 

    if ($cek) { // Jika penyisipan berhasil
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data); 
    } else { // Jika penyisipan gagal
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data); 
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') { 
    $id_cat = $_GET['id_cat']; 
    $sql = "DELETE FROM produk WHERE id_cat='$id_cat'"; // Membuat perintah SQL untuk menghapus data dari tabel produk berdasarkan id_cat
    $cek = mysqli_query($koneksi, $sql); // Menjalankan [perintah SQL menggunakan koneksi ke database

    if ($cek) { // Jika penghapusan berhasil
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data); 
    } else { // Jika penghapusan gagal
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') { 
    parse_str(file_get_contents("php://input"), $data); 
    $id_cat = $data['id_cat']; // Mengambil nilai 
    $nama_cat = $data['nama_cat']; 
    $jenis_cat = $data['jenis_cat']; 
    $stock_cat = $data['stock_cat']; 

    $sql = "UPDATE produk SET nama_cat='$nama_cat', jenis_cat='$jenis_cat', stock_cat='$stock_cat' WHERE id_cat='$id_cat'"; // Membuat pernyataan SQL untuk memperbarui data pada tabel produk berdasarkan id_cat
    $cek = mysqli_query($koneksi, $sql); // Menjalankan perintah SQL menggunakan koneksi ke database

    if ($cek) { // Jika pembaruan berhasil
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data); 
    } else { // Jika pembaruan gagal
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data); 
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') { 
    parse_str(file_get_contents("php://input"), $data); 
    $id_cat = $data['id_cat']; // Mengambil nilai 
    $nama_cat = $data['nama_cat']; 
    $jenis_cat = $data['jenis_cat']; 
    $stock_cat = $data['stock_cat']; 

    $sql = "UPDATE produk SET ";
    $fields = array();

    if (!empty($nama_cat)) { 
        $fields[] = "nama_cat='$nama_cat'"; // Menambahkan kondisi untuk memperbarui kolom 'nama_cat'
    }

    if (!empty($jenis_cat)) { 
        $fields[] = "jenis_cat='$jenis_cat'"; // Menambahkan kondisi untuk memperbarui kolom 'jenis_cat'
    }

    if (!empty($stock_cat)) { 
        $fields[] = "stock_cat='$stock_cat'"; // Menambahkan kondisi untuk memperbarui kolom 'stock_cat'
    }

    $sql .= implode(', ', $fields); 
    $sql .= " WHERE id_cat='$id_cat'"; 
    $cek = mysqli_query($koneksi, $sql); // Menjalankan perintah SQL menggunakan koneksi ke database

    if ($cek) { // Jika pembaruan berhasil
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data); 
    } else { // Jika pembaruan gagal
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data); 
    }
}
?>
