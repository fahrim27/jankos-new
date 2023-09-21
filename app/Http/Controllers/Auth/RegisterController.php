<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Mail\ApplicantMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'school' => ['required', 'string', 'max:255'],
            'team' => ['required', 'string', 'max:255'],
            'phone' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'school' => $data['school'],
            'team' => $data['team'],
            'phone' => $data['phone'],
            'norek' => $data['norek']
        ]);

        $data['role'] = "Teacher";
        $user->assignRole($data['role']);
        
        return $user;
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //event(new Registered($user = $this->create($request->all())));
        $user = $this->create($request->all());

        // $this->guard()->login($user);
        
        $data = (object)[
                'to' => $request->email,
                'title' => 'Marketing Talent Competition #1',
                'note' => '<div style="background: transparent; background-color: white;"><h2 style="font-weight: bold; text-align: center;">Jankos Glow Marketing Talent Competition #1</h2> <br><br><hr> <p style="text-align: justify;">Hi <strong>'.$request->team.'</strong>, Terima kasih telah mendaftar di <i>Jankos Glow Marketing Competition</i>. Akun anda masih belum aktif dan sedang dalam proses tahap review admin. Silahkan menunggu email balasan dari kami untuk mengetahui update status akun team anda.</p></div> <br><br><hr><hr> <div style="text-align: center; background: transparent; background-color: #f0f4f5;"><small style="text-align: center;">Powered by ArkaryaTechnoSolution</small></div>',
                'from' => 'no-reply@event.jankosglow.com',
            ];
        
        Mail::send([], [], function($message) use ($data) {
                $message->from($data->from);
                $message->to($data->to);
                $message->subject($data->title);
                $message->setBody($data->note, 'text/html');
            });
            
        flash('Pendaftaran Akun Anda Berhasil, Silahkan tunggu konfirmasi email dari admin saat akun anda selesai ditinjau. Terima Kasih!')->success();
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
