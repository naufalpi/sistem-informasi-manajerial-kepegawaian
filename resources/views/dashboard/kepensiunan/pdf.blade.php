<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Rekomendasi Mutasi Pegawai</title>
    <style>
        /* Gaya CSS untuk PDF */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            align-items: center;
        }

        .logo {
            margin-right: 10px;
        }

        .title {
            text-align: center;
        }

        .title h1 {
            font-size: 20px;
            margin: 0;
        }

        .title p {
            font-size: 12px;
        }

        .label {
            font-weight: bold;
        }
        .content {
            font-size: 14px;
        }
        .content p {
            margin: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .table th, .table td {
            padding: 5px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="image/logo-banjarnegara.png" alt="Logo" style="width: 70px; height: auto; float: left; margin-right: 10px; object-fit: cover;">
        </div>
        <div class="title">
            <h1>PEMERINTAHAN KABUPATEN BANJARNEGARA</h1>
            <h1>KECAMATAN WANADADI</h1>
            <h1>DESA WANAKARSA</h1>
            <p>Alamat: Jl.Raya Timur Wanadadi No 42 KM 01 Email: wanakarsadesa@gmail.com Kode Pos: 53461 Telp/Hp: 082136880596 Website: https://wanakarsa-wanadadi.desa.id</p>
        </div>
    </div>
    <hr style="border: none; border-top: 4px solid black; margin-top: 2px;">

    <div style="display: flex; justify-content: space-between;">
        <div class="content" style="float: right;">
            <p>Wanadadi, {{ $kepensiunan->tgl_surat_formatted }}</p>
        </div>
        <div class="content" style="float: left;">
            <table>
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $kepensiunan->nomor }}</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>: Penting</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>: {{ $kepensiunan->jml_lampiran }}</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td><span class="label" style="word-wrap: break-word;">: {{ $kepensiunan->perihal }}</span></td>
                </tr>
            </table>
        </div>
    </div>
    
    
    <div class="content" style="clear: both; ">
        <p>Kepada:</p>
        <p>Yth. Camat Kec. Wanadadi</p>
        <p>Di-</p>
        <p>Wanadadi</p>
    </div>
    <br>
    <div class="content" style="text-align: justify;">
        <p>Bersama ini kami sampaikan dengan hormat, bahwa berdasarkan Peraturan Menteri Dalam Negeri Nomor 83 Tahun 2015 tentang Pengangkatan dan Pemberhentian Perangkat Desa sebagaiamana telah diubah dengan Peraturan Menteri Dalam Negeri Nomor 67 Tahun 2017 tentang Perubahan atas Peraturan Menteri Dalam Negeri Nomor 83 Tahun 2015 tentang Pengangkatan dan Pemberhentian Perangkat Desa.</p><br>
        <p>Karena Saudara/i {{ $kepensiunan->perangkat_desa }} menjadi {{ $kepensiunan->jabatan }} sebagaimana Keputusan Kepala Desa Wanakarsa Nomor {{ $kepensiunan->nomor_kkd }} tertanggal {{ $kepensiunan->tanggal_kkd_formatted }} telah {{ $kepensiunan->penyebab }}, maka dengan ini mohon kepada Saudara Camat Wanadadi untuk memberikan rekomendasi untuk pemberhentiannya dari Perangkat Desa dalam jabatan {{ $kepensiunan->jabatan }}.</p><br>
        
        <p>Sebagai pendukungnya, bersama ini disampaikan: </p>
        <article class="my-3">
            {!! $kepensiunan->lampiran !!}
        </article><br>
        <p>Demikian Surat Permohonan ini disampaikan, terima kasih atas perhatian dan kerjasamanya.</p><br><br>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <div class="content" style="float: right;">
            <p>Kepala Desa Wanakarsa</p><br><br><br><br>
            <p>{{ $kepensiunan->kepala_desa }}</p>
        </div>
    </div>
   
</body>
</html>
