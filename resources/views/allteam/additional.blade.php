<div class="modal-dialog modal-lg" role="document" style="margin-top:5%;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Catatan Transfer, Team <strong>{{$data->team}}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Bukti</th>
                            <th>No. Rekening</th>
                            <th>Nama Sekolah</th>
                            <th>No. Wa</th>
                            <th>Team</th>
                            <th>Sekolah</th>
                            <th>Kategori lomba</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->logbooks as $value)
                            <tr>
                                <td><a href="{{ $value->tf ? asset('storage/uploads/tf/'.$value->tf) : asset('images/profile.png') }}">
                                    <img src="{{ $value->tf ? asset('storage/uploads/tf/'.$value->tf) : asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="90" width="120">
                                </a></td> 
                                <td>{{ $value->norek ?? '' }}</td>
                                <td>{{ $value->school ?? '' }}</td>
                                <td>{{ $value->phone ?? '' }}</td>
                                <td>{{ $value->team->team ?? '' }}</td>
                                <td>{{ $value->team->school ?? '' }}</td>
                                <td>Marketing Produk</td>
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