<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { border: 2px solid black; padding: 20px; width: 800px; margin: auto; }
        .header { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .content table { width: 100%; border-collapse: collapse; }
        .content td { padding: 8px; vertical-align: top; }
        .label { width: 200px; }
        .colon { width: 20px; }
        .value { font-weight: bold; }
        .terbilang-box { border: 1px solid black; padding: 10px; margin-top: 20px; font-style: italic; background-color: #f2f2f2; }
        .footer {margin-right: 60px; margin-top: 50px; }
        .signature { float: right; text-align: center; width: 250px; }
        .signature .name { margin-top: 100px; font-weight: bold; border-top: 1px solid black; padding-top: 5px; }
        @media print {
            body { margin: 0; padding: 0; }
            .container { border: none; width: 100%; }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>KWITANSI PEMBAYARAN</h2>
        </div>
        <div class="content">
            <table>
                <tr>
                    <td class="label">No. Kwitansi</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $kwitansi['no_kwitansi']; ?></td>
                </tr>
                <tr>
                    <td class="label">Telah Diterima Dari</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $kwitansi['telah_diterima_dari']; ?></td>
                </tr>
                <tr>
                    <td class="label">Uang Sejumlah</td>
                    <td class="colon">:</td>
                    <td class="value">Rp <?= number_format($kwitansi['uang_sejumlah'], 0, ',', '.'); ?>,-</td>
                </tr>
                <tr>
                    <td class="label">Untuk Keperluan</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $kwitansi['untuk_keperluan']; ?></td>
                </tr>
            </table>
            <div class="terbilang-box">
                <strong>Terbilang :</strong> "<?= ucwords($kwitansi['terbilang']); ?> Rupiah"
            </div>
        </div>
        <div class="footer">
            <div class="signature">
                <span>Medan, <?= date('d F Y', strtotime($kwitansi['tanggal'])); ?></span><br>
                <span>Yang Menerima,</span>
                <div class="name"></div>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>