<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('business.update', [$data->id]), 'method' => 'put']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Status Perusahaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('status', 'Status') !!}
                <select class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')" oninput="this.setCustomValidity('')" name="status">
                    <option value="1" {{ ($data->status == 1 ? "selected":"") }}>Aktif</option>
                    <option value="2" {{ ($data->status == 2 ? "selected":"") }}>Non Aktif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>