@extends('dashboard.layouts.main')

@section('container')

<section class="section dashboard">

    <div class="row">

        <div class="col-lg-12">
            <div class="row">
          
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
  
                  <div class="card-body">
                    <h5 class="card-title">Log Activity</h5>
  
                    <table class="table  datatable table-sm" id="reportsTable">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">User</th>
                          <th scope="col">Event</th>
                          <th scope="col" data-sortable="false">Before</th>
                          <th scope="col" data-sortable="false">After</th>
                          <th scope="col" data-sortable="false">Description</th>
                          <th scope="col">Log At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($logs as $log)
                        <tr>
                          <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                          <td>{{ $log->causer->name }}</td>
                          <td>{{ $log->event }}</td>
                          <td>
                            @if (@is_array($log->changes['old']))
                                @foreach ($log->changes['old'] as $key => $logChange)
                                    {{ $key }} : {{ $logChange }} <br>
                                @endforeach
                            @endif
                          </td>
                          <td>
                            @if (@is_array($log->changes['attributes']))
                                @foreach ($log->changes['attributes'] as $key => $logChange)
                                    {{ $key }} : {{ $logChange }} <br>
                                @endforeach
                            @endif
                          </td>
                          <td>{{ $log->description }}</td>
                          <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div>

            </div>
        </div>


    </div>


</section>


@endsection


@push('scripts')
    @php
        $pageTitle = 'Log Activity';
        $breadcrumbItem = 'Log Activity';
    @endphp
@endpush