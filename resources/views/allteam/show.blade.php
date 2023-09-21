<div class="modal-dialog modal-lg" role="document" style="margin-top:5%;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Team <strong>{{$data->team}}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. WA</th>
                            <th>Team</th>
                            <th>Sekolah</th>
                            <th>Kategori lomba</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->teams as $value)
                            <tr>
                                <td><a href="{{ $value->image ? asset('storage/uploads/profile/'.$value->image) : asset('images/profile.png') }}">
                                    <img src="{{ $value->image ? asset('storage/uploads/profile/'.$value->image) : asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="46" width="46">
                                </a></td> 
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->address ?? '' }}</td>
                                <td>(+62) {{ $value->phone ?? '' }}</td>
                                <td>{{ $value->user->team ?? '' }}</td>
                                <td>{{ $value->user->school ?? '' }}</td>
                                <td>{{ $value->category->name ?? '' }}</td>
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