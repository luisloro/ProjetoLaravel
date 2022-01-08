<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Event;

class EventController extends Controller
{
    
    public function index(){

        $search = request('search');
        if($search){
            $cursos = Curso::where([
                ['nomeCurso','like','%'.$search.'%']
            ])->get();
        }else{

        
        $cursos = Curso::all();
        }
        return view('welcome',['cursos' => $cursos, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request) {

        $curso = new Curso;

        $curso->nomeCurso = $request->nomeCurso;
        $curso->nomeProfessor = $request->nomeProfessor;
        $curso->descricao = $request->descricao;
        $curso->horario = $request->horario;
        $curso->data = $request->data;

        if($request->hasfile('imagemCurso') && $request->file('imagemCurso')->isValid() ){
            
            $requestImage = $request->imagemCurso;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('imagens/events'), $imageName);

            $curso->imagemCurso = $imageName;

        }

        $user = auth()->user();
        $curso->user_id = $user->id; 

        $curso->save();

        return redirect('/')->with('msg','Curso adicionado com sucesso');

    }

    public function show($id) {

        $curso = Curso::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->cursosAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        return view('events.show', ['curso' => $curso,'hasUserJoined' => $hasUserJoined]);
        
    }

    public function dashboard(){
        $user = auth()->user();
        $cursos = $user->cursos;
        $cursosAsParticipant = $user->cursosAsParticipant;

        return view('events.dashboard',['cursos' =>$cursos,'cursosAsParticipant' => $cursosAsParticipant]);
    }

    public function destroy($id){
        Curso::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg','Curso deletado com sucesso');
    }

    public function edit($id){

        $user = auth()->user();

        $curso = Curso::findOrFail($id);

        if($user->id != $curso->user_id){
            return redirect('/dashboard');
        }

        return view('events.edit',['curso' => $curso]);
    }

    public function update(Request $request){

        $data = $request->all();

        if($request->hasfile('imagemCurso') && $request->file('imagemCurso')->isValid() ){
            
            $requestImage = $request->imagemCurso;
            
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('imagens/events'), $imageName);

            $data['imagemCurso'] = $imageName;

        }
        Curso::findOrFail($request->id)->update($data);
        
        return redirect('/dashboard')->with('msg','Curso editado com sucesso');
    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->cursosAsParticipant()->attach($id);

        $curso = Curso::findOrFail($id);

        return redirect('/dashboard')->with('msg','Sua presença esta confimada no evento!!');
    }

    public function leaveEvent($id){
        $user = auth()->user();

        $user->cursosAsParticipant()->detach($id);

        $curso = Curso::findOrFail($id);

        return redirect('/dashboard')->with('msg','Você saiuc do curso com sucesso');
    }
}

    
