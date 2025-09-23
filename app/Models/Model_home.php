<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_home extends Model
{
    public function tot_arsip()
    {
        return $this->db->table('tbl_arsip')->countAll();
    }
    public function tot_kategori()
    {
        return $this->db->table('tbl_kategori')->countAll();
    }
    public function tot_bagian()
    {
        return $this->db->table('tbl_bagian')->countAll();
    }
    public function tot_user()
    {
        return $this->db->table('tbl_user')->countAll();
    }

    public function get_chart_data()
    {
        return $this->db->table('tbl_arsip')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->select('tbl_kategori.nama_kategori, COUNT(tbl_arsip.id_arsip) as jumlah')
            ->groupBy('tbl_kategori.nama_kategori')
            ->orderBy('jumlah', 'DESC')
            ->get()->getResultArray();
    }
    protected $table      = 'tbl_arsip';
    protected $primaryKey = 'id_arsip';
    protected $allowedFields = [
        'id_kategori', 'no_arsip', 'nama_arsip', 'deskripsi',
        'tgl_upload', 'tgl_update', 'file_arsip', 'ukuran_file',
        'id_dep', 'id_user'
    ];

    // 🔹 Ambil arsip terbaru (mirip recent files di Google Drive)
    public function getRecentArsip($limit = 5)
    {
        return $this->select('tbl_arsip.id_arsip, tbl_arsip.no_arsip, tbl_arsip.nama_arsip, tbl_kategori.nama_kategori, tbl_arsip.tgl_upload, tbl_user.nama_user')
                    ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
                    ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
                    ->orderBy('tbl_arsip.tgl_upload', 'DESC')
                    ->findAll($limit);
    }

    // 🔹 Statistik arsip per bulan
    public function getStatistikPerBulan()
    {
        return $this->select("MONTH(tgl_upload) as bulan, COUNT(*) as total")
                    ->groupBy("MONTH(tgl_upload)")
                    ->findAll();
    }

    // 🔹 Statistik arsip per departemen
    public function getStatistikPerDepartemen()
    {
        return $this->select("tbl_bagian.id_dep, tbl_bagian.nama_dep, COUNT(tbl_arsip.id_arsip) as total")
                    ->join("tbl_bagian", "tbl_bagian.id_dep = tbl_arsip.id_dep", "left")
                    ->groupBy("tbl_bagian.id_dep, tbl_bagian.nama_dep")
                    ->findAll();
    }
    public function getAllArsip()
{
    return $this->db->table('tbl_arsip')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
        ->join('tbl_bagian', 'tbl_bagian.id_bagian = tbl_arsip.id_bagian', 'left')
        ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
        ->orderBy('tbl_arsip.id_arsip', 'DESC')
        ->get()
        ->getResultArray();
}

public function getStatistikPerbagian()
{
    return $this->select("tbl_bagian.id_bagian, tbl_bagian.nama_bagian, COUNT(tbl_arsip.id_arsip) as total")
                ->join("tbl_bagian", "tbl_bagian.id_bagian = tbl_arsip.id_bagian", "left")
                ->groupBy("tbl_bagian.id_bagian, tbl_bagian.nama_bagian")
                ->findAll();
}

}