<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('transfers.update', [$data->id]), 'method' => 'put', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Bukti Transfer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <a href="javascript: void(0);">
                    <img id="preview-image-before-upload" src="{{ asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="100" width="120">
                </a>
                <div class="media-body mt-75">
                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                        <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                        <input type="file" name="image" id="account-upload" hidden="">
                    </div>
                    <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG.</small></p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('norek', 'No. Rekening') !!}
                {!! Form::number('norek', $data->norek, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('amount', 'Jumlah') !!}
                {!! Form::number('amount', $data->amount, ['class' => 'form-control', 'min'=> '1', 'step'=> 'any', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('description');

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