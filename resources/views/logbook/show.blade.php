<div class="modal-dialog modal-lg" role="document">
    
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Detail Laporan Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('descriptions', 'Deskripsi') !!}
                <p class="form-control">{!! $data->description !!}</p>
            </div>
            <div class="form-group">
                <img src="{{ asset('storage/uploads/member/'.$data->image) }}" width="100%" height="100%" scrolling="no" style="border: none;"></iframe>
            </div>
        </div>
    </div>
    
</div>

<script>
    CKEDITOR.replace('content');

    $(document).ready(function (e) {
       $('#submit-doc').change(function(){
               
            $('#loading-gif').modal('show');
            var percentVal = '100%';
            bar.width(percentVal);
            bar.addClass("bg-success");
            percent.html(percentVal);
            $('#loading-gif').modal('hide'); 
      
       });
    });
</script>

<script type="text/javascript">
    $("#FileInput").on('change',function (e) {
        var labelVal = $(".title").text();
        var oldfileName = $(this).val();
            fileName = e.target.value.split( '\\' ).pop();
        $(".filename").val(fileName)
            if (oldfileName == fileName) {return false;}
            var extension = fileName.split('.').pop();
        if ($.inArray(extension,['jpg','jpeg','png']) >= 0) {
            $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
            $(".filelabel i, .filelabel .title").css({'color':'#208440'});
            $(".filelabel").css({'border':' 2px solid #208440'});
        }
        else if(extension == 'pdf'){
            $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
            $(".filelabel i, .filelabel .title").css({'color':'red'});
            $(".filelabel").css({'border':' 2px solid red'});
        }
        else if(extension == 'csv' || extension == 'xlsx'){
            $(".filelabel i").removeClass().addClass('fa fa-file-excel-o');
            $(".filelabel i, .filelabel .title").css({'color':'#00FF00'});
            $(".filelabel").css({'border':' 2px solid red'});
        }
        else if(extension == 'ppt' || extension == 'pptx'){
            $(".filelabel i").removeClass().addClass('fa fa-file-excel-o');
            $(".filelabel i, .filelabel .title").css({'color':'#FF0000'});
            $(".filelabel").css({'border':' 2px solid red'});
        }
        
    else if(extension == 'doc' || extension == 'docx'){
        $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
        $(".filelabel i, .filelabel .title").css({'color':'#2388df'});
        $(".filelabel").css({'border':' 2px solid #2388df'});
    }
        else{
            $(".filelabel i").removeClass().addClass('fa fa-file-o');
            $(".filelabel i, .filelabel .title").css({'color':'black'});
            $(".filelabel").css({'border':' 2px solid black'});
        }
        if(fileName ){
            if (fileName.length > 10){
                $(".filelabel .title").text(fileName);
            }
            else{
                $(".filelabel .title").text(fileName);
            }
        }
        else{
            $(".filelabel .title").text(labelVal);
        }
    });    
</script>