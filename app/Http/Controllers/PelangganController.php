<?php
namespace App\Http\Controllers;


use App\Models\Pelanggan;
use Illuminate\Http\Request;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            // Daftar kolom yang bisa difilter sesuai name pada form
            $filterableColumns = ['gender'];

            // Daftar kolom yang bisa dicari
            $searchableColumns = ['first_name', 'last_name', 'email'];

            // Gunakan scope filter dan search untuk memproses query
            $pageData['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
                                            ->search($request, $searchableColumns)
                                            ->paginate(10);

            return view('admin.pelanggan.index', $pageData);
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;


        Pelanggan::create($data);


        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan    = Pelanggan::findOrFail($pelanggan_id);


        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;


        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);


        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }


    public function cv(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);


        $data = [
            'pelanggan_id'    => $pelanggan->pelanggan_id,


            'username'        => trim(
                $pelanggan->first_name . ' ' . $pelanggan->last_name
            ),


            'profesi'         => 'Profil CV Pelanggan',


            'tentang'         => 'Jenis kelamin: ' . $pelanggan->gender
            . ' | Tanggal lahir: ' . $pelanggan->birthday,


            'email'           => $pelanggan->email,
            'telepon'         => $pelanggan->phone,


            'list_pendidikan' => [],
            'keahlian'        => [],
        ];


        return view('home', $data);
    }


}