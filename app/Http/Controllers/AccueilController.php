<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
Session::start();

// models
use App\Models\agent;
use App\Models\material;
use App\Models\declaration;
use App\Models\maintenance;
use App\Models\societe_maintenance;
use App\Models\enregistrement;
use Exception;

class AccueilController extends Controller
{
    // agent
    private $agent;

    public function __construct() {
        $this->agent = agent::where('matricule',Session::get('matricule'))->first();
    }

    private function enregistrer_action(
        string $typeEnregistrement,
        string $description,
        string $matricule,
        string $codeONEE
        ){

        $enregistrement = new enregistrement();
        $enregistrement->dateEnregistrement = date('Y-m-d');
        $enregistrement->typeEnregistrement = $typeEnregistrement;
        $enregistrement->description = $description;
        $enregistrement->matricule = $matricule;
        $enregistrement->codeONEE = $codeONEE;

        $enregistrement->save();
    }

    public function mon_materielles(){
        return view('accueil.mon-materielles',['agent'=>$this->agent,'materielles'=>$this->agent->materials]);

    }

    public function mon_declarations(){
        $declarations = declaration::where('matricule', $this->agent->matricule)->get();
        
        for($i=0;$i<count($declarations);$i++){
            $maintenance = maintenance::where('refDeclaration',$declarations[$i]->refDeclaration)->first();
            if($maintenance){
                $declarations[$i]["is_maintenance"] = true;
                $declarations[$i]["refMaintenance"] = $maintenance->refMaintenance;
            }else{
                $declarations[$i]["is_maintenance"] = false;
            }
        }
        
        return view('accueil.mon-declarations', ['agent' => $this->agent, 'declarations' => $declarations]);
    }
    
    public function voir_details(string $codeONEE){
        $materials = material::where('codeONEE',$codeONEE)->first();

        return view('accueil.voir-details',['agent'=>$this->agent,'material'=>$materials]);
    }

    public function declarer_probleme(string $codeONEE){
        $material = material::where('codeONEE',$codeONEE)->first();

        return view('accueil.declarer-probleme',['agent'=>$this->agent,'material'=>$material]);
    }

    public function valider_declarer_probleme(string $codeONEE,Request $q){
        $html_input_data = [
            'fan_issue'=>'Le ventilateur de l`unité centrale ne fonctionne pas correctement',
            'startup_error'=>'L`ordinateur affiche des erreurs de démarrage',
            'motherboard_damage'=>'La carte mère semble être endommagée',
            'dead_pixels'=>'L`écran présente des pixels morts ou défectueux',
            'distorted_lines'=>'Il y a des lignes ou des distorsions sur l`affichage',
            'no_display'=>'L`écran ne s`allume pas du tout',
            'autre'=>'autre',
        ];

        $q->validate([
            'description' => 'required|string|max:200',
        ], [
            'description.required' => 'Description est requis.',
        ]);        
        
        try{
            $material = material::where('codeONEE',$codeONEE)->first();
            $declaration = new declaration();
            
            $declaration->dateDeclaration = date('Y-m-d');
            if($material->sousFamille == 'Ordinateur & serveur'){
                $declaration->raisonsPrincipales = $html_input_data[$q->computer_issue];
            }else{
                $declaration->raisonsPrincipales = $html_input_data[$q->screen_issue];
            }
            $declaration->description = $q->description;
            $declaration->matricule = $this->agent->matricule;
            $declaration->codeONEE = $codeONEE;

            $declaration->save();
            //
            return redirect()->route("mon-materielles",['success'=>true]);

        }catch(Exception $e){
            abort(500);
        }

    }
    
    public function mise_a_jourer_compte(){
        return view('accueil.mise-a-jourer-compte',['agent'=>$this->agent,'entite'=>$this->agent->entite]);

    }

    public function valider_informations_compte(Request $q){
        $q->validate([
            'motDePassAC' => 'required',
            'motDePass' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'ReMotDePass' => 'required|same:motDePass',
        ], [
            'motDePassAC.required' => 'Mot de passe actuel est requis.',
            'motDePass.regex' => 'Le nouveau mot de passe doit remplir les conditions.',
            'motDePass.required' => 'Nouveau Mot de passe est requis.',
            'ReMotDePass.required' => 'Répétition de Mot de passe est requis.',
            'ReMotDePass.same' => 'Répétition de Mot de passe doit être identique au nouveau mot de passe.',
        ]);
        
        if($this->agent->mot_de_passeAgent != $q->motDePassAC){
            return redirect()->back()->withErrors(['motDePassAC' => 'Mot de passe actuel est incorrect.']);

        }else if($q->motDePassAC == $q->motDePass){
            return redirect()->back()->withErrors(['motDePassAC' => 'Nouveau Mot de passe et le méme que l\'actuel.']);

        }
        
        agent::where('matricule',$this->agent->matricule)->update(['mot_de_passeAgent'=>$q->motDePass]);
        
        return redirect()->route('mise-a-jourer-compte',['success'=>true]);
    }

    // admin privileges
    public function consulter_declarations(){
        $entiteAgents = [];
        if ($this->agent->entite->agents) {
            $entiteAgents = $this->agent->entite->agents->pluck('matricule');
        }
    
        $declarations = [];
        if (!empty($entiteAgents)) {
            $declarations = declaration::whereIn('matricule', $entiteAgents)->get();
        }
    
        return view('accueil.admin.consulter-declarations',['agent'=>$this->agent,'declarations'=>$declarations]);
    }
    
    public function maintenances_courants(){
        $entiteAgents = [];
        if ($this->agent->entite->agents) {
            $entiteAgents = $this->agent->entite->agents->pluck('matricule');
        }

        $entiteMaterials = [];
        if (!empty($entiteAgents)) {
            $entiteMaterials = material::whereIn('matricule', $entiteAgents)->pluck('codeONEE');
        }

        $maintenances = [];
        if (!empty($entiteMaterials)) {
            $maintenances = maintenance::whereIn('codeONEE', $entiteMaterials)->get();
        }
    
        return view('accueil.admin.maintenances-courants',['agent'=>$this->agent,'maintenances'=>$maintenances]);
    }
    
    public function lister_tous_materielles(){
        if(request('search')){
            $materials = session('materials');

        }else{
            $entiteAgents = [];
            if ($this->agent->entite->agents) {
                $entiteAgents = $this->agent->entite->agents->pluck('matricule');
            }
        
            $materials = [];
            if (!empty($entiteAgents)) {
                $materials = material::whereIn('matricule', $entiteAgents)->get();
            }
        }
        $agents = $this->agent->entite->agents;
        for($i=0;$i<count($agents);$i++){
            if($agents[$i]->est_admin == "true"){
                $GLOBALS['agentAdmin'] = $agents[$i];
                break;
            }
        }
        for($i=0;$i<count($materials);$i++){
            if($materials[$i]->matricule == $GLOBALS['agentAdmin']->matricule){
                $materials[$i]->est_affecter = false;
            }else{
                $materials[$i]->est_affecter = true;
            }
        }
        return view('accueil.admin.lister-tous-materielles',['agent'=>$this->agent,'materials'=>$materials]);
    }    
    
    public function lister_tous_agents(){
        if(request('search')){
            $agents = session('agents');

        }else{
            $agents = $this->agent->entite->agents;
            for($i=0;$i<count($agents);$i++){
                if($agents[$i]->matricule == $this->agent->matricule){
                    unset($agents[$i]);
                    break;
                }
            }
        }
        return view('accueil.admin.lister-tous-agents',['agent'=>$this->agent,'agents'=>$agents]);

    }

    // les actions répétées
    public function change_statut(string $codeONEE, string $src){
        $material = material::where('codeONEE', $codeONEE)->first();
        
        if ($material) {
            $newStatut = ($material->statut == 'hors service') ? 'actif' : 'hors service';
            material::where('codeONEE', $codeONEE)->update(['statut' => $newStatut]);
        }
        
        if($src == "consulter-declarations"){
            declaration::where('codeONEE', $codeONEE)->update(['est_ferme' => 'true']);
        }
        
        // enregistrer l'action
        $this->enregistrer_action(
            'change_statut',
            'changement de status au '.$material->statut,
            $this->agent->matricule,
            $codeONEE
        );

        return redirect()->route($src);
    }

    public function envoyer_a_maintenance(string $codeONEE, string $src, string $refDeclaration=null){
        $material = material::where('codeONEE', $codeONEE)->first();

        $declaration = null;

        if($refDeclaration){
            $declaration = declaration::where('refDeclaration', $refDeclaration)->first();
        }

        return view('accueil.admin.envoyer-a-maintenance',['agent'=>$this->agent,'material'=>$material,'src'=>$src,'declaration'=>$declaration]);
    }

    public function valider_envoyer_a_maintenance(string $codeONEE, string $src, Request $q, string $refDeclaration=null){
        $html_input_data = [
            'fan_issue'=>'Le ventilateur de l`unité centrale ne fonctionne pas correctement',
            'startup_error'=>'L`ordinateur affiche des erreurs de démarrage',
            'motherboard_damage'=>'La carte mère semble être endommagée',
            'dead_pixels'=>'L`écran présente des pixels morts ou défectueux',
            'distorted_lines'=>'Il y a des lignes ou des distorsions sur l`affichage',
            'no_display'=>'L`écran ne s`allume pas du tout',
            'autre'=>'autre',
        ];

        $q->validate([
            'description' => 'required|string|max:200',
        ], [
            'description.required' => 'Description est requis.',
        ]);        
        
        try{
            $material = material::where('codeONEE',$codeONEE)->first();
            $maintenance = new maintenance();
            
            $maintenance->dateDebutMaintenance = date('Y-m-d');
            if($material->sousFamille == 'Ordinateur & serveur'){
                $maintenance->raisonsPrincipales = $html_input_data[$q->computer_issue];
            }else{
                $maintenance->raisonsPrincipales = $html_input_data[$q->screen_issue];
            }
            $maintenance->description = $q->description;

            // foreign keys
            $societe_maintenance = societe_maintenance::where('est_actif','true')->first();
            $maintenance->refSM = $societe_maintenance->refSM;
            $maintenance->codeONEE = $codeONEE;
            
            // fermer la déclaration
            if($refDeclaration){
                $maintenance->refDeclaration = $refDeclaration;
                declaration::where('refDeclaration',$refDeclaration)->update(['est_ferme' => 'true']);
            }
            $maintenance->save();
            //
            return redirect()->route($src,['success'=>true]);

        }catch(Exception $e){
            abort(500);
        }

    }

    public function prendre_decision(string $refMaintenance){
        $maintenance = maintenance::where('refMaintenance',$refMaintenance)->first();

        $entiteAgents = [];
        if ($this->agent->entite->agents) {
            $entiteAgents = $this->agent->entite->agents->pluck('matricule');
        }
    
        $materials = [];
        if (!empty($entiteAgents)) {
            $materials = material::whereIn('matricule', $entiteAgents)->get();
        }

        return view('accueil.admin.prendre-decision',['agent'=>$this->agent,'maintenance'=>$maintenance,'materials'=>$materials]);
    }

    public function valider_prendre_decision(string $refMaintenance, Request $q){
        $rules = [
            'remarquer' => 'nullable|string|max:255',
            'est_remplace' => 'required|in:oui,non',
            'remplace_avec' => 'required_if:est_remplace,oui|string|max:255',
        ];
        
        $messages = [
            'remarquer.max' => 'La remarque ne doit pas dépasser :max caractères.',
            'est_remplace.required' => 'Veuillez spécifier si la maintenance a été remplacée ou non.',
            'remplace_avec.required_if' => 'Veuillez spécifier le matériel de remplacement.',
        ];
        
        $q->validate($rules, $messages);        
    
        // Retrieve the input data from the request
        $remarquer = $q->input('remarquer');
        $estRemplace = $q->input('est_remplace');
        $remplaceAvec = $q->input('remplace_avec');
    
        // Update maintenance record based on the input data
        $updateData = [
            'dateFinMaintenance'=>date('Y-m-d'),
            'etat' => 'fermée',
            'remarquer' => $remarquer,
        ];
    
        if ($estRemplace == 'oui') {
            $updateData['est_remplace'] = 'true';
            $updateData['remplace_avec'] = $remplaceAvec;
        } else {
            $updateData['est_remplace'] = 'false';
        }
    
        maintenance::where('refMaintenance', $refMaintenance)->update($updateData);

        // envoyer un email
        $maintenance = maintenance::where('refMaintenance', $refMaintenance)->first();
        $email = $maintenance->material->agent->emailAgent;
        // here
        /////////////////
        /////////////////
        /////////////////
        /////////////////

        // enregistrer l'action
        $this->enregistrer_action(
            'prendre_decision',
            'prendre la decision finale de la maintenance',
            $this->agent->matricule,
            $maintenance->codeONEE
        );

        return redirect()->route('maintenances-courants',['success'=>true]);
    }    
    
    public function voir_details_maintenance(string $refMaintenance){
        $maintenance = maintenance::where('refMaintenance', $refMaintenance)->first();

        if($maintenance->est_remplace == 'true'){
            $maintenance->remplace_avec_designation = material::where('codeONEE',$maintenance->remplace_avec)->first()->designation;
        }
        return view('accueil.voir-details-maintenance',['agent'=>$this->agent,'maintenance'=>$maintenance]);
    }

    public function ajouter_materiel(){
        return view('accueil.admin.ajouter-materiel',['agent'=>$this->agent]);

    }

    public function valider_ajouter_materiel(Request $request)
    {
        $rules = [
            'sousFamille' => 'required|in:Ordinateur & serveur,Impression & Numérisation',
            'designation' => 'required|string',
            'marque' => 'required|string',
            'modelle' => 'required|string',
            'numSerie' => 'required|string',
            'contratAcquisition' => 'required|string',
            'objectif' => 'required|string',
            'annee' => 'required|integer',
            'titulaireMarche' => 'required|string',
            'statut' => 'required|in:actif,hors service',
        ];
        
        $messages = [
            'sousFamille.required' => 'Le champ sous-famille est requis.',
            'sousFamille.in' => 'La sous-famille doit être "Ordinateur & serveur" ou "Impression & Numérisation".',
            'designation.required' => 'Le champ désignation est requis.',
            'marque.required' => 'Le champ marque est requis.',
            'modelle.required' => 'Le champ modèle est requis.',
            'numSerie.required' => 'Le champ numéro de série est requis.',
            'contratAcquisition.required' => 'Le champ contrat d\'acquisition est requis.',
            'objectif.required' => 'Le champ objectif est requis.',
            'annee.required' => 'Le champ année est requis.',
            'annee.integer' => 'Le champ année doit être un entier.',
            'titulaireMarche.required' => 'Le champ titulaire du marché est requis.',
            'statut.required' => 'Le champ statut est requis.',
            'statut.in' => 'Le statut doit être "actif" ou "hors service".',
        ];
        
        $validatedData = $request->validate($rules, $messages);
        
        $material = new material();
        $material->sousFamille = $validatedData['sousFamille'];
        $material->designation = $validatedData['designation'];
        $material->marque = $validatedData['marque'];
        $material->modelle = $validatedData['modelle'];
        $material->numSerie = $validatedData['numSerie'];
        $material->contratAcquisition = $validatedData['contratAcquisition'];
        $material->objectif = $validatedData['objectif'];
        $material->annee = $validatedData['annee'];
        $material->titulaireMarche = $validatedData['titulaireMarche'];
        $material->statut = $validatedData['statut'];
        $material->matricule = $this->agent->matricule;
    
        $material->save();
    
        return redirect()->route('lister-tous-materielles',['success'=>true]);
    }

    public function modifier_materiel(string $codeONEE){
        $material = material::where('codeONEE',$codeONEE)->first();

        return view('accueil.admin.modifier-materiel',['agent'=>$this->agent,'material'=>$material]);
    }

    public function valider_modifier_materiel(string $codeONEE, Request $q){
        $rules = [
            'sousFamille' => 'required|in:Ordinateur & serveur,Impression & Numérisation',
            'designation' => 'required|string',
            'marque' => 'required|string',
            'modelle' => 'required|string',
            'numSerie' => 'required|string',
            'contratAcquisition' => 'required|string',
            'objectif' => 'required|string',
            'annee' => 'required|integer',
            'titulaireMarche' => 'required|string',
            'statut' => 'required|in:actif,hors service',
        ];
        
        $messages = [
            'sousFamille.required' => 'Le champ sous-famille est requis.',
            'sousFamille.in' => 'La sous-famille doit être "Ordinateur & serveur" ou "Impression & Numérisation".',
            'designation.required' => 'Le champ désignation est requis.',
            'marque.required' => 'Le champ marque est requis.',
            'modelle.required' => 'Le champ modèle est requis.',
            'numSerie.required' => 'Le champ numéro de série est requis.',
            'contratAcquisition.required' => 'Le champ contrat d\'acquisition est requis.',
            'objectif.required' => 'Le champ objectif est requis.',
            'annee.required' => 'Le champ année est requis.',
            'annee.integer' => 'Le champ année doit être un entier.',
            'titulaireMarche.required' => 'Le champ titulaire du marché est requis.',
            'statut.required' => 'Le champ statut est requis.',
            'statut.in' => 'Le statut doit être "actif" ou "hors service".',
        ];
        
        $validatedData = $q->validate($rules, $messages);
        
        material::where('codeONEE', $codeONEE)->update([
            'sousFamille' => $validatedData['sousFamille'],
            'designation' => $validatedData['designation'],
            'marque' => $validatedData['marque'],
            'modelle' => $validatedData['modelle'],
            'numSerie' => $validatedData['numSerie'],
            'contratAcquisition' => $validatedData['contratAcquisition'],
            'objectif' => $validatedData['objectif'],
            'annee' => $validatedData['annee'],
            'titulaireMarche' => $validatedData['titulaireMarche'],
            'statut' => $validatedData['statut'],
        ]);
            
        // enregistrer l'action
        $this->enregistrer_action(
            'modifier_materiel',
            'modifier un materiel',
            $this->agent->matricule,
            $codeONEE
        );

        return redirect()->route('lister-tous-materielles',['success'=>true]);
    }
    
    public function rechercher_materiel(Request $q){
        if(request('matricule')){
            $materials = material::where('matricule',request('matricule'))->get();

            return redirect()->route('lister-tous-materielles',['search'=>true,'designation'=>null])->with(['materials'=>$materials]);

        }else if($q->designation == ''){
            return redirect()->route('lister-tous-materielles');
        }else{
            $materials = material::where('designation',$q->designation)->get();
            return redirect()->route('lister-tous-materielles',['search'=>true,'designation'=>$q->designation])->with(['materials'=>$materials]);
        }
    }

    public function detacher_materiel(string $codeONEE){
        // enregistrer l'action
        $this->enregistrer_action(
            'detacher_materiel',
            'detacher un material',
            material::where('codeONEE',$codeONEE)->first()->matricule,
            $codeONEE
        );

        material::where('codeONEE',$codeONEE)->update(['matricule'=>$this->agent->matricule]);

        return redirect()->route('lister-tous-materielles',['success'=>true]);
    }

    public function affecter_materiel(string $codeONEE){
        $material = material::where('codeONEE',$codeONEE)->first();

        $agents = $this->agent->entite->agents;
        for($i=0;$i<count($agents);$i++){
            if($agents[$i]->matricule == $this->agent->matricule){
                unset($agents[$i]);
                break;
            }
        }

        return view('accueil.admin.affecter-materiel',['agent'=>$this->agent,'material'=>$material,'agents'=>$agents]);
    }

    public function valider_affecter_materiel(string $codeONEE, Request $q){
        $q->validate(['agent'=>'required']);
        material::where('codeONEE',$codeONEE)->update(['matricule'=>$q->agent]);

        // enregistrer l'action
        $this->enregistrer_action(
            'affecter_materiel',
            'affecter un material',
            $q->agent,
            $codeONEE
        );

        return redirect()->route('lister-tous-materielles',['success'=>true]);
    }

    //
    public function ajouter_agent(){
        return view('accueil.admin.ajouter-agent',['agent'=>$this->agent]);

    }

    public function valider_ajouter_agent(Request $q){
        $messages = [
            'required' => 'Le champ :attribute est requis.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'unique' => 'Cette adresse email est déjà utilisée.',
        ];

        $q->validate([
            'nomAgent' => 'required|string|max:255',
            'prenomAgent' => 'required|string|max:255',
            'emploiAgent' => 'required|string|max:255',
            'emailAgent' => 'required|email|unique:agents,emailAgent|max:255',
        ], $messages);

        $agent = new Agent();
        $agent->matricule  = $q->nomAgent."-".$q->prenomAgent;
        $agent->nomAgent = $q->nomAgent;
        $agent->prenomAgent = $q->prenomAgent;
        $agent->emploiAgent = $q->emploiAgent;
        $agent->emailAgent = $q->emailAgent;
        $agent->mot_de_passeAgent = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%'), 0, 16);
        $agent->refEntite = $this->agent->refEntite;

        $agent->save();

        return redirect()->route('lister-tous-agents',['success'=>true])->with(['password'=>$agent->mot_de_passeAgent]);
    }

    public function rechercher_agent(Request $q){

        if($q->nom == ''){
            return redirect()->route('lister-tous-agents');
        }else{
            $agents = agent::where('nomAgent',$q->nom)->get();
            return redirect()->route('lister-tous-agents',['search'=>true,'nom'=>$q->nom])->with(['agents'=>$agents]);
        }
    }

    public function manager_suspender_agent(string $matricule){
        $agent = agent::where('matricule', $matricule)->first();
        agent::where('matricule', $matricule)->update([
            'est_suspender' => $agent->est_suspender=="true"? "false":"true",
        ]);
    
        return redirect()->route('lister-tous-agents');
    }

    public function modifier_agent(string $matricule){
        $agent = agent::where('matricule',$matricule)->first();

        return view('accueil.admin.modifier-agent',['agent'=>$this->agent,'oneAgent'=>$agent]);
    }

    public function valider_modifier_agent(string $matricule, Request $q){
        $messages = [
            'required' => 'Le champ :attribute est requis.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'unique' => 'Cette adresse email est déjà utilisée.',
            'password' => 'Le mot de passe doit respecter les critères de sécurité suivants:',
            'min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.'
        ];
    
        $validatedData = $q->validate([
            'nomAgent' => 'required|string|max:255',
            'prenomAgent' => 'required|string|max:255',
            'emploiAgent' => 'required|string|max:255',
            'emailAgent' => [
                'required',
                'email',
                Rule::unique('agents', 'emailAgent')->ignore($matricule, 'matricule'),
                'max:255',
            ],            
            'mot_de_passeAgent' => [
                'string', 
                'min:8', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ], $messages);
    
        agent::where('matricule', $matricule)->update([
            'nomAgent' => $validatedData['nomAgent'],
            'prenomAgent' => $validatedData['prenomAgent'],
            'emploiAgent' => $validatedData['emploiAgent'],
            'emailAgent' => $validatedData['emailAgent'],
            'mot_de_passeAgent' => $validatedData['mot_de_passeAgent'],
        ]);

        return redirect()->route('lister-tous-agents',['success'=>true]);
    }

}