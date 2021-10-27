<?php


namespace App\Http\Controllers;

use App\Agenda;
use App\Http\Requests\AgendaFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        // $capa = null;
        //if($request-file('capa'))
       // {
       //     $request->file('capa')->store('agenda');
      //  }

        $agenda = agenda::create($request->all());
        $request->session()
            ->flash(
                'mensagem',
                "{$agenda->nome} cadastrado com sucesso! "
            );


        return redirect('/agenda');
    }

    public function getEdit($id)
    {
        $agenda= agenda::find($id);
        return view('agenda.edit')->with('agenda',$agenda);
    }

    public function storeEdit(Request $request)
    {
        $dados = $request->all();

        $update = agenda::find($dados['id']);

        $update->update($dados);

        $request->session()
            ->flash(
                'mensagem',
                "Contato  atualizado com sucesso! "
            );


        return redirect ('/agenda');


    }

    public function update(AgendaFormRequest $request, $id)
    {
        $this->agenda->where(['id'=>$id])->update([
        ]);

        return redirect('/agenda');
    }

    public function destroy (Request $request)

    {

        agenda::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Contato removido com sucesso"
            );

        return redirect('/agenda');

    }
}


