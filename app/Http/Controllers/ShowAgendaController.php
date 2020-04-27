<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Hirer;
use App\ShowAgenda;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class ShowAgendaController extends Controller
{
    public function index() {
        //
        $token = request()->bearerToken();

        if ($token) {

            try {
                $shows = ShowAgenda::where('id_user_show', $token)
                    ->with('music_styles')
                    ->get();
                return response()->json($shows, Response::HTTP_OK);

            } catch (\Exception $error) {
                $response = [
                    'success' => false,
                    'data' => $error,
                    'message' => $error->getMessage()
                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

        } else {
            $response = [
                'success' => false,
                'data' => "",
                'message' => "Não Autorizado"
            ];

            return response()->json($response, Response::HTTP_UNAUTHORIZED);
        }

    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
        $token = $request->bearerToken();

        if ($token) {

            $id_user_show       = $token;
            $start              = $request->start;
            $end                = $request->end;
            $artistic_name      = $request->artistic_name;
            $cache              = $request->cache;
            $music_style_id     = $request->music_style_id;
            $repeat_event       = $request->repeat_event;
            $cicle_repeat       = $request->cicle_repeat;

            $last_date_start = "";
            $last_date_end = "";
            $shows = array();

            switch ($repeat_event) {

                case "1":
                    $repeat_event = 'DAILY';

                    for ($i = 0; $i <= $cicle_repeat; $i++):

                        if ($i > 0) {
                            $start    = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($last_date_start)));
                            $end      = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($last_date_end)));
                        }

                        try {

                            $show                   = new ShowAgenda();
                            $show->id_show          = Helpers::gen_uuid();
                            $show->id_user_show     = $id_user_show;
                            $last_date_start        = $start;
                            $last_date_end          = $end;

                            $show->start            = $start;
                            $show->end              = $end;
                            $show->artistic_name    = $artistic_name;
                            $show->cache            = $cache;
                            $show->music_style_id   = $music_style_id;
                            $show->repeat_event     = $repeat_event;
                            $show->cicle_repeat     = $cicle_repeat;
                            $show->save();
                            $shows[] = $show;

                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                        }

                    endfor;

                    break;

                case "2":
                    $repeat_event = 'WEEKLY';

                    for ($i = 0; $i <= $cicle_repeat; $i++):

                        if ($i > 0) {
                            $start  = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($last_date_start)));
                            $end    = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($last_date_end)));
                        }

                        try {

                            $show                   = new ShowAgenda();
                            $show->id_show          = Helpers::gen_uuid();
                            $show->id_user_show     = $id_user_show;
                            $last_date_start        = $start;
                            $last_date_end          = $end;

                            $show->start            = $start;
                            $show->end              = $end;
                            $show->artistic_name    = $artistic_name;
                            $show->cache            = $cache;
                            $show->music_style_id   = $music_style_id;
                            $show->repeat_event     = $repeat_event;
                            $show->cicle_repeat     = $cicle_repeat;
                            $show->save();
                            $shows[] = $show;

                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                        }

                    endfor;

                    break;

                case "3":
                    $repeat_event = 'MONTHLY';

                    for ($i = 0; $i <= $cicle_repeat; $i++):

                        if ($i > 0) {

                            $time_start = '+30 days';
                            //echo $last_date_start;
                            $days = intval(date('t', strtotime($last_date_start)));
                            if ($days == 31) {
                                $time_start = '+31 days';
                            }

                            $time_end = '+30 days';
                            $days = intval(date('t', strtotime($last_date_end)));
                            if ($days == 31) {
                                $time_end = '+31 days';
                            }

                            $start = date('Y-m-d H:i:s', strtotime($time_start, strtotime($last_date_start)));
                            $end = date('Y-m-d H:i:s', strtotime($time_end, strtotime($last_date_end)));
                        }

                        try {

                            $show                   = new ShowAgenda();
                            $show->id_show          = Helpers::gen_uuid();
                            $show->id_user_show     = $id_user_show;
                            $last_date_start        = $start;
                            $last_date_end          = $end;

                            $show->start            = $start;
                            $show->end              = $end;
                            $show->artistic_name    = $artistic_name;
                            $show->cache            = $cache;
                            $show->music_style_id   = $music_style_id;
                            $show->repeat_event     = $repeat_event;
                            $show->cicle_repeat     = $cicle_repeat;
                            $show->save();
                            $shows[] = $show;

                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                        }

                    endfor;

                    break;

                case "4":
                    $repeat_event = 'SEMIANNUAL';

                    for ($i = 0; $i <= $cicle_repeat; $i++):

                        $time_start = '+180 days';
                        $days = intval(date('t', strtotime($last_date_start)));
                        if ($days == 31) {
                            $time_start = '+184 days';
                        }

                        $time_end = '+180 days';
                        $days = intval(date('t', strtotime($last_date_end)));
                        if ($days == 31) {
                            $time_end = '+184 days';
                        }

                        if ($i > 0) {
                            $start = date('Y-m-d H:i:s', strtotime($time_start, strtotime($last_date_start)));
                            $end = date('Y-m-d H:i:s', strtotime($time_end, strtotime($last_date_end)));
                        }

                        try {

                            $show                   = new ShowAgenda();
                            $show->id_show          = Helpers::gen_uuid();
                            $show->id_user_show     = $id_user_show;
                            $last_date_start        = $start;
                            $last_date_end          = $end;

                            $show->start            = $start;
                            $show->end              = $end;
                            $show->artistic_name    = $artistic_name;
                            $show->cache            = $cache;
                            $show->music_style_id   = $music_style_id;
                            $show->repeat_event     = $repeat_event;
                            $show->cicle_repeat     = $cicle_repeat;
                            $show->save();
                            $shows[] = $show;

                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                        }

                    endfor;

                    break;

                case "5":
                    $repeat_event = 'YEARLY';

                    for ($i = 0; $i <= $cicle_repeat; $i++):

                        $time_start = '+365 days';
                        $days = intval(date('t', strtotime($last_date_start)));
                        //if ($days == 31) {
                        //    $time_start = '+184 days';
                        //}

                        $time_end = '+365 days';
                        $days = intval(date('t', strtotime($last_date_end)));
                        //if ($days == 31) {
                        //    $time_end = '+184 days';
                        //}


                        if ($i > 0) {
                            $start = date('Y-m-d H:i:s', strtotime($time_start, strtotime($last_date_start)));
                            $end = date('Y-m-d H:i:s', strtotime($time_end, strtotime($last_date_end)));
                        }

                        try {

                            $show                   = new ShowAgenda();
                            $show->id_show          = Helpers::gen_uuid();
                            $show->id_user_show     = $id_user_show;
                            $last_date_start        = $start;
                            $last_date_end          = $end;

                            $show->start            = $start;
                            $show->end              = $end;
                            $show->artistic_name    = $artistic_name;
                            $show->cache            = $cache;
                            $show->music_style_id   = $music_style_id;
                            $show->repeat_event     = $repeat_event;
                            $show->cicle_repeat     = $cicle_repeat;
                            $show->save();
                            $shows[] = $show;

                        } catch (\Exception $exception) {
                            echo $exception->getMessage();
                        }

                    endfor;

                    break;

                case "6":
                    $repeat_event = 'CUSTOM';

                    try {

                        $show                   = new ShowAgenda();
                        $show->id_show          = Helpers::gen_uuid();
                        $show->id_user_show     = $id_user_show;
                        $last_date_start        = $start;
                        $last_date_end          = $end;

                        $show->start            = $start;
                        $show->end              = $end;
                        $show->artistic_name    = $artistic_name;
                        $show->cache            = $cache;
                        $show->music_style_id   = $music_style_id;
                        $show->repeat_event     = $repeat_event;
                        $show->cicle_repeat     = $cicle_repeat;
                        $show->save();
                        $shows[] = $show;

                    } catch (\Exception $exception) {
                        echo $exception->getMessage();
                    }

                    break;

                default:
                    break;
            }

            return response()->json($shows, Response::HTTP_CREATED);

        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }

    }

    public function pdfviewer() {

        $request = request();
        $token = $request->bearerToken();

        if ($token) {
            $show = ShowAgenda::with('music_styles')
                ->where('id_user_show', $token)
                ->get();
            $pdf = PDF::loadView('pdf', compact('show'));
            $b64Doc = chunk_split(base64_encode( $pdf->setPaper('a4')->stream('agenda.pdf')));
            return response()->json(['data' => $b64Doc ]);
        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }
    }

    public function show($id) {
        //
        $token = request()->bearerToken();

        if ($token) {
            try {
                $show = ShowAgenda::find($id)
                    ->with('music_styles')
                    ->first();

                return response()->json($show, Response::HTTP_OK);

            } catch (\Exception $error) {
                $response = [
                    'success' => false,
                    'data' => $error,
                    'message' => $error->getMessage()
                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

        } else {
            $response = [
                'success' => false,
                'data' => "",
                'message' => "Não Autorizado"
            ];

            return response()->json($response, Response::HTTP_UNAUTHORIZED);
        }

    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
        $token = $request->bearerToken();

        if ($token) {

            $show = ShowAgenda::find($id);
            $show->start            = $request->start;
            $show->end              = $request->end;
            $show->artistic_name    = $request->artistic_name;
            $show->cache            = $request->cache;
            $show->music_style_id   = $request->music_style_id;
            $show->repeat_event     = $request->repeat_event;
            $show->cicle_repeat     = $request->cicle_repeat;
            $show->save();
            return $show;

        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }

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
        $show = ShowAgenda::where('id_user_show', '=', $id_user)->with('music_styles')->get();
        $obj->events = $show;

        return response()->json($obj, 200);
    }

    public function styles() {

        $request = request();
        $token = $request->bearerToken();

        if ($token) {
            $obj = new \stdClass();

            $styles = DB::table('show_agendas')
                ->select('music_style.name_style', DB::raw('COUNT(music_style_id) as total'))
                ->leftJoin('music_style', 'music_style.id_music_style', '=', 'show_agendas.music_style_id')
                ->groupBy('music_style.name_style')
                ->where('id_user_show', $token)
                ->get();

            $max = ShowAgenda::whereRaw('cache = (SELECT MAX(`cache`) from show_agendas)')
                ->first();

            $min= ShowAgenda::whereRaw('cache = (SELECT MIN(`cache`) from show_agendas)')
                ->first();

            $obj->music_style = $styles;
            $obj->max = $max;
            $obj->min = $min;

            return response()->json($obj, 200);

        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }


    }

    public function filterReport(Request $request) {

        $token = $request->bearerToken();

        if ($token) {

            $frequency = $request->query('frequency');
            $start  = $request->query('start');
            $end    = $request->query('end');

            $repeat_event = "";
            if ($frequency) {

                switch ($frequency) {
                    case 1:
                        $repeat_event = 'DAILY';
                    break;

                    case 2:
                        $repeat_event = 'WEEKLY';
                        break;

                    case 3:
                        $repeat_event = 'MONTHLY';
                        break;

                    case 4:
                        $repeat_event = 'SEMIANNUAL';
                        break;

                    case 5:
                        $repeat_event = 'YEARLY';
                        break;

                    case 6:
                        $repeat_event = 'CUSTOM';
                        break;

                    default:
                        break;
                }

                $response = ShowAgenda::where('repeat_event', $repeat_event)
                    ->where('id_user_show', $token)->get();
                return response()->json($response, 200);
            }

            if ($start && $end) {

                //$from = Carbon::createFromFormat('d-m-Y', $start)->format('Y-m-d');
                //$to = Carbon::createFromFormat('d-m-Y', $end)->format('Y-m-d');

                $response = ShowAgenda::whereBetween('start', [$start, $end])
                    ->where('id_user_show', $token)->get();
                return response()->json($response, 200);

            } else {

                return response()->json(['erro' => Response::HTTP_NO_CONTENT], 204);
            }
        } else {
            return response()->json(['error' => Response::HTTP_UNAUTHORIZED], 401);
        }


    }

}
