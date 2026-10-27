<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; color: #334155; }
        .card-custom { border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); background: #ffffff; }
        .table th { background-color: #f1f5f9; color: #475569; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; padding: 14px 16px; }
        .table td { padding: 14px 16px; font-size: 13px; }
        .btn-action { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s; }
    </style>
</head>
<body class="py-4">

<div class="container" style="max-width: 1100px;">
    <!-- TOP HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1"><i class="bi bi-folder-symlink text-primary me-2"></i>Manajemen Data CV</h3>
            <p class="text-muted small mb-0">Kelola riwayat pekerjaan, data mahasiswa, dan cetak tampilan CV individual.</p>
        </div>
        <div class="d-flex gap-2">
            @if($pengalaman->first())
            <button class="btn btn-outline-primary fw-semibold rounded-3 px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalEditProfil">
                <i class="bi bi-person-gear me-1"></i> Edit Profil Sinkron
            </button>
            @endif
            <button class="btn btn-primary fw-semibold rounded-3 px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Data
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- DATA TABLE CARD -->
    <div class="card card-custom overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h6 class="fw-bold text-dark mb-0"><i class="bi bi-table text-primary me-2"></i>Tabel Pangkalan Data: <span class="text-primary font-monospace">cv_2555301114</span></h6>
            </div>
            <span class="badge bg-primary-subtle text-primary font-monospace px-3 py-2 rounded-pill">Total: {{ $pengalaman->count() }} Data</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>TTL</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Periode</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengalaman as $index => $item)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">{{ $index + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $item->nama }}</td>
                            <td class="text-secondary font-monospace">{{ $item->nim }}</td>
                            <td class="text-secondary">{{ $item->kelas }}</td>
                            <td class="text-secondary">{{ $item->tempat_lahir }}, {{ date('d/m/Y', strtotime($item->tanggal_lahir)) }}</td>
                            <td class="fw-semibold text-primary">{{ $item->posisi }}</td>
                            <td class="text-secondary">{{ $item->perusahaan }}</td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">{{ $item->periode }}</span></td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('cv.show', $item->id) }}" class="btn btn-sm btn-success px-2 py-1 rounded-2 text-white text-decoration-none fw-medium" title="Lihat & Cetak CV" target="_blank">
                                        <i class="bi bi-eye me-1"></i> CV
                                    </a>
                                    <button class="btn btn-action btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('cv.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-light border text-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- MODAL EDIT DATA -->
                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Data Pekerjaan</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('cv.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-6"><label class="form-label small fw-bold">NIM</label><input type="text" name="nim" class="form-control" value="{{ $item->nim }}" required></div>
                                                <div class="col-6"><label class="form-label small fw-bold">Kelas</label><input type="text" name="kelas" class="form-control" value="{{ $item->kelas }}" required></div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-6"><label class="form-label small fw-bold">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" value="{{ $item->tempat_lahir }}" required></div>
                                                <div class="col-6"><label class="form-label small fw-bold">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" value="{{ $item->tanggal_lahir }}" required></div>
                                            </div>
                                            <div class="mb-3"><label class="form-label small fw-bold">Posisi Pekerjaan</label><input type="text" name="posisi" class="form-control" value="{{ $item->posisi }}" required></div>
                                            <div class="mb-3"><label class="form-label small fw-bold">Nama Perusahaan</label><input type="text" name="perusahaan" class="form-control" value="{{ $item->perusahaan }}" required></div>
                                            <div class="mb-3"><label class="form-label small fw-bold">Periode</label><input type="text" name="periode" class="form-control" value="{{ $item->periode }}" required></div>
                                        </div>
                                        <div class="modal-footer border-top bg-light py-2">
                                            <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted small">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data di tabel <span class="font-monospace">cv_2555301114</span>. Klik <strong>+ Tambah Data</strong>.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PROFIL SINKRON -->
@if($pengalaman->first())
<div class="modal fade" id="modalEditProfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom py-3">
                <h6 class="modal-title fw-bold"><i class="bi bi-person-gear text-primary me-2"></i>Edit Profil Global (Ubah Semua Baris)</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cv.updateProfile', $pengalaman->first()->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $pengalaman->first()->nama }}" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><label class="form-label small fw-bold">NIM</label><input type="text" name="nim" class="form-control" value="{{ $pengalaman->first()->nim }}" required></div>
                        <div class="col-6"><label class="form-label small fw-bold">Kelas</label><input type="text" name="kelas" class="form-control" value="{{ $pengalaman->first()->kelas }}" required></div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><label class="form-label small fw-bold">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" value="{{ $pengalaman->first()->tempat_lahir }}" required></div>
                        <div class="col-6"><label class="form-label small fw-bold">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" value="{{ $pengalaman->first()->tanggal_lahir }}" required></div>
                    </div>
                    <div class="mb-3"><label class="form-label small fw-bold">Posisi / Title Utama</label><input type="text" name="posisi" class="form-control" value="{{ $pengalaman->first()->posisi }}" required></div>
                </div>
                <div class="modal-footer border-top bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update Seluruh Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom py-3">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-circle text-primary me-2"></i>Tambah Data Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cv.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3"><label class="form-label small fw-bold">Nama Lengkap</label><input type="text" name="nama" class="form-control" placeholder="Contoh: Mirza" required></div>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><label class="form-label small fw-bold">NIM</label><input type="text" name="nim" class="form-control" placeholder="2555301114" required></div>
                        <div class="col-6"><label class="form-label small fw-bold">Kelas</label><input type="text" name="kelas" class="form-control" placeholder="TI-3A" required></div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6"><label class="form-label small fw-bold">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" placeholder="Pekanbaru" required></div>
                        <div class="col-6"><label class="form-label small fw-bold">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" required></div>
                    </div>
                    <div class="mb-3"><label class="form-label small fw-bold">Posisi Pekerjaan</label><input type="text" name="posisi" class="form-control" placeholder="Laravel Developer" required></div>
                    <div class="mb-3"><label class="form-label small fw-bold">Nama Perusahaan</label><input type="text" name="perusahaan" class="form-control" placeholder="PT Inovasi Web" required></div>
                    <div class="mb-3"><label class="form-label small fw-bold">Periode</label><input type="text" name="periode" class="form-control" placeholder="2021 - 2023" required></div>
                </div>
                <div class="modal-footer border-top bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>