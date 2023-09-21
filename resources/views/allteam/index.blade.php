@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title mb-0">Data Team (All/ Global)</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Data list view starts -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Mendaftar</th>
                                            <th>Nama Team</th>
                                            <th>Sekolahan</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Data Anggota</th>
                                            <th>Data Dokumen</th>
                                            <th>Data Pelaporan</th>
                                            <th>Data Member</th>
                                            <th>Data Transfers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            @if($value->hasRole('Teacher'))
                                            <tr>
                                                <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->team ?? '' }}</td>
                                                <td>{{ $value->school ?? '' }}</td>
                                                <td>{{ $value->name ?? '' }} (+62{{ $value->phone ?? ''  }})</td>
                                                <td class="btn-teams" style="cursor: pointer; font-size:17px;" data-href="{{ route('all-teams.show', [$value->id]) }}" ><span class="badge badge-pill badge-info" style="cursor: pointer;">{{ $value->teams->count() }} Peserta</span></td> 
                                                <td class="btn-documents" style="cursor: pointer; font-size:17px;" data-href="{{ route('all-teams.documents', [$value->id]) }}"><span class="badge badge-pill badge-info" style="cursor: pointer;">{{ $value->documents->count() }} Dokumen</span></td> 
                                                <td class="btn-logbooks" style="cursor: pointer; font-size:17px;" data-href="{{ route('all-teams.logbooks', [$value->id]) }}" ><span class="badge badge-pill badge-info" style="cursor: pointer;">{{ $value->logbooks->count() }} Logbook</span></td> 
                                                <td class="btn-members" style="cursor: pointer; font-size:17px;" data-href="{{ route('all-teams.members', [$value->id]) }}"><span class="badge badge-pill badge-info" style="cursor: pointer;">{{ $value->members->count() }} Member</span></td> 
                                                <td class="btn-add" style="cursor: pointer; font-size:17px;" data-href="{{ route('all-teams.adds', [$value->id]) }}"><span class="badge badge-pill badge-info" style="cursor: pointer;">{{ $value->transfers->count() }} Transaksi</span></td> 
                                                <!-- <td>
                                                    @if (auth()->user()->hasRole('Teacher'))
                                                        <span class="btn-edit badge badge-pill badge-primary" style="cursor: pointer;" data-href="{{ route('teams.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"> Edit</i></span>
                                                        <span class="action-delete badge badge-pill badge-danger" style="cursor: pointer;" data-href="{{ route('teams.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"> Delete</i></span>
                                                    @endif
                                                </td> -->
                                            </tr>
                                            @endif
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
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable();

        $('.datatable').on('click', '.btn-teams', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.btn-logbooks', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.btn-members', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.btn-documents', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.datatable').on('click', '.btn-add', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

    </script>
@endsection