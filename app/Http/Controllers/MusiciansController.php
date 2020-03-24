<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Musician;

class MusiciansController extends Controller
{
    public function index() {
        //
        $musician = Musician::where('enabled', 1)
            ->orderBy('artistic_name', 'asc')
            ->get();

        foreach($musician as $m) {
            //$m->artistic_name = utf8_decode($m->artistic_name);
        }

        return $musician;
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
