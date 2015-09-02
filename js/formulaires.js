/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Fonction d'affichage de formulaire
$(function(){
    
//Formulaire de modification de mot de passe
    $('#modipass').click (function(e){
        e.preventDefault();
        $('.repform').slideDown( "500" );

    });

    $('#annuler').click (function(e){
        e.preventDefault();
        this.form.reset();
        $('.repform').slideUp( "500" );
        

    });

//Formulaire de changement d'avatar
    $('#avatar').click (function(e){
        e.preventDefault();
        $('.imgform').slideDown( "500" );

    });
    
    $('#annul').click (function(e){
        e.preventDefault();
        this.form.reset();
        $('.imgform').slideUp( "500" );

    });
    
//Formulaire de modification de login 
    $('#modilog').click (function(e){
        e.preventDefault();
        $('.modlog').slideDown( "500" );

    });

    $('#cancel').click (function(e){
        e.preventDefault();
        this.form.reset();
        $('.modlog').slideUp( "500" );
        

    });
    
//Formulaire de modification d'une reponse
    $('#modifrep').click (function(e){
        e.preventDefault();
        $('.modrep').slideDown( "500" );

    });

    $('#cancel').click (function(e){
        e.preventDefault();
        this.form.reset();
        $('.modrep').slideUp( "500" );
        

    });
});
     
