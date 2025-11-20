<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>

<h1>-- POLGAN MART --</h1>

<h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>Role: <?php echo htmlspecialchars($_SESSION['role']); ?></p>

<hr>

<?php
// === 1. Data Produk ===
$kode_barang = ["001", "002", "003", "004", "005"];
$nama_barang = ["Laptop", "Mouse", "Speaker", "Tas Laptop", "Mouse Pad"];
$harga_barang = [5000000, 50000, 100000, 50000, 35000];

// === 2. Array pembelian ===
$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

// === 3. Perulangan untuk memilih barang & jumlah secara acak ===
for ($i = 0; $i < 5; $i++) {
    // pilih indeks acak
    $idx = rand(0, 4);

    $beli[] = $idx;                 // menyimpan indeks barang
    $jumlah[] = rand(1, 5);         // jumlah acak 1-5
}

// === 4. Menampilkan detail pembelian ===
echo "<h3>Detail Pembelian:</h3>";
echo "<table border='1' cellpadding='8'>";
echo "<tr>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>";

foreach ($beli as $key => $index) {
    $item_total = $harga_barang[$index] * $jumlah[$key];
    $total[] = $item_total;
    $grandtotal += $item_total;

    echo "<tr>
            <td>{$kode_barang[$index]}</td>
            <td>{$nama_barang[$index]}</td>
            <td>" . number_format($harga_barang[$index], 0, ',', '.') . "</td>
            <td>{$jumlah[$key]}</td>
            <td>" . number_format($item_total, 0, ',', '.') . "</td>
          </tr>";
}
echo "</table>";

// === 5. Cetak total belanja ===
echo "<h3>Total Belanja: Rp " . number_format($grandtotal, 0, ',', '.') . "</h3>";
?>

<br>
<a href="logout.php">Logout</a>

</body>
</html>
