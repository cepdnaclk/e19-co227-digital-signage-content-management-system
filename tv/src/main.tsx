import axios from "axios";
import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.tsx";

axios.defaults.baseURL = "http://192.168.111.76:8000";

ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
