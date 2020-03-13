<?php

namespace App\Http\Controllers;

use App\Hirer;
use Illuminate\Http\Request;

class HirerController extends Controller
{
    public function index() {
        //
        $hirer = Hirer::all();
        return json_decode($hirer);
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
