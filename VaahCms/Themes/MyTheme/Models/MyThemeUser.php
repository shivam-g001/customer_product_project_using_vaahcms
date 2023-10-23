<?php namespace VaahCms\Themes\MyTheme\Models;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use VaahCms\Themes\MyTheme\Notifications\ActivationLinkNotification;
use WebReinvent\VaahCms\Entities\Registration;
use WebReinvent\VaahCms\Entities\User;

class MyThemeUser extends User
{

	//------------------------------------------
    public static function createUser($request)
    {

        $user = self::where('email', $request->email)
            ->first();

        $except = [
            'id',
            'uuid',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $inputs = $request->except($except);

        if(!$user)
        {

            $user = new self();
            $user->fill($inputs);
            if(!isset($request->username))
            {
                $user->username = Str::slug($request->email);
            }
            $user->prevent_password_hashing = true;
            $user->password = $request->password;
            $user->created_ip = request()->ip();
            $user->is_active = 1;
        } else
        {
            $user->prevent_password_hashing = true;
            $user->fill($inputs);
        }

        if($request->has('id'))
        {
            $user->registration_id = $request->id;
        }
        $user->status = 'email-verified';
        $user->activated_at = now();
        $user->save();

        return $user;
    }
	//------------------------------------------
    public static function passwordResetAndSignin($request)
    {
        $response = self::resetPassword($request);

        if($response['status'] == 'success')
        {
            $user = self::where('email', $request->email)->first();
            \Auth::login($user);
        }

        return $response;
    }
	//------------------------------------------
	//------------------------------------------
	//------------------------------------------

}
