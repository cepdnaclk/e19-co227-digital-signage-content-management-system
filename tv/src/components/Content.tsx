// Content.tsx
import React from "react";
import { Outlet } from "react-router-dom";
import "./content.css";

const Content = () => {
  return (
    <div className="content">
      <Outlet />
    </div>
  );
};

export default Content;
