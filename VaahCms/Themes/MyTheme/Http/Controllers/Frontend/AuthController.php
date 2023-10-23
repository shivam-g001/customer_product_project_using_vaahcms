<?php namespace VaahCms\Themes\MyTheme\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use VaahCms\Themes\MyTheme\Models\MyThemeUser;
use VaahCms\Themes\MyTheme\Models\MyThemeRegistration;


class AuthController extends Controller
{

    //----------------------------------------------------------
    public function login()
    {
      return redirect()->route('vh.frontend.mytheme.signin');
    }
    //----------------------------------------------------------
    public function signOutUser()
    {
      \Auth::logout();
    }
    //----------------------------------------------------------
    public function signout(Request $request)
    {
        $this->signOutUser();
        return redirect('/');
    }
    //----------------------------------------------------------
    public function signin()
    {
      $this->signOutUser();
      return view('mytheme::frontend.auth.signin');
    }
    //----------------------------------------------------------
    public function signinPost(Request $request)
    {

        if($request->type == 'password')
        {
            $response = MyThemeUser::login($request);
        } else if($request->type == 'otp')
        {
            if(is_array($request->login_otp))
            {
                $inputs = [
                    'login_otp' => implode("", $request->login_otp)
                ];

                $request->merge($inputs);
            }

            $response = MyThemeUser::loginViaOtp($request);
        }

        if((isset($response['status']) && $response['status'] == 'success')
          || (isset($response['success']) && $response['success'] == true))
        {
            $response['data']['redirect_url'] = url("/");
        }

        return response()->json($response);
    }
    //----------------------------------------------------------
    public function sendOtp(Request $request)
    {
        $response = MyThemeUser::sendLoginOtp($request);

        return response()->json($response);
    }
    //----------------------------------------------------------
    public function sendResetCode(Request $request)
    {
        $response = MyThemeUser::sendResetPasswordEmail($request);

        return response()->json($response);
    }
    //----------------------------------------------------------
    public function passwordResetAndSignin(Request $request)
    {
        $response = MyThemeUser::passwordResetAndSignin($request);

        if($response['status'] == 'success')
        {
            $response['data']['redirect_url'] = url('/');
        }

        return response()->json($response);

    }
    //----------------------------------------------------------
    public function signup()
    {
        $this->signOutUser();
        return view('mytheme::frontend.auth.signup');
    }

    //---------------------------------------------------------
    public function signupPost(Request $request)
    {
        $response = MyThemeRegistration::postCreate($request);
        return response()->json($response);
    }
    //---------------------------------------------------------
    public function activate(Request $request, $code)
    {
        $this->signOutUser();
        return view('mytheme::frontend.auth.activate')
            ->with([ 'activation_code'=> $code ]);
    }
    //----------------------------------------------------------
    public function activatePost(Request $request, $code)
    {
        $request->merge(['activation_code' => $code]);
        $response = MyThemeRegistration::activateRegistration($request);
        return response()->json($response);
    }
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------
    //----------------------------------------------------------


}
