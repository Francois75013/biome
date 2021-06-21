/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import React from"react";
import { render } from 'react-dom';
import { CountdownCircleTimer } from 'react-countdown-circle-timer'

const renderTime = ({ remainingTime }) => {
    if (remainingTime === 0) {
      return <div className="timer">Too lale...</div>;
    }
  
    return (
      <div className="timer">
        <div className="text">Remaining</div>
        <div className="value">{remainingTime}</div>
        <div className="text">seconds</div>
      </div>
    );
  };
  

  function App() {
    return (
      <div className="App">
        <h1>
          CountdownCircleTimer
          <br/>
          React Component
        </h1>
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
  render(<App />, rootElement);
  