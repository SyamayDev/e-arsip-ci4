<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Kwitansi</h3>
        </div>
        <div class="card-body">
            <?= form_open('kwitansi/update/' . $kwitansi['id_kwitansi']); ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>No. Kwitansi</label>
                        <input type="text" class="form-control" name="no_kwitansi" value="<?= $kwitansi['no_kwitansi']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= $kwitansi['tanggal']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Telah Diterima Dari</label>
                        <input type="text" class="form-control" name="telah_diterima_dari" value="<?= $kwitansi['telah_diterima_dari']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Uang Sejumlah (Rp)</label>
                        <input type="number" class="form-control" id="uang_sejumlah" name="uang_sejumlah" value="<?= $kwitansi['uang_sejumlah']; ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Terbilang</label>
                        <input type="text" class="form-control" id="terbilang" name="terbilang" value="<?= $kwitansi['terbilang']; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Untuk Keperluan</label>
                        <textarea class="form-control" name="untuk_keperluan" rows="3" required><?= $kwitansi['untuk_keperluan']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('kwitansi'); ?>" class="btn btn-secondary">Kembali</a>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
document.getElementById('uang_sejumlah').addEventListener('input', function(e) {
    let value = e.target.value;
    if (value) {
        let terbilangText = terbilang(value).replace(/\s+/g, ' ').trim();
        terbilangText = terbilangText.charAt(0).toUpperCase() + terbilangText.slice(1);
        document.getElementById('terbilang').value = terbilangText + ' Rupiah';
    } else {
        document.getElementById('terbilang').value = '';
    }
});

function terbilang(angka) {
    angka = Math.abs(angka);
    const bilangan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    let temp = '';

    if (angka < 12) {
        temp = ' ' + bilangan[angka];
    } else if (angka < 20) {
        temp = terbilang(angka - 10) + ' belas';
    } else if (angka < 100) {
        temp = terbilang(Math.floor(angka / 10)) + ' puluh' + terbilang(angka % 10);
    } else if (angka < 200) {
        temp = ' seratus' + terbilang(angka - 100);
    } else if (angka < 1000) {
        temp = terbilang(Math.floor(angka / 100)) + ' ratus' + terbilang(angka % 100);
    } else if (angka < 2000) {
        temp = ' seribu' + terbilang(angka - 1000);
    } else if (angka < 1000000) {
        temp = terbilang(Math.floor(angka / 1000)) + ' ribu' + terbilang(angka % 1000);
    } else if (angka < 1000000000) {
        temp = terbilang(Math.floor(angka / 1000000)) + ' juta' + terbilang(angka % 1000000);
    } else if (angka < 1000000000000) {
        temp = terbilang(Math.floor(angka / 1000000000)) + ' milyar' + terbilang(angka % 1000000000);
    } else if (angka < 1000000000000000) {
        temp = terbilang(Math.floor(angka / 1000000000000)) + ' triliun' + terbilang(angka % 1000000000000);
    }
    
    return temp;
}
</script>