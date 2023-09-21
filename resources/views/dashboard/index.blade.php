@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-analytics.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/flag-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/perfect-scrollbar.css') }}">
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/node-waves.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/typeahead.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/new/theme-default.css') }}">
@endsection

@section('content')
<div class="content-header row">
</div>
<div class="content-body">
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!--@if(auth()->user()->profile)-->
                <!--    @if(auth()->user()->profile->s1 || auth()->user()->profile->s2 || auth()->user()->profile->s3)-->
                <!--        @if(auth()->user()->profile->s1_instansi || auth()->user()->profile->s2_instansi || auth()->user()->profile->s3_instansi)-->
                <!--            <div class="alert alert-warning show" role="alert">-->
                <!--              <strong>Akun anda dalam keadaan bagus,</strong> <a route="{{ route('setting.indexProfile') }}">klik disini!</a> untuk melengkapi kembali data pribadi anda.-->
                <!--              <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
                <!--                <span aria-hidden="true">&times;</span>-->
                <!--              </button>-->
                <!--            </div>-->
                <!--        @endif-->
                <!--    @endif-->
                <!--@endif-->
                
                <div class="card {{ $bg }} text-white">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <img src="{{ asset('app-assets/images/elements/decore-left.png') }}" class="img-left">
                            <img src="{{ asset('app-assets/images/elements/decore-right.png') }}" class="img-right">
                            <div class="avatar avatar-xl {{ $bg }} shadow mt-0">
                                <div class="avatar-content">
                                    <i class="{{ $icon }} white font-large-1"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                @if (auth()->user()->hasRole('Teacher'))
                                    <h1 class="mb-2 text-white">{{ $title }}</h1>
                                    <p class="m-auto w-75">{{ $message }}</p>
                                @else
                                    <h2 class="mb-2 text-white">Selamat Datang Pada Halaman Admin Event</h2>
                                    <p class="m-auto w-75">Semoga hari anda baik dan sehat selalu, Semangat!!!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Analytics end -->

</div>

@if (auth()->user()->hasRole('Teacher'))
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
        
          <!-- Timeline Advanced-->
          <div class="col-xl-6">
            <div class="card">
              <h6 class="card-header">Lomba Marketing Produk</h6>
              <div class="card-body pb-0">
                <ul class="timeline mt-3 mb-0">
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="feather icon-mic"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Syarat dan Ketentuan</h6>
                      </div>
                        <i class="feather icon-link"> </i>
                        <a target="_blank" href="https://drive.google.com/file/d/1dN3HSYyVouplwwfA1SC5s0xS8UB9fYpe/view?usp=sharing"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Baca Disini
                        </button></a>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Pendaftaran Peserta Lomba</h6>
                      </div>
                        <i class="feather icon-users"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->count() == 5)
                        <a href="{{ route('teams.index') }}"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Lihat Team anda
                        </button></a>
                        @else
                        <button data-href="{{ route('teams.create', 1) }}" class="btn-teams btn btn-outline-danger btn-sm my-sm-0 my-3">
                           Daftar Disini
                        </button>
                        @endif
                    </div>
                  </li>
                  <!-- <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Upload File Presentasi</h6>
                      </div>
                        <i class="feather icon-file"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 1)->count() == 1)
                        <button data-href="{{ route('documents.create') }}" class="btn-documents btn btn-outline-info btn-sm my-sm-0 my-3">
                           Upload Disini
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-danger btn-sm my-sm-0 my-3 text-nowrap" data-toggle="tooltip" data-placement="top" title="Silahkan Lengkapi pendafatan member untuk kategori lomba Presenter Produk, untuk dapat melanjutkan.">
                           Upload Disini
                        </button>
                        @endif
                    </div>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>
          <!-- /Timeline Advanced-->
        
          <!-- Timeline Advanced-->
          <!-- <div class="col-xl-6">
            <div class="card">
              <h6 class="card-header">Lomba Video Produk</h6>
              <div class="card-body pb-0">
                <ul class="timeline mt-3 mb-0">
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="feather icon-video"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Syarat dan Ketentuan</h6>
                      </div>
                        <i class="feather icon-link"> </i>
                        <a target="_blank" href="https://drive.google.com/file/d/1VbcnkUnqs8LOD1Xvp06V5L-ibdgz8CkP/view?usp=sharing"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Baca Disini
                        </button></a>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Pendaftaran Peserta Lomba</h6>
                      </div>
                        <i class="feather icon-users"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 2)->count() < 3)
                        <button data-href="{{ route('teams.create', 2) }}" class="btn btn-teams btn-outline-danger btn-sm my-sm-0 my-3">
                           Daftar Disini
                        </button>
                        @else
                        <a href="{{ route('teams.index') }}"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Lihat Team anda
                        </button></a>
                        @endif
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Upload File Video</h6>
                      </div>
                        <i class="feather icon-youtube"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 2)->count() == 3)
                        <button data-href="{{ route('videos.create') }}" class="btn-video btn btn-outline-info btn-sm my-sm-0 my-3">
                           Upload Disini
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-danger btn-sm my-sm-0 my-3 text-nowrap" data-toggle="tooltip" data-placement="top" title="Silahkan Lengkapi pendafatan member untuk kategori lomba Video, untuk dapat melanjutkan.">
                           Upload Disini
                        </button>
                        @endif
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
          <!-- /Timeline Advanced-->
        
          <!-- Timeline Advanced-->
          <!-- <div class="col-xl-3"></div>
          <div class="col-xl-6">
            <div class="card">
              <h6 class="card-header">Lomba Marketing Produk</h6>
              <div class="card-body pb-0">
                <ul class="timeline mt-3 mb-0">
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="feather icon-shopping-bag"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Syarat dan Ketentuan</h6>
                      </div>
                        <i class="feather icon-link"> </i>
                        <a target="_blank" href="https://drive.google.com/file/d/1Q0d5BUUJo5_ZTx4XDFh5tK9YOqL1sv0S/view?usp=sharing"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Baca Disini
                        </button></a>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-users-group"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Pendaftaran Peserta Lomba</h6>
                      </div>
                        <i class="feather icon-users"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 3)->count() < 5)
                        <button data-href="{{ route('teams.create', 3) }}" class="btn-teams btn btn-outline-danger btn-sm my-sm-0 my-3">
                           Daftar Disini
                        </button>
                        @else
                        <a href="{{ route('teams.index') }}"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Lihat Team anda
                        </button></a>
                        @endif
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-users-group"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Pendaftaran Member</h6>
                      </div>
                        <i class="feather icon-user-check"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 3)->count() == 5)
                        <button data-href="{{ route('members.create') }}" class="btn-member btn btn-outline-info btn-sm my-sm-0 my-3">
                           Daftarkan Disini
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-danger btn-sm my-sm-0 my-3 text-nowrap" data-toggle="tooltip" data-placement="top" title="Silahkan Lengkapi pendafatan member untuk kategori lomba Presenter Produk, untuk dapat melanjutkan.">
                           Daftarkan Disini
                        </button>
                        @endif
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="ti ti-users-group"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Upload Bukti Transfer</h6>
                      </div>
                        <i class="feather icon-tag"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 3)->count() == 5)
                        <button data-href="{{ route('transfers.create') }}" class="btn-transfer btn btn-outline-info btn-sm my-sm-0 my-3">
                           Upload Disini
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-danger btn-sm my-sm-0 my-3 text-nowrap" data-toggle="tooltip" data-placement="top" title="Silahkan Lengkapi pendafatan member untuk kategori lomba Presenter Produk, untuk dapat melanjutkan.">
                           Upload Disini
                        </button>
                        @endif
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
          <!-- /Timeline Advanced-->
        </div>
        
        <div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
    </div>
@endif

@if (auth()->user()->hasRole('Student'))
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
        
          <div class="col-xl-6">
            <div class="card">
              <h6 class="card-header">Lomba Marketing Produk</h6>
              <div class="card-body pb-0">
                <ul class="timeline mt-3 mb-0">
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class="feather icon-mic"></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Syarat dan Ketentuan</h6>
                      </div>
                        <i class="feather icon-link"> </i>
                        <a target="_blank" href="https://drive.google.com/file/d/1dN3HSYyVouplwwfA1SC5s0xS8UB9fYpe/view?usp=sharing"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Baca Disini
                        </button></a>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Pendaftaran Peserta Lomba</h6>
                      </div>
                        <i class="feather icon-users"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->count() == 5)
                        <a href="{{ route('teams.index') }}"><button class="btn btn-outline-info btn-sm my-sm-0 my-3">
                           Lihat Team anda
                        </button></a>
                        @else
                        <button data-href="{{ route('teams.create', 1) }}" class="btn-teams btn btn-outline-danger btn-sm my-sm-0 my-3">
                           Daftar Disini
                        </button>
                        @endif
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-primary pb-4 border-left-dashed">
                    <span class="timeline-indicator timeline-indicator-primary">
                      <i class=""></i>
                    </span>
                    <div class="timeline-event">
                      <div class="timeline-header border-bottom mb-3">
                        <h6 class="mb-0">Upload File Presentasi</h6>
                      </div>
                        <i class="feather icon-file"> </i>
                        @if(App\Team::where('team_id', auth()->user()->id)->where('category_id', 1)->count() == 1)
                        <button data-href="{{ route('documents.create') }}" class="btn-documents btn btn-outline-info btn-sm my-sm-0 my-3">
                           Upload Disini
                        </button>
                        @else
                        <button type="button" class="btn btn-outline-danger btn-sm my-sm-0 my-3 text-nowrap" data-toggle="tooltip" data-placement="top" title="Silahkan Lengkapi pendafatan member untuk kategori lomba Presenter Produk, untuk dapat melanjutkan.">
                           Upload Disini
                        </button>
                        @endif
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        
        <div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
    </div>
@endif
@endsection

@section('js')
    <script type="text/javascript">
        $('.timeline-event').on('click', '.btn-teams', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.timeline-event').on('click', '.btn-documents', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.timeline-event').on('click', '.btn-video', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.timeline-event').on('click', '.btn-logbook', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.timeline-event').on('click', '.btn-member', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $('.timeline-event').on('click', '.btn-transfer', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
        
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    
    <script src="{{ asset('app-assets/js/scripts/pages/user-profile.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
@endsection