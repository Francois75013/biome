

import React from"react";
import { render } from 'react-dom';
import { CountdownCircleTimer } from 'react-countdown-circle-timer';

const renderTime = ({ remainingTime }) => {
    if (remainingTime === 0 || clickOnAnswer()) {
      document.clearTimeout(CountdownCircleTimer)
      return <div className="timer">C'est fini !</div>;
      
    }
  
    return (
      <div className="timer">
        <div className="text">Il te reste</div>
        <div className="value">{remainingTime}</div>
        <div className="text">secondes</div>
      </div>
    );
  };

  function clickOnAnswer(){
    
  }

  document.addEventListener('click', clickOnAnswer);

  function App() {
    return (
      <div className="App">
       
        <div className="timer-wrapper">
          <CountdownCircleTimer
            isPlaying
            duration={5}
            colors={[["#004777", 0.33], ["#F7B801", 0.33], ["#A30000"]]}
            onComplete={() => [true, 1000]}
          >
            
            {renderTime}
            
          </CountdownCircleTimer>
        </div>
      </div>
    );
    
  }

  
 const rootElement = document.getElementById("root");
  render(<App />, rootElement); 