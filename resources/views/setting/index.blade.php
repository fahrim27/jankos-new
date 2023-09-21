@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title mb-0">Pengaturan</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                            Umum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="feather icon-lock mr-50 font-medium-3"></i>
                            Keamanan
                        </a>
                    </li>
                    @if ($user->hasRole('Super Admin'))
                        <li class="nav-item">
                            <a class="nav-link d-flex py-75" id="account-pill-config" data-toggle="pill" href="#account-vertical-config" aria-expanded="false">
                                <i class="fa fa-cog mr-50 font-medium-3"></i>
                                Configuration
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                
                                @if ($user->hasRole('Teacher'))
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    {!! Form::open(['url' => route('setting.updateUser'), 'method' => 'post', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('team', 'Nama Team') !!}
                                                    {!! Form::text('team', $user->team ?? '', ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('email', 'Email') !!}
                                                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('name', 'Nama Penanggung Jawab') !!}
                                                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('school', 'Instansi/ Sekolah') !!}
                                                    {!! Form::text('school', $user->school, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('phone', 'No. Telpon/ Whatsapp') !!}
                                                    {!! Form::number('phone', $user->phone, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('norek', 'No. Rekening') !!}
                                                    {!! Form::number('norek', $user->norek, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                @else
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    {!! Form::open(['url' => route('setting.updateUser'), 'method' => 'post', 'files' => true]) !!}
                                    <div class="media">
                                        <a href="javascript: void(0);">
                                            <img src="{{ $user->image ? Storage::url('uploads/'.$user->image) : asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                        </a>
                                        <div class="media-body mt-75">
                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                                                <input type="file" name="image" id="account-upload" hidden="">
                                            </div>
                                            <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG.</small></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('name', 'Nama') !!}
                                                    {!! Form::text('name', $user->name ?? '', ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    {!! Form::label('email', 'Email') !!}
                                                    {!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                @endif
                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    {!! Form::open(['url' => route('setting.updatePassword'), 'method' => 'post']) !!}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">Old Password</label>
                                                        <input type="password" name="old_password" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">New Password</label>
                                                        <input type="password" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Retype New
                                                            Password</label>
                                                        <input type="password" name="con_password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>

                                @if ($user->hasRole('Super Admin'))
                                    <div class="tab-pane fade " id="account-vertical-config" role="tabpanel" aria-labelledby="account-pill-config" aria-expanded="false">
                                        {!! Form::open(['url' => route('setting.updateMailer'), 'method' => 'post']) !!}
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_host', 'SMTP Host') !!}
                                                            {!! Form::text('mail_host', $setting->data['mail_host'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_port', 'SMTP Port') !!}
                                                            {!! Form::number('mail_port', $setting->data['mail_port'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_username', 'SMTP Username') !!}
                                                            {!! Form::text('mail_username', $setting->data['mail_username'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_password', 'SMTP Password') !!}
                                                            {!! Form::text('mail_password', $setting->data['mail_password'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_encryption', 'SMTP Encryption') !!}
                                                            {!! Form::text('mail_encryption', $setting->data['mail_encryption'] ?? 'tls', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_from_address', 'Mail From Address') !!}
                                                            {!! Form::text('mail_from_address', $setting->data['mail_from_address'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            {!! Form::label('mail_from_name', 'Mail From Name') !!}
                                                            {!! Form::text('mail_from_name', $setting->data['mail_from_address'] ?? '', ['class' => 'form-control', 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account setting page end -->

</div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace('address');
        CKEDITOR.replace('description');
    </script>

    <script type="text/javascript">
         $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Kategori Lomba",
            });
        
        });
        
        function showDiv(select){
           if(select.value==3){
            document.getElementById('hidden_div').style.display = "block";
            document.getElementById("tf").required = true;
           } else{
            document.getElementById('hidden_div').style.display = "none";
            document.getElementById("tf").required = false;
           }
        } 
    </script>
@endsection
