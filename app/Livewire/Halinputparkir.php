<?php

namespace App\Livewire;

use App\Models\JenisKendaraan;
use Livewire\Component;
use App\Models\Riwayatparkir;

class Halinputparkir extends Component
{


    public $nomorPlat, $jenisKendaraan, $parkir_edit;

    public function simpan()
    {
        $this->validate([
            'nomorPlat' => 'required',
            'jenisKendaraan' => 'required'
        ]);

        if ($this->parkir_edit) {
            $simpan = $this->parkir_edit;
        } else {
            $simpan = new Riwayatparkir();
        }
        $simpan->nomor_plat = $this->nomorPlat;
        $simpan->jeniskendaraan_id = $this->jenisKendaraan;
        $simpan->waktu_masuk = now();
        $simpan->save();
        $this->reset();
    }

    public function edit($id)
    {
        $riwayatParkir = Riwayatparkir::find($id);
        $this->parkir_edit = $riwayatParkir;
        $this->nomorPlat = $riwayatParkir->nomor_plat;
        $this->jenisKendaraan = $riwayatParkir->jeniskendaraan_id;
    }

    public function hapus($id)
    {
        Riwayatparkir::find($id)->destroy();
    }

    public function render()
    {
        return view('livewire.halinputparkir')->with([
            'riwayatParkir' => Riwayatparkir::whereNull('waktu_keluar')->get(),
            'jenisKendaraanOptions' => JenisKendaraan::all()
        ]);
    }
}
