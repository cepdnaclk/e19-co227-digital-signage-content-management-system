// SideBar.tsx

import { useState } from "react";
import "./sidebar.css";
import { Link } from "react-router-dom";

function Sidebar() {
  return (
    <nav className="sidebar">
      <ul>
        <li>
          <Link to="/labslots">
            <img src="../assets/logo_a.svg" alt="" />
            Lab Slot
          </Link>
          <Link to="/courses">
            <img src="../assets/logo_a.svg" alt="" />
            Course Offerings
          </Link>
          <Link to="/upcoming">
            <img src="../assets/logo_a.svg" alt="" />
            Upcoming Events
          </Link>
          <Link to="/previous">
            <img src="../assets/logo_a.svg" alt="" />
            Previous Events
          </Link>
          <Link to="/achivements">
            <img src="../assets/logo_a.svg" alt="" />
            Achivements
          </Link>
        </li>
      </ul>
    </nav>
  );
}

export default Sidebar;
