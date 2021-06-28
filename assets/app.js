/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import Search from "./components/Search";
import React from "react";
import { ReactDOM } from "react-dom"; 
/* import { render } from './components';
import { renderTime } from "./components"; */
//import {Search} from "./components";
/* import { CountdownCircleTimer } from "./components"  */

function App()
{
    return(

        <div style={{width: "30rem"}}>
            <Search />
        </div>
    )
     
}
ReactDOM.render(<App />, document.getElementById("rootQuizz"));

/* function App() {
    return (
      <div className="App">
       
        <div className="timer-wrapper">
          <CountdownCircleTimer
            isPlaying
            duration={20}
            colors={[["#004777", 0.33], ["#F7B801", 0.33], ["#A30000"]]}
            onComplete={() => [true, 1000]}
          >
            
            {renderTime}
            
          </CountdownCircleTimer>
        </div>
      </div>
    );
    
  }

export default App;
const rootElement = document.getElementById("root");
render(<App />, rootElement); 
 */