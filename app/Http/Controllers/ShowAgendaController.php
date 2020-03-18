<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Hirer;
use App\ShowAgenda;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade as PDF;

class ShowAgendaController extends Controller
{
    public function index() {
        //
        return ShowAgenda::all();
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
        $request = request();
        $token = $request->bearerToken();

        if ($token) {

            $show = new ShowAgenda();
            $show->id_show = Helpers::gen_uuid();
            $show->id_user_show = $token;
            $show->start = $request->start;
            $show->end = $request->end;
            $show->artistic_name = $request->artistic_name;
            $show->cache = $request->cache;
            $show->music_style = $request->music_style;
            $show->repeat_event = $request->repeat_event;
            $show->save();
            return $show;

        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }

    }

    public function pdfviewer() {

        $request = request();
        $token = $request->bearerToken();

        $show = ShowAgenda::where('id_user', '=', $token);
        $pdf = PDF::loadView('pdf', compact('show'));
        $b64Doc = chunk_split(base64_encode( $pdf->setPaper('a4')->stream('agenda.pdf')));
        return response()->json(['data' => $b64Doc ]);
    }

    public function show($id) {
        //
        $show = ShowAgenda::find($id);
        return $show;
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
        $show = ShowAgenda::find($id);

        $show->start = $request->start;
        $show->end = $request->end;
        $show->artistic_name = $request->artistic_name;
        $show->cache = $request->cache;
        $show->music_style = $request->music_style;
        $show->repeat_event = $request->repeat_event;
        $show->save();
        return $show;
    }

    public function destroy($id) {
        //
        try {
            $show = ShowAgenda::find($id);
            $show->delete();

        } catch (\Exception $error) {
            return ['delete' => $error->getMessage()];
        }
    }

    public function publicCalendar($id_user) {

        $response = Usuario::with('hirer')
            ->where('id_user', $id_user)
            ->first();

        $id = $response->hirer[0]->id;
        $hirer = Hirer::find($id);
        $nome = $hirer->company_name;

        $obj = new \stdClass();
        $obj->id = $id;
        $obj->company_name = $nome;
        $show = ShowAgenda::where('id_user_show', '=', $id_user)->get();
        $obj->events = $show;

        return response()->json($obj, 200);
    }

}
