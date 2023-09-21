<div class="modal-dialog modal-lg" role="document" style="margin-top:5%;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">List Member Terdaftar, Team <strong> {{$data->team}}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Id Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. WA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->members as $value)
                            <tr>
                                <td><a href="{{ $value->image ? asset('storage/uploads/member/'.$value->image) : asset('images/profile.png') }}">
                                    <img src="{{ $value->image ? asset('storage/uploads/member/'.$value->image) : asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="46" width="46">
                                </a></td> 
                                <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                                <td>{{ $value->unique_id ?? '' }}</td>
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->address ?? '' }}</td>
                                <td>(+62) {{ $value->phone ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
</div>
<script>

    $(document).ready(function (e) {
       $('#account-upload').change(function(){
               
        let reader = new FileReader();
        reader.onload = (e) => { 

          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
      
       });
    });
</script>