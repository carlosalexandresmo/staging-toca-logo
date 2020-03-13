<?php

namespace App\Http\Controllers;

use App\Suggestions;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{

    public function index() {
        //

    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
        $suggestions = new Suggestions();
        $suggestions->id_suggestions = Helpers::gen_uuid();
        $suggestions->name = $request->name;
        $suggestions->phone = $request->phone;
        $suggestions->email = $request->email;
        $suggestions->message = $request->message;
        $suggestions->save();
        return $suggestions;
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
