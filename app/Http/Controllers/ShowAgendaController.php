<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\ShowAgenda;
use Illuminate\Http\Request;
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
        $show = new ShowAgenda();
        $show->id_show = Helpers::gen_uuid();
        $show->start = $request->start;
        $show->end = $request->end;
        $show->artistic_name = $request->artistic_name;
        $show->cache = $request->cache;
        $show->music_style = $request->music_style;
        $show->repeat_event = $request->repeat_event;
        $show->save();
        return $show;
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

}
