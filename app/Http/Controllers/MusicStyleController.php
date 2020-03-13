<?php

namespace App\Http\Controllers;

use App\MusicStyle;
use Illuminate\Http\Request;

class MusicStyleController extends Controller
{

    public function index() {
        //
        return MusicStyle::all();
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
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
