<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Hirer;
use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\Helper;

class UsuarioController extends Controller
{

    public function login(Request $request) {

        $users = Usuario::where('email' , $request->email)
            ->where( 'password' , md5($request->password))
            ->where( 'is_musician' , 0)
            ->first();

        if ($users) {
            return response()->json($users, 200);
        }else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }

        //$token = Auth::user()->createToken('TutsForWeb')->accessToken;
        //dd($token);

//        if (Auth::attempt($credentials)) {
//            dd($credentials);
//            $token = Auth::user()->createToken('TutsForWeb')->accessToken;
//            return response()->json(['token' => $token], 200);
//        } else {
//            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
//        }
    }

    public function index() {
        //
        return Usuario::all();
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
        $usuario = new Usuario();
        $usuario->id_user = Helpers::gen_uuid();

        $confirmedPhone     = $request->confirmedPhone;
        $company_name       = $request->company_name;
        $name               = $request->name;
        $email              = $request->email;
        $password           = md5($request->password);
        $frequency          = $request->frequency;

        $usuario->confirmedPhone    = $confirmedPhone;
        $usuario->name              = $name;
        $usuario->email             = $email;
        $usuario->password          = $password;
        $usuario->save();

        $hirer = new Hirer();
        $hirer->id_hirer        = Helpers::gen_uuid();
        $hirer->company_name    = $company_name;
        $hirer->frequency       = $frequency;
        $hirer->save();

    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
