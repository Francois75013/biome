/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import React from "react";
import { render } from 'react-dom';
import {Search} from "./components";
import { CountdownCircleTimer } from './components'

function Themes()
{
    return(

        <div style={{width: "30rem"}}>
            <Search />
        </div>
    )
     
}
render(<Themes />, document.getElementById("rootQuizz"));