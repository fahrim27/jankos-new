@extends('layouts.landing')

@section('css')
    <style>
    </style>
@endsection

@section('content')

<!-- Page Title start -->
<div class="pageTitle">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <h1 class="page-heading">Lowongan Pekerjaan</h1>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="breadCrumb"><a href="{{route('home')}}">Home</a> / <span>Semua Lowongan</span></div>
      </div>
    </div>
  </div>
</div>
<!-- Page Title End -->

<div class="listpgWraper">
  <div class="container"> 
    
    <!-- Search Result and sidebar start -->
    <div class="row">
      <div class="col-md-3 col-sm-6"> 
        <!-- Side Bar start -->
        <div class="sidebar">
            <form action="{{route('home.lowongan')}}" method="get">
          <!-- Jobs By Title -->
            <div class="widget">
                <h4 class="widget-title">Mitra Perusahaan</h4>
                  @foreach(App\Business::where('status', 1)->orderBy('created_at', 'desc')->limit(10)->get() as $bisnis)
                    <div class="checkbox mb-3">
                      <label class="checkbox-inline" style="font-size: 11px;">
                          <input class="checkbox" type="checkbox" name="bisnis[]" value="{{$bisnis->id}}">
                          <span class="badge">{{$bisnis->jobs->count()}}</span>&nbsp;{{$bisnis->name}}
                          </label>
                    </div>
                  @endforeach
                <!-- title end --> 
            </div>
              
              <!-- Jobs By City -->
              <div class="widget">
                <h4 class="widget-title">Kategori Lowongan</h4>
                  @foreach(App\Category::orderBy('nama', 'ASC')->get()->random(15) as $cat)
                  <div class="checkbox mb-3">
                      <label class="checkbox-inline" style="font-size: 11px;">
                          <input class="checkbox" type="checkbox" name="category[]" value="{{$cat->id}}">
                          <span class="badge">{{$cat->job->count()}}</span>&nbsp;{{$cat->nama}}
                          </label>
                    </div>
                  @endforeach
               </div>
              <!-- Jobs By City end--> 
              
              <!-- Jobs By Experience -->
              <button type="submit" class="btn btn-sm btn-info" style="justify-content: center;" >Filter</button>
            </form>
          <!-- Jobs By Experience end --> 
        </div>
        
        <!-- Side Bar end --> 
      </div>
      <!--<div class="col-md-3 col-sm-6 pull-right"> -->
        <!-- Social Icons -->
      <!--  <div class="sidebar">-->
      <!--    <h4 class="widget-title">Follow Us</h4>-->
      <!--    <div class="social"> <a href="#" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="https://www.instagram.com/ucc.unesa/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> <a href="#" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="#" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> <a href="#" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a> </div>-->
          <!-- Social Icons end --> 
      <!--  </div>-->
        
        <!-- Sponsord By -->
        <!-- <div class="sidebar">
      <!--    <h4 class="widget-title">Sponsord By</h4>-->
      <!--    <div class="gad"><img src="images/googlead.jpg" alt="your alt text" /></div>-->
      <!--    <div class="gad"><img src="images/googlead.jpg" alt="your alt text" /></div>-->
      <!--    <div class="gad"><img src="images/googlead2.jpg" alt="your alt text" /></div>-->
      <!--    <div class="gad"><img src="images/googlead2.jpg" alt="your alt text" /></div>-->
      <!--  </div> -->
      <!--</div>-->
      <div class="col-md-8 col-sm-12"> 
        <!-- Search List -->
        <ul class="searchList">
          <!-- job start -->
          @foreach($data as $item)
          <li>
            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="jobimg"><img src="{{ $item->business->logo ? Storage::url('uploads-1/uploads-2/uploads/profile/'.$item->business->logo) : Storage::url('uploads-1/uploads-2/uploads/sponsor/default.png') }} " alt="{{$item->business->name}}" /></div>
                <div class="jobinfo">
                  <h3><a href="#." class="btn-show" style="cursor: pointer;" data-href="{{ route('home.showLowongan', [$item->id]) }}">{{$item->title}}</a></h3>
                  <div class="companyName"><a href="#.">{{$item->business->name}} | {{ strip_tags($item->business->address) }}</a></div>

                  @if(\Str::contains($item->type, 'Fulltime') )
                    <div class="location"><label class="fulltime">{{$item->type}}</label>
                      @if(count($item->city) > 0 )- 
                          @foreach($item->city as $city)
                          <span>{{$city->title}}</span>
                          @endforeach
                      @else- 
                          <span>Not Identified</span>
                      @endif
                      - 
                      <span>{{date('d/m/Y', strtotime($item->due_at))}}</span>
                    </div>
                    @elseif(\Str::contains($item->type, 'Parttime') )
                    <div class="location"><label class="parttime">{{$item->type}}</label>   - 
                      @if(count($item->city) > 0)- 
                          @foreach($item->city as $city)
                          <span>{{$city->title}}</span>
                          @endforeach
                      @else- 
                          <span>Not Identified</span>
                      @endif
                      - 
                      <span>{{date('d/m/Y', strtotime($item->due_at))}}</span>
                    </div>
                  @endif

                </div>
                <div class="clearfix"></div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="listbtn"><a class="" style="cursor: pointer;" href="#{{$item->id}}-detail" data-toggle="modal">Lihat Detail</a></div>
              </div>
            </div>
            <p>{{ strip_tags(Str::limit($item->description, 200)) }}</p>
          </li>
          @endforeach
          <!-- job end --> 
          
        </ul>
        
        <!-- Pagination Start -->
        @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="pagiWrap">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <div class="showreslt">Showing 1-10</div>
            </div>
            <div class="col-md-8 col-sm-8 text-right">
              <ul class="pagination">
                {{$data->links()}}
              </ul>
            </div>
          </div>
        </div>
        @else
        <div class="pagiWrap">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <div class="showreslt"></div>
            </div>
            <div class="col-md-8 col-sm-8 text-right">
              <ul class="pagination">
                <a href="{{route('home.lowongan')}}">< Kembali ke Semua Lowongan</a>
              </ul>
            </div>
          </div>
        </div>
        @endif
        <!-- Pagination end --> 
      </div>
    </div>
  </div>
</div>

@foreach($data as $item)
<div class="modal" id="{{$item->id}}-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Detail Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <img width="100rem" height="100rem" src="{{ ($item->business && $item->business->logo) ? Storage::url('uploads-1/uploads-2/uploads/profile/'.$item->business->logo) :Storage::url('uploads-1/uploads-2/uploads/sponsor/default.png') }}" alt="">
                        <h5 class="mt-1">{{ $item->business->name ?? '' }}</h5>
                    </div>
                    <div class="col-md-10">
                        <h3 class="mb-0">{{ $item->title ?? '' }}</h3>
                        <hr>
                        <ul>
                            <span class="text-medium" style="font-size: 15px; line-height: 1.3;"><li><b>Jenis Pekerjaan:</b> {{ $item->type ?? '-' }} <br></li> <li><b>Minimal Study:</b> {{ $item->study ?? '-' }}</li> <li><b>Deadline:</b> {{ date('d-m-Y', strtotime($item->due_at)) ?? '-' }}</li></span>
                            <li> 
                                <hr>
                                <span class="text-medium" style="font-size: 15.5px; line-height: 1.1;">
                                    {!! $item->description ?? '' !!}
                                </span>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if (auth()->user())
                    @if(auth()->user()->hasRole('Jobseeker'))
                        @if(App\JobApplicant::where('user_id', auth()->user()->id)->where('business_id', $item->business_id)->count() < 4)
                            <button data-dismiss="modal" data-toggle="modal" class="btn btn-primary btn-apply-form" href="#{{$item->id}}-apply">Lamar</button>
                        @else
                            <button class="btn btn-warning" data-href="#">Maaf! Lamaran anda untuk Perusahaan {{$item->business->name}}, telah dibatasi</button>
                        @endif
                    @endif
                @else
                    <a class="btn btn-primary" href="{{ route('login') }}">Login Untuk Melamar</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal" id="{{$item->id}}-apply">
    <div class="modal-dialog modal-xl" role="document">
        {!! Form::open(['url' => route('jobs.apply', [$item->id]), 'method' => 'post', 'files' => true]) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Lamar Pekerjaan "{{$item->title}}"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            {!! Form::label('note', 'Motivation Letter') !!}
                            {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    
                    <div class="col-md">
                        <fieldset class="form-group">
                            <label for="lampiran">File Lampiran (opsional)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="lampiran" name="lampiran">
                                <label class="custom-file-label" for="lampiran">Pilih file</label>
                            </div>
                        </fieldset>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-apply" data-href="">Lamar</button>
            </div>
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endforeach
<!--<div class="modal fade child-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>-->
@endsection

@section('js')
<script src="{{ asset('template-landing/js/bootstrap.min.js')}}"></script>
    <script>
        
        $('.btn-apply').on('click', function(e){
            var t = $('.child-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
    
    </script>
<script>
    CKEDITOR.replace('note');
</script>
@endsection