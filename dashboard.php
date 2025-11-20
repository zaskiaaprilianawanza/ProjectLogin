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
<title>Dashboard Penjualan</title>
<style>
body { font-family: Arial; background: #eef2f3; padding: 20px; }
h1 { background: #007bff; color: white; padding: 15px; border-radius: 8px; }
table { border-collapse: collapse; width: 80%; margin-top: 20px; background: white; }
th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
th { background: #007bff; color: white; }
.total-box { margin-top: 20px; padding: 15px; background: #fff; width: 50%; border-left: 5px solid #007bff; }
a { text-decoration: none; padding: 10px 15px; background: red; color: white; border-radius: 5px; }
</style>
</head>
<body>

<h1>POLGAN MART - Dashboard Penjualan</h1>

<h3>Selamat datang, <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['role']; ?>)</h3>

<?php
// DATA PRODUK
$kode_barang  = ["001", "002", "003", "004", "005"];
$nama_barang  = ["Laptop", "Mouse", "Speaker", "Tas Laptop", "Mouse Pad"];
$harga_barang = [5000000, 50000, 100000, 50000, 35000];

// ARRAY PEMBELIAN
$beli = [];
$jumlah = [];
$total = [];

$grandtotal = 0;

// ACak 5 transaksi pembelian
for ($i = 0; $i < 5; $i++) {
    $idx = rand(0, 4);
    $beli[] = $idx;
    $jumlah[] = rand(1, 5);
}

echo "<table>";
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
            <td>Rp " . number_format($harga_barang[$index], 0, ',', '.') . "</td>
            <td>{$jumlah[$key]}</td>
            <td>Rp " . number_format($item_total, 0, ',', '.') . "</td>
          </tr>";
}
echo "</table>";

// HITUNG DISKON
if ($grandtotal < 50000) {
    $diskon_rate = 0.05;
} elseif ($grandtotal <= 100000) {
    $diskon_rate = 0.10;
} else {
    $diskon_rate = 0.15;
}

$diskon = $grandtotal * $diskon_rate;
$total_akhir = $grandtotal - $diskon;
?>

<div class="total-box">
  <h3>Rincian Total Pembelian</h3>
  <p>Total Belanja : <b>Rp <?php echo number_format($grandtotal, 0, ',', '.'); ?></b></p>
  <p>Diskon (<?php echo $diskon_rate * 100; ?>%) : 
     <b>Rp <?php echo number_format($diskon, 0, ',', '.'); ?></b></p>

  <h3>Total Akhir : <b>Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></b></h3>
</div>

<br>
<a href="logout.php">Logout</a>

</body>
</html>
