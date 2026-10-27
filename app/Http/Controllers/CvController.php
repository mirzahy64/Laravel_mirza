<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        $pengalaman = Cv::all();
        return view('Cv.index', compact('pengalaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required',
            'perusahaan' => 'required',
            'periode' => 'required',
        ]);

        Cv::create($request->all());

        return redirect()->back()->with('success', 'Data baru berhasil ditambahkan!');
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required',
            'perusahaan' => 'required',
            'periode' => 'required',
        ]);

        $data = Cv::findOrFail($id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // UPDATE PROFIL SINKRON KE SEMUA BARIS
    public function updateProfile(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'posisi' => 'required',
        ]);

        // Update nama & data diri di seluruh baris database
        Cv::query()->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        $data = Cv::findOrFail($id);
        $data->update(['posisi' =>$request->posisi]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui untuk seluruh data!');
    }

    public function destroy($id)
    {
        $data = Cv::findOrFail($id);$data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // METHOD UNTUK MENAMPILKAN HALAMAN DETIL CV PER ORANG
    public function show($id)
    {
        $userCv = Cv::findOrFail($id);
        // Mengambil semua riwayat kerja milik nama tersebut
        $riwayatKerja = Cv::where('nama',$userCv->nama)->get();

        return view('Cv.show', compact('userCv', 'riwayatKerja'));
    }
}