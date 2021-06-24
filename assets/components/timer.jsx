

import React from"react";
import { rootElement } from "react-dom";
import { CountdownCircleTimer } from "react-countdown-circle-timer";

const renderTime = ({ remainingTime }) => {
    if (remainingTime === 0 ) {
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

/*   function App() {
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

  const rootElement = document.getElementById("root");
  render(<App />, rootElement); */
  

  
  
