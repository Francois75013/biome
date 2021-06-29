/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import React from "react";
import  ReactDOM  from "react-dom"; 


import Search from "./components/Search";
import { AppTimer } from "./components/Timer";


///////////////// MOTEUR DE RECHERCHE

function App()
{
    return(

        <div style={{width: "30rem"}}>
            <Search />
        </div>
    )
     
}

ReactDOM.render(<App />, document.getElementById("rootQuizz"));


///////////////// TIMER 

// On recherche la div pour le timer (elle n'est pas forcément présente !)
const rootElement = document.getElementById("root-timer");

// Existe-t'elle dans le DOM ?
if(rootElement != undefined)
{
  // Oui, donc démarrage de React sur le composant AppTimer.
  ReactDOM.render(<AppTimer />, rootElement); 
}
