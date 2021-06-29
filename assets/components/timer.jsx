import React from "react";

import { CountdownCircleTimer } from 'react-countdown-circle-timer';

const renderTime = ({ remainingTime }) => {
  if (remainingTime === 0) {
    window.clearTimeout(CountdownCircleTimer)
    return <div className="timer">C'est fini !</div>;
    
  }

  return (
    <div className="timer">
      <div className="text">Il reste</div>
      <div className="value">{remainingTime}</div>
      <div className="text">secondes</div>
    </div>
  );




}

export function AppTimer() {

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