<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV {{ $userCv->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; }
        .cv-card { max-width: 900px; margin: 40px auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; }
        .cv-sidebar { background: linear-gradient(145deg, #0f172a 0%, #1e1b4b 100%); color: #ffffff; padding: 40px 30px; }
        .cv-content { padding: 40px; background: #ffffff; }
        .avatar-img { width: 140px; height: 140px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.2); object-fit: cover; }
        .sidebar-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #818cf8; margin-bottom: 15px; }
        .content-title { font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #1e293b; margin-bottom: 20px; }
        .timeline { position: relative; padding-left: 20px; border-left: 2px solid #e2e8f0; }
        .timeline-item { position: relative; margin-bottom: 25px; }
        .timeline-dot { position: absolute; left: -26px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background-color: #4f46e5; border: 2px solid #ffffff; }
        .skill-chip { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.12); color: #e2e8f0; padding: 5px 12px; border-radius: 8px; font-size: 12px; display: inline-block; margin: 0 4px 6px 0; }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .cv-card { box-shadow: none; border: none; margin: 0; width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body class="py-3">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print" style="max-width: 900px; margin: 0 auto;">
        <a href="{{ route('cv.index') }}" class="btn btn-outline-secondary rounded-3"><i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard</a>
        <button class="btn btn-dark rounded-3 px-4" onclick="window.print()"><i class="bi bi-printer me-2"></i> Cetak PDF</button>
    </div>

    <div class="cv-card">
        <div class="row g-0">
            <div class="col-lg-4 cv-sidebar">
                <div class="text-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($userCv->nama) }}&background=6366f1&color=fff&size=150" class="avatar-img mb-3" alt="Foto Profil">
                    <h4 class="fw-bold text-white mb-1">{{ $userCv->nama }}</h4>
                    <span class="badge bg-primary bg-opacity-20 text-indigo-200 border border-primary border-opacity-30 rounded-pill px-3 py-2 font-monospace small">
                        {{ $userCv->posisi }}
                    </span>
                </div>

                <div class="mb-4">
                    <div class="sidebar-title"><i class="bi bi-person-vcard me-2"></i>Informasi Diri</div>
                    <div class="small d-flex flex-column gap-3 text-slate-300">
                        <div><span class="text-muted d-block small">NIM</span><strong class="text-white">{{ $userCv->nim }}</strong></div>
                        <div><span class="text-muted d-block small">Kelas</span><strong class="text-white">{{ $userCv->kelas }}</strong></div>
                        <div><span class="text-muted d-block small">Tempat, Tgl Lahir</span><strong class="text-white">{{ $userCv->tempat_lahir }}, {{ date('d M Y', strtotime($userCv->tanggal_lahir)) }}</strong></div>
                    </div>
                </div>

                <div>
                    <div class="sidebar-title"><i class="bi bi-tools me-2"></i>Keahlian Utama</div>
                    <span class="skill-chip">Laravel</span><span class="skill-chip">PHP 8</span><span class="skill-chip">MySQL</span><span class="skill-chip">Bootstrap 5</span>
                </div>
            </div>

            <div class="col-lg-8 cv-content">
                <div class="mb-5">
                    <div class="content-title"><i class="bi bi-journal-text me-2 text-primary"></i>Ringkasan Profil</div>
                    <p class="text-secondary small leading-relaxed mb-0">Developer handal yang berfokus pada pengembangan aplikasi web modern dan responsif berbasis Laravel.</p>
                </div>

                <div class="mb-5">
                    <div class="content-title"><i class="bi bi-briefcase me-2 text-primary"></i>Pengalaman Kerja</div>
                    <div class="timeline">
                        @foreach($riwayatKerja as $p)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">{{ $p->posisi }}</h6>
                                <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3 py-1" style="font-size: 11px;">{{ $p->periode }}</span>
                            </div>
                            <p class="text-primary fw-medium small mb-1"><i class="bi bi-building me-1"></i>{{ $p->perusahaan }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div class="content-title"><i class="bi bi-mortarboard me-2 text-primary"></i>Pendidikan</div>
                    <div class="bg-light p-3 rounded-3 border-start border-4 border-primary d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">S1 Teknik Informatika</h6>
                            <p class="text-muted small mb-0">Perguruan Tinggi / Universitas</p>
                        </div>
                        <span class="badge bg-white text-dark border px-3 py-2 rounded-2 fw-medium" style="font-size: 11px;">2021 — Sekarang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>