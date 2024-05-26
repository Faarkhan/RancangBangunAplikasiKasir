<?php
require 'ceklogin.php';

if (isset($_GET['idp'])) {
    $idp = $_GET['idp'];

    // Fetch customer and order details
    $ambilnamapelanggan = mysqli_query($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan AND p.idorder='$idp'");
    $np = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $np['namapelanggan'];

    // Fetch order items
    $get = mysqli_query($c, "SELECT * FROM detailpesanan p, produk pr WHERE p.idproduk=pr.idproduk AND idpesanan='$idp'");
    $items = [];
    $total = 0;

    while ($p = mysqli_fetch_array($get)) {
        $idpr = $p['idproduk'];
        $namaproduk = $p['namaproduk'];
        $qty = $p['qty'];
        $harga = $p['harga'];
        $subtotal = $qty * $harga;
        $total += $subtotal;
        $items[] = [
            'namaproduk' => $namaproduk,
            'qty' => $qty,
            'harga' => $harga,
            'subtotal' => $subtotal
        ];
    }

    // Process payment if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uang_dibayar = $_POST['uang_dibayar'];
        $kembalian = $uang_dibayar - $total;

        // Optionally, store payment and change information in the database
        // mysqli_query($c, "INSERT INTO pembayaran (idorder, bayar, kembali) VALUES ('$idp', '$uang_dibayar', '$kembalian')");
    } else {
        $uang_dibayar = 0;
        $kembalian = 0;
    }

} else {
    echo "ID Pesanan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Struk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 300px;
            margin: auto;
            margin-top: 40px; /* Added margin-top to create space at the top */
        }
        .header, .footer {
            text-align: center;
        }
        .header h2 {
            margin: 5px 0;
        }
        .items, .totals {
            width: 100%;
            margin: 10px 0;
        }
        .items th, .items td, .totals th, .totals td {
            padding: 5px;
        }
        .items .subtotal {
            font-size: 12px; /* Smaller font size for subtotal */
        }
        .items td:last-child, .totals td {
            text-align: right;
        }
        .totals {
            margin-top: 20px;
            text-align: left;
        }
        .totals th, .totals td {
            border-top: none;
        }
        .footer {
            margin-top: 20px;
        }
        .footer p {
            margin: 5px 0;
        }
        .divider {
            border-top: 1px dashed black;
            margin: 10px 0;
        }
        .form-container {
            margin: 20px 0;
            text-align: center;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input {
            margin-bottom: 10px;
            padding: 5px;
            width: calc(100% - 10px);
        }
        .form-container button {
            margin: 5px;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        @media print {
            .form-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>CAHAYA TELUR</h2>
        <p>Jl. Raya Puspitek Rt.03/04, Kel.Buaran, Kec.Serpong, Kota Tangerang Selatan, 15316</p>
        <p>085719560021</p>
        <div class="divider"></div>
    </div>
    <div class="content">
        <table class="items">
            <tbody>
                <?php foreach ($items as $index => $item): ?>
                <tr>
                    <td>
                        <strong><?= $item['namaproduk']; ?></strong>
                        <br>
                        <span class="subtotal"><?= $item['qty']; ?> x Rp<?= number_format($item['harga']); ?></span>
                    </td>
                    <td>Rp<?= number_format($item['subtotal']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="divider"></div>
        <table class="totals">
            <tr>
                <th>Total</th>
                <td>Rp<?= number_format($total); ?></td>
            </tr>
            <tr>
                <th>Bayar</th>
                <td>Rp<?= number_format($uang_dibayar); ?></td>
            </tr>
            <tr>
                <th>Kembali</th>
                <td>Rp<?= number_format($kembalian); ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Barang yang sudah dibeli tidak</p>
        <p>dapat ditukar / dikembalikan</p>
        <div class="divider"></div>
        <p id="current-date-time"><?= date('d-m-Y H:i:s'); ?></p>
        <p>Thank You</p>
    </div>
    <div class="form-container">
        <form method="post">
            <label for="uang_dibayar">Uang Dibayar:</label>
            <input type="number" name="uang_dibayar" id="uang_dibayar" value="<?= $uang_dibayar ?>" required>
            <button type="submit">Hitung Kembalian</button>
        </form>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <button onclick="updateDateTime(); window.print();">Cetak Struk</button>
        <?php endif; ?>
    </div>

    <script>
        function updateDateTime() {
            var now = new Date();
            var formattedDate = now.getDate().toString().padStart(2, '0') + '-' + 
                                (now.getMonth() + 1).toString().padStart(2, '0') + '-' + 
                                now.getFullYear() + ' ' + 
                                now.getHours().toString().padStart(2, '0') + ':' + 
                                now.getMinutes().toString().padStart(2, '0') + ':' + 
                                now.getSeconds().toString().padStart(2, '0');
            document.getElementById('current-date-time').textContent = formattedDate;
        }
    </script>
</body>
</html>
