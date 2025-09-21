<?php

namespace App\Controllers;

use App\Models\Model_home;

class Home extends BaseController
{
    public function __construct()
    {
        $this->Model_home = new Model_home();
    }

    public function index()
    {
        $chart_data = $this->Model_home->get_chart_data();
        $labels = [];
        $data_values = [];

        foreach ($chart_data as $row) {
            $labels[] = $row['nama_kategori'];
            $data_values[] = (int) $row['jumlah'];
        }

        // Ambil arsip terbaru sebagai default untuk $arsip
        $latest_arsip_id = $this->Model_home->getRecentArsip(1)[0]['id_arsip'] ?? null;
        $arsip = $latest_arsip_id ? $this->Model_home->find($latest_arsip_id) : null;

        $data = [
            'title'       => 'Home',
            'tot_arsip'   => $this->Model_home->tot_arsip(),
            'tot_kategori' => $this->Model_home->tot_kategori(),
            'tot_dep'     => $this->Model_home->tot_dep(),
            'tot_user'    => $this->Model_home->tot_user(),
            'recent_arsip' => $this->Model_home->getRecentArsip(5),
            'arsip_bulan' => $this->Model_home->getStatistikPerBulan(),
            'arsip_dep'   => $this->Model_home->getStatistikPerDepartemen(),
            'chart_labels' => json_encode($labels),
            'chart_data'  => json_encode($data_values),
            'arsip'       => $arsip, // Tambahkan data arsip default
            'isi'         => 'v_home'
        ];

        return view('layout/v_wrapper', $data);
    }
}