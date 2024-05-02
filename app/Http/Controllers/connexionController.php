<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
Session::start();

// models
use App\Models\agent;

class connexionController extends Controller
{
    public function index(){
        return view('connexion');
    }

    // connexion
    public function connexion(Request $q){
        $q->validate([
            'matricule'=>'required',
            'password'=>'required',
        ],[
            'matricule.required' => 'Matricule est requise.',
            'password.required' => 'Mot de passe est requis.',
        ]);

        $agent = agent::where('matricule',$q->matricule)->first();

        if($agent == null){
            return redirect()->back()->withErrors(['matricule' => 'Matricule non trouvé.'])->withInput();

        }else if($agent->mot_de_passeAgent != $q->password){
            return redirect()->back()->withErrors(['incorrect' => 'Mot de passe incorrect.']);
            
        }else if($agent->est_suspender == "true"){
            return redirect()->back()->withErrors(['incorrect' => 'Ce compte est suspendu.']);
        }

        // activé l'auth avec les sessions
        Session::put('matricule',$agent->matricule);

        return redirect()->route('mon-materielles',['welcome'=>true]);
    }

    // deconnexion
    public function deconnexion(){
        Session::flush();
        return redirect()->route('index');
    }
}
