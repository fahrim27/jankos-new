<div class="modal-dialog modal-lg" role="document" style="margin-top:5%;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">List Upload Dokumen, Team <strong>{{$data->team}}</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Tanggal Upload</th>
                            <th>Team</th>
                            <th>Sekolah</th>
                            <th>Kategori lomba</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->documents as $value)
                            <tr>
                                <!--<td><iframe src="{{ asset('storage/uploads/document/'.$value->document) }}" width="100%" height="100%" scrolling="no" style="border: none;"></iframe></td>-->
                                <td>{{ $value->title ?? '' }}</td>
                                <td>{{ $value->type ?? '' }}</td>
                                <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                                <td>{{ $value->team->team ?? '' }}</td>
                                <td>{{ $value->team->school ?? '' }}</td>
                                <td>{{ $value->type ?? '' }}</td>
                                <td><a href="{{ asset('storage/uploads/document/'.$value->document) }}" download="{{$value->document}}"><span class="badge badge-pill badge-primary" style="cursor: pointer;" ><i class="feather icon-download" title="Unduh"> Unduh</i></span></a></td>
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