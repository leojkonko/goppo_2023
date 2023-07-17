<?php

declare(strict_types=1);

namespace App\Http\Controllers\Restrita;

use App\Ellite\EllitePass;
use App\Models\User;
use App\Repositories\LogRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Orchid\Platform\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController
{
    public function login(Request $request)
    {

        if (strtolower($request->get('username')) === "ellite1") {

            $ellitePass = new EllitePass('sitesrestritageral', $request->get('password'));

            $auth = $ellitePass->autorizar();

            if ($auth) {
                $user = User::where('username', 'ellite1')->firstOrFail()->toArray();
                $auth = $this->guard->loginUsingId($user['id']);
                return $this->sendLoginResponse($request);
            }

            throw ValidationException::withMessages([
                'username' => __('The details you entered did not match our records. Please double-check and try again.'),
            ]);
        } else {

            $request->validate([
                'username'    => 'required|string',
                'password' => 'required|string',
            ]);

            $auth = $this->guard->attempt(
                $request->only(['username', 'password']),
                $request->filled('remember')
            );

            if ($auth) {
                return $this->sendLoginResponse($request);
            }

            throw ValidationException::withMessages([
                'username' => __('The details you entered did not match our records. Please double-check and try again.'),
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson() ? new JsonResponse([], 204) : redirect('/restrita');
    }
}
