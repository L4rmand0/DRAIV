<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if($request->ajax()){
            //   echo 'ayax <pre>';
            //   print_r($request->get('register'));
            return $this->createAccount($request->get('register'));
        }else{
            $validation = $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
    
            $this->guard()->login($user);
    
            return $this->registered($request, $user)
                            ?: redirect($this->redirectPath());
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    public function formValidate(Request $request){
        $data_register = $request->get('register');
        // echo '<pre>';
        // print_r($request->all());
        $validator = $this->validator($data_register);
        $errors = $validator->errors()->getMessages();
        // print_r($errors);
        if(!empty($errors)){
            return response()->json(['errors' => $errors]);
        }else{
            return response()->json(['errors' => []]);
        }
    }
}
