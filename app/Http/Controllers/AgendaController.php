<?php


namespace App\Http\Controllers;

use App\Agenda;
use App\Http\Requests\AgendaFormRequest;
use Illuminate\Http\Request;


class AgendaController extends Controller
{
    public function index(Request $request) {
        $agenda = Agenda::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');


        return view('agenda.index', compact('agenda', 'mensagem'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(AgendaFormRequest $request)
    {

//        dd($request->all());
        $agenda = agenda::create($request->all());
        $request->session()
            ->flash(
                'mensagem',
                "Agenda {$agenda->nome} cadastrado com sucesso "
            );
        if ($request->file('photo')->isValid()) {
            $request->file('photo')->store('imagemusuario');
        }
        return redirect('/agenda');
    }


    public function destroy (Request $request)

    {

        agenda::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Agenda removido com sucesso"
            );

        return redirect('/agenda');

    }
}


