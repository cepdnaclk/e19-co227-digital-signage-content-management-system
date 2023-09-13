// App.tsx
import React, { useState } from "react";
import Header from "./components/Header";
import Sidebar from "./components/SideBar";
import Content from "./components/Content";
import "./app.css";

function App() {
  const [selectedOption, setSelectedOption] = useState<string>("Lab Slots"); // Initialize the selected option state

  return (
    <div className="App">
      <Header />
      <div className="container">
        <Sidebar
          setSelectedOption={setSelectedOption}
          selectedOption={selectedOption}
        />{" "}
        {/* Pass setSelectedOption as a prop */}
        <Content selectedOption={selectedOption} />{" "}
        {/* Pass selectedOption as a prop */}
      </div>
    </div>
  );
}

export default App;
