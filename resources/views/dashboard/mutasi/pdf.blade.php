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
            <p>Wanadadi, {{ $mutasi->tgl_surat_formatted }}</p>
        </div>
        <div class="content" style="float: left;">
            <table>
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $mutasi->nomor }}</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>: Penting</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>: {{ $mutasi->jml_lampiran }}</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td><span class="label" style="word-wrap: break-word;">: {{ $mutasi->perihal }}</span></td>
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
        <p>Bersama ini kami sampaikan dengan hormat, bahwa berdasarkan hasil musyawarah Pemerintah Desa Wanakarsa Tanggal {{ $mutasi->tgl_musyawarah_formatted }} perihal mutasi perangkat desa</p><br>
        <p>Maka dengan ini kepada Saudara Camat Wanadadi, Bapak {{ $mutasi->camat }} memberikan rekomendasi mutasi Perangkat Desa Wanakarsa atas nama Saudara {{  $mutasi->perangkat_desa}} dari jabatan lama sebagai {{ $mutasi->jabatan_lama }} menjadi jabatan baru sebagai {{ $mutasi->jabatan_baru }}.</p><br>
        <p>Sebagai pendukungnya, bersama ini disampaikan: </p>
        <article class="my-3">
            {!! $mutasi->lampiran !!}
        </article><br>
        <p>Demikian Surat Permohonan ini disampaikan, terima kasih atas perhatian dan kerjasamanya.</p><br><br>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <div class="content" style="float: right;">
            <p>Kepala Desa Wanakarsa</p><br><br><br><br>
            <p>{{ $mutasi->kepala_desa }}</p>
        </div>
    </div>
   
</body>
</html>
