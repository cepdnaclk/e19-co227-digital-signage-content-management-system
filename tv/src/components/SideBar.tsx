// SideBar.tsx

import { useState } from "react";
import "./sidebar.css";
import { Link, useMatch } from "react-router-dom";
import labslotsImg from "/src/assets/labslotsimg.svg";
import CourseOfferingsImg from "/src/assets/courseoffering.svg";
import upcomingImg from "/src/assets/upcoming.svg";
import previousImg from "/src/assets/previous.svg";
import achivementImg from "/src/assets/star.svg";
import mapsImg from "/src/assets/map.svg";

function Sidebar() {
  return (
    <nav className="sidebar">
      <ul>
        <li className={useMatch("/labslots/:lab") ? "selected" : ""}>
          <Link to="/labslots/all">
            <img src={labslotsImg} alt="" />
            Laborataries
          </Link>
          <ul className="sublinks">
            <li className={useMatch("/labslots/lab1") ? "active" : ""}>
              <Link to="/labslots/lab1">Lab 1</Link>
            </li>
            <li className={useMatch("/labslots/lab2") ? "active" : ""}>
              <Link to="/labslots/lab2">Lab 2</Link>
            </li>
            <li className={useMatch("/labslots/ccna") ? "active" : ""}>
              <Link to="/labslots/ccna">CCNA Lab</Link>
            </li>
            <li className={useMatch("/labslots/sr") ? "active" : ""}>
              <Link to="/labslots/sr">Seminar Room</Link>
            </li>
          </ul>
        </li>
        <li className={useMatch("/courses") ? "selected" : ""}>
          <Link to="/courses">
            <img src={CourseOfferingsImg} alt="" />
            Course Offerings
          </Link>
        </li>
        <li className={useMatch("/upcoming") ? "selected" : ""}>
          <Link to="/upcoming">
            <img src={upcomingImg} alt="" />
            Upcoming Events
          </Link>
        </li>
        <li className={useMatch("/previous") ? "selected" : ""}>
          <Link to="/previous">
            <img src={previousImg} alt="" />
            Previous Events
          </Link>
        </li>
        <li className={useMatch("/achivements") ? "selected" : ""}>
          <Link to="/achivements">
            <img src={achivementImg} alt="" />
            Achivements
          </Link>
        </li>
        <li className={useMatch("/maps") ? "selected" : ""}>
          <Link to="/maps">
            <img src={mapsImg} alt="" />
            Maps
          </Link>
        </li>
      </ul>
    </nav>
  );
}

export default Sidebar;
