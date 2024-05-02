<?php

use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\connexionController;
use App\Http\Controllers\AccueilController;

// middlewares
use App\Http\Middleware\EnsureAuthentification;
use App\Http\Middleware\EnsureNnAuthentification;
use App\Http\Middleware\EnsureAdminPrivileges;

// connexion routes
Route::get('/',[connexionController::class,'index'])->middleware(EnsureNnAuthentification::class)->name('index');
Route::post('/',[connexionController::class,'connexion'])->middleware(EnsureNnAuthentification::class)->name('connexion');
Route::get('/deconnexion',[connexionController::class,'deconnexion'])->name('deconnexion');

//accueil routes
Route::get('/mon-materielles',[AccueilController::class,'mon_materielles'])->middleware(EnsureAuthentification::class)->name('mon-materielles');
// actions of '/mon-materielles'
    Route::get('/voir-details/{codeONEE}',[AccueilController::class,'voir_details'])->middleware(EnsureAuthentification::class)->name('voir-details');
    //
    Route::get('/declarer-probleme/{codeONEE}',[AccueilController::class,'declarer_probleme'])->middleware(EnsureAuthentification::class)->name('declarer-probleme');
    Route::post('/valider-declarer-probleme/{codeONEE}',[AccueilController::class,'valider_declarer_probleme'])->middleware(EnsureAuthentification::class)->name('valider-declarer-probleme');

Route::get('/mon-declarations',[AccueilController::class,'mon_declarations'])->middleware(EnsureAuthentification::class)->name('mon-declarations');

// mise à jourer compte
Route::get('/mise-a-jourer-compte',[AccueilController::class,'mise_a_jourer_compte'])->middleware(EnsureAuthentification::class)->name('mise-a-jourer-compte');
Route::post('/valider-informations-compte',[AccueilController::class,'valider_informations_compte'])->middleware(EnsureAuthentification::class)->name('valider-informations-compte');

// admin routes d'affichage
Route::get('/consulter-declarations',[AccueilController::class,'consulter_declarations'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('consulter-declarations');

Route::get('/maintenances-courants',[AccueilController::class,'maintenances_courants'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('maintenances-courants');

Route::get('/lister-tous-materielles',[AccueilController::class,'lister_tous_materielles'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('lister-tous-materielles');

Route::get('/lister-tous-agents',[AccueilController::class,'lister_tous_agents'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('lister-tous-agents');


// admin routes du actions
Route::get('/change-statut/{codeONEE}/{src}',[AccueilController::class,'change_statut'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('change-statut');

// afficher form envoyer à maintenance
Route::get('/envoyer-a-maintenance/{codeONEE}/{src}/{refDeclaration?}',[AccueilController::class,'envoyer_a_maintenance'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('envoyer-a-maintenance');

// valider form envoyer à maintenance
Route::post('/valider-envoyer-a-maintenance/{codeONEE}/{src}/{refDeclaration?}',[AccueilController::class,'valider_envoyer_a_maintenance'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-envoyer-a-maintenance');

Route::get('/prendre-decision/{refMaintenance}',[AccueilController::class,'prendre_decision'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('prendre-decision');

Route::post('/valider-prendre-decision/{refMaintenance}',[AccueilController::class,'valider_prendre_decision'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-prendre-decision');

Route::get('/voir-details-maintenance/{refMaintenance}',[AccueilController::class,'voir_details_maintenance'])->middleware([
    EnsureAuthentification::class,
    ])->name('voir-details-maintenance');
//

Route::get('/ajouter-materiel',[AccueilController::class,'ajouter_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('ajouter-materiel');

Route::post('/valider-ajouter-materiel',[AccueilController::class,'valider_ajouter_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-ajouter-materiel');

Route::get('/modifier-materiel/{codeONEE}',[AccueilController::class,'modifier_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('modifier-materiel');

Route::put('/valider-modifier-materiel/{codeONEE}',[AccueilController::class,'valider_modifier_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-modifier-materiel');

//
Route::get('/rechercher-materiel',[AccueilController::class,'rechercher_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('rechercher-materiel');

Route::get('/detacher-materiel/{codeONEE}',[AccueilController::class,'detacher_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('detacher-materiel');

Route::get('/affecter-materiel/{codeONEE}',[AccueilController::class,'affecter_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('affecter-materiel');

Route::post('/valider-affecter-materiel/{codeONEE}',[AccueilController::class,'valider_affecter_materiel'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-affecter-materiel');

//
Route::get('/ajouter-agent',[AccueilController::class,'ajouter_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('ajouter-agent');

Route::post('/valider-ajouter-agent',[AccueilController::class,'valider_ajouter_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-ajouter-agent');

Route::get('/rechercher-agent',[AccueilController::class,'rechercher_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('rechercher-agent');

Route::get('/manager-suspender-agent/{matricule}',[AccueilController::class,'manager_suspender_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('manager-suspender-agent');

Route::get('/modifier-agent/{matricule}',[AccueilController::class,'modifier_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('modifier-agent');

Route::put('/valider-modifier-agent/{matricule}',[AccueilController::class,'valider_modifier_agent'])->middleware([
    EnsureAuthentification::class,
    EnsureAdminPrivileges::class
    ])->name('valider-modifier-agent');