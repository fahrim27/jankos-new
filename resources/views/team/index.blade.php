@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title mb-0">Data Team</h2>
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
                                            <th>Nama</th>
                                            <th>No. WA</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ $value->name ?? '' }}</td>
                                                <td>(+62) {{ $value->phone ?? '' }}</td>
                                                <td>{{ $value->user_std->email ?? '' }}</td>
                                                <td>{{ $value->user_std->password_default ?? '' }}</td>
                                                <td>
                                                    @if (auth()->user()->hasRole('Teacher'))
                                                        <span class="btn-edit badge badge-pill badge-primary" style="cursor: pointer;" data-href="{{ route('teams.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"> Edit</i></span>
                                                        <span class="action-delete badge badge-pill badge-danger" style="cursor: pointer;" data-href="{{ route('teams.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"> Delete</i></span>
                                                    @endif
                                                </td>
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
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable();

        $('.datatable').on('click', '.btn-edit', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.datatable').on('click', '.btn-show', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.action-delete', function(e){
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    btn.closest('td').parent('tr').fadeOut();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                })
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection