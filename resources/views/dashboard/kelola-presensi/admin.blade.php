@extends('dashboard.layouts.main')

@section('container')

<section class="section">

    <button id="bukaPresensi">Buka Presensi</button>
    <div id="qrCodeContainer"></div>

</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bukaPresensi').click(function() {
            $.ajax({
                url: '/dashboard/buka-presensi',
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#qrCodeContainer').html('<img src="' + response.qr_code + '" alt="QR Code" />');
                    setTimeout(function() {
                        location.reload();
                    }, 600000); // Reload halaman setelah 10 menit (600000 ms)
                }
            });
        });
    });
</script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Presensi Pegawai';
        $breadcrumbItem = 'Kelola Presensi Pegawai';
    @endphp
@endpush
