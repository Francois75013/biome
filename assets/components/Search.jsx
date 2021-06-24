import React, { useRef, useState } from "react";

import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";
import Highlighter from "react-highlight-words";
import { IoCloseCircleSharp } from "react-icons/io5";

import Loader from "react-loader-spinner";
import axios from "axios";



export function Search() {
    const timerRef = useRef(null);
    const [results, setResults] = useState([]);
    const [query, setQuery] = useState("");
    const [searching, setSearching] = useState(false);
    const [showList, setShowList] = useState(false);
    const handleRequest = async (search) => {
  
      if (search) {
        const response = await axios.get(
          `/api/question/theme/search/${encodeURIComponent(search)}`
        );
        console.log("🚀 ~ file: Search.jsx", response.data);
        setResults(response.data);
        setSearching(false);
      }
    };
    const handleClick = () => {
      !showList && query.length > 0 && setShowList(true);
    };
    const handleChange = (e) => {
      let searchText = e.target.value;
      setSearching(true);
      setShowList(searchText);
      setQuery(searchText);
      timerRef.current && clearTimeout(timerRef.current);
      timerRef.current = setTimeout(() => {
        handleRequest(searchText);
      }, 1000);
    };
    const handleKeyDown = (e) => {
        console.log(e);
      e.keyCode === 27 &&
        (query.length > 0 && !showList ? setQuery("") : setShowList(false));
        timerRef.current && clearTimeout(timerRef.current);
    };
    const clearSearch = () => {
      setSearching(false);
      setShowList(false);
      setQuery("");
    };
    const handleSelect = (id) => {

      document.location.href="http://127.0.0.1:8000/presentationQuiz/{id}";
      console.log(`Vous avez cliqué sur : ${id}`);
      setShowList(false);
    };
    return (
      <>
        <div className="searchContainer">
          {query && (
            <IoCloseCircleSharp onClick={clearSearch} className="searchIcon" />
          )}
  
          <input
            className="searchBox"
            type="text"
            value={query}
            placeholder="Chercher..."
            style={{ width: "100%" }}
            name="search_question"
            onChange={handleChange}
            onKeyDown={handleKeyDown}
            onClick={handleClick}
          />
        </div>
  
        {showList && (
          <div
            style={{
              width: "100%",
              position: "absolute",
              width: "inherit",
            }}
          >
            <ul
              style={{
                height: "12rem",
                listStyleType: "none",
                backgroundColor: "white",
                color: "darkgray",
                display: "flex",
                padding: "1rem",
                flexDirection: "column",
                textAlign: !searching ? "left" : "center",
              }}
            >
              {results.length > 0 && !searching ? (
                results.map((res, index) => {
                  return (
                    <li
                      key={index}
                      className="resultLine"
                      onClick={() => handleSelect(res.id)}
                    >
                      <Highlighter
                        highlightClassName="highlistClass"
                        searchWords={query.split(" ")}
                        autoEscape={true}
                        textToHighlight={res.question}
                      />
                    </li>
                  );
                })
              ) : !searching && query ? (
                <li>Aucun résultat</li>
              ) : (
                <li>
                  <Loader
                    type="ThreeDots"
                    color="#8BCAD4"
                    height={40}
                    width={40}
                  />
                </li>
              )}
            </ul>
          </div>
        )}
      </>
    );
  }