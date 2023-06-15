<table class="table">
    <thead>
      <tr>
        <th scope="col" class="d-flex align-items-center align-middle">
          <div class="me-2">#</div>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-sort-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
              <li><a class="dropdown-item" href="#" onclick="sortData('nama')">Urutkan berdasarkan nama</a></li>
              <li><a class="dropdown-item" href="#" onclick="sortData('waktu')">Urutkan berdasarkan waktu</a></li>
            </ul>
          </div>
        </th>
        <th scope="col">Nama</th>
        <th scope="col">Jabatan</th>
        <th scope="col">Kegiatan</th>
        <th scope="col">Tanggal</th>
        <th scope="col" class="text-center">File</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($allReports as $report)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $report->user->name }}</td>
          <td>{{ $report->user->jabatan->name }}</td>
          <td>{{ $report->kegiatan }}</td>
          <td>{{ $report->tanggal }}</td>
          <td class="text-center">
            @if ($report->file)
              <a href="{{ asset('storage/'.$report->file) }}" target="_blank">
                <img src="/image/pdf.png" alt="" style="width: 20px">
              </a>
            @else
              N/A
            @endif
          </td>
          <td class="text-center">
            <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{-- {{ $allReports->links() }} --}}