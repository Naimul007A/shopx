<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller {
    // login form show
    public function login() {
        return view( 'Frontend.login' );
    }
    //login validation check
    public function loginProccess( Request $request ) {
        $validetor = Validator::make( $request->all(), [
            'email'    => ' required | email',
            'password' => 'required|',
        ] );
        if ( $validetor->fails() ) {
            return redirect()->back()->withErrors( $validetor )->withInput();
        } else {
            $credentials = $request->except( '_token' );

            if ( Auth::attempt( $credentials ) ) {
                $user = auth()->user();
                if ( $user->email_verified == 0 ) {
                    auth()->logout();
                    $this->SeterrorMessage( 'Your Account is not active.Please active your account.' );
                    return redirect()->back()->withInput();
                } else {
                    User::where( 'email', $user->email )
                        ->update( [
                            'last_login' => Carbon::now(),
                        ] );
                    return redirect()->route( 'Frontend.home' );
                }

            } else {
                $this->SeterrorMessage( 'Email or Password invaild.' );
                return redirect()->back()->withInput();
            }

        }
    }
    //logout user
    public function logout() {
        Auth::logout();
        $this->SetsuccessMessage( 'You are logout.' );
        return redirect()->route( 'login' );
    }
    //user registration form
    public function registration() {
        return view( 'Frontend.registration' );
    }
    // user registration validation
    public function registrationProccess( Request $request ) {
        $validator = validator::make( $request->all(), [
            'name'     => 'required|',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'phone'    => 'numeric|required|min:10',

        ] );
        if ( $validator->fails() ) {
            return redirect()->back()->withErrors( $validator )->withInput();
        } else {
            $dataformate = [
                'name'                     => $request->input( 'name' ),
                'email'                    => $request->input( 'email' ),
                'password'                 => bcrypt( $request->input( 'password' ) ),
                'phone'                    => $request->input( 'phone' ),
                'email_verification_token' => Str::random( 30 ),
            ];
            $user = User::create( $dataformate );
            // Mail::to( $user->email )->queue( new EmailVerification( $user ) );
            $user->notify( new EmailVerification( $user ) );
            $this->SetsuccessMessage( 'Registration successfully.Please check your main and verify your account.' );
            return redirect()->route( 'login' );
        }

    }
///account activation
    public function accountActivation( $token ) {
        if ( $token !== null ) {
            $user = User::where( 'email_verification_token', $token )->first();

            if ( $user !== null ) {
                $user->update( [
                    'email_verified'           => 1,
                    'email_verified_at'        => Carbon::now(),
                    'email_verification_token' => null,
                ] );
                $this->SetsuccessMessage( 'Your account has been active.You can login now. ' );
                return redirect()->route( 'login' );

            } else {
                $this->SeterrorMessage( 'Invaild token' );
                return redirect()->route( 'login' );
            }
        } else {
            $this->SeterrorMessage( 'Invaild token' );
            return redirect()->route( 'login' );
        }
    }

}