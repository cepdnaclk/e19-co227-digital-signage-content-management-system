// SideBar.tsx

import { useState } from "react";
import "./sidebar.css";
import { Link, useMatch } from "react-router-dom";
import labslotsImg from "/src/assets/labslotsimg.svg";
import achivementImg from "/src/assets/Star_fill.svg";

function Sidebar() {
  return (
    <nav className="sidebar">
      <ul>
        <li>
          <Link
            to="/labslots"
            className={useMatch("/labslots") ? "selected" : ""}
          >
            <img src={labslotsImg} alt="" />
            Lab Slot
          </Link>
        </li>
        <li>
          <Link
            to="/courses"
            className={useMatch("/courses") ? "selected" : ""}
          >
            <img src={labslotsImg} alt="" />
            Course Offerings
          </Link>
        </li>
        <li>
          <Link
            to="/upcoming"
            className={useMatch("/upcoming") ? "selected" : ""}
          >
            <img src={labslotsImg} alt="" />
            Upcoming Events
          </Link>
        </li>
        <li>
          <Link
            to="/previous"
            className={useMatch("/previous") ? "selected" : ""}
          >
            <img src={labslotsImg} alt="" />
            Previous Events
          </Link>
        </li>
        <li>
          <Link
            to="/achivements"
            className={useMatch("/achivements") ? "selected" : ""}
          >
            <img src={achivementImg} alt="" />
            Achivements
          </Link>
        </li>
      </ul>
    </nav>
  );
}

export default Sidebar;
