<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Hirer;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\TocalogoEmail;
use Illuminate\Support\Facades\Mail;

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
        $usuario                    = new Usuario();
        $id_user                    = Helpers::gen_uuid();

        $confirmedPhone             = $request->confirmedPhone;
        $company_name               = $request->company_name;
        $name                       = $request->name;
        $email                      = $request->email;
        $password                   = md5($request->password);
        $frequency                  = $request->frequency;

        $usuario->id_user           = $id_user;
        $usuario->confirmedPhone    = $confirmedPhone;
        $usuario->name              = $name;
        $usuario->email             = $email;
        $usuario->password          = $password;
        $usuario->is_musician       = 0;
        $usuario->save();

        $hirer = new Hirer();
        $hirer->id_hirer            = Helpers::gen_uuid();
        $hirer->company_name        = $company_name;
        $hirer->frequency           = $frequency;
        $hirer->id_user_hirer       = $id_user;
        $hirer->save();

//            $response = Usuario::with('hirer:id_hirer,company_name,frequency')
//                ->where('id_user',  $id_user)
//                ->get();

//        $response = Usuario::select('id_user', 'name', 'email')
//            ->where('id_user', $id_user)
//            ->with('hirer' => function (Builder $query) {
//            $query->select('id_hirer', 'company_name', 'frequency');
//        });

//        $response = Usuario::select('id_user', 'name', 'email')
//            ->where('id_user', $id_user)
//            ->with('hirer')->first();

//        $response = Usuario::where('id_user',  $id_user)
//            ->with('hirer:id_user_hirer')
//            ->first();

        $response = Usuario::with('hirer')
        ->where('id_user', $id_user)
        ->first();

        if ($response) {
            return response()->json($response,200);
        } else {
            return response()->json(['error'=>Response::HTTP_UNAUTHORIZED],200);
        }

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

    public function recoveryPassword(Request $request) {

        $email          = $request->email;
        $new_password   = Helpers::randomPassword();

        $response = Usuario::where('email' , $email)->where( 'is_musician' , 0)->first();
        if ($response) {

            $nome_completo = $response->name . " " . $response->lastname;

            $data = ['nome' => $nome_completo,
                    'password' => $new_password];

            Mail::to($email)->send(new TocalogoEmail($data));
            return response()->json(['email'=> $email], 200);
        }else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }

    }

}
