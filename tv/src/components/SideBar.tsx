// SideBar.tsx

import { Link, useMatch } from "react-router-dom";
import "./sidebar.css";
import CourseOfferingsImg from "/src/assets/courseoffering.svg";
import labslotsImg from "/src/assets/labslotsimg.svg";
import mapsImg from "/src/assets/map.svg";
import previousImg from "/src/assets/previous.svg";
import achivementImg from "/src/assets/star.svg";
import upcomingImg from "/src/assets/upcoming.svg";

function Sidebar() {
  return (
    <nav className="sidebar">
      <ul>
        <li className={useMatch("/tv/labslots/:lab") ? "selected" : ""}>
          <Link to="/tv/labslots/all">
            <img src={labslotsImg} alt="" />
            Laborataries
          </Link>
          <ul className="sublinks">
            <li className={useMatch("/tv/labslots/lab1") ? "active" : ""}>
              <Link to="/tv/labslots/lab1">Lab 1</Link>
            </li>
            <li className={useMatch("/tv/labslots/lab2") ? "active" : ""}>
              <Link to="/tv/labslots/lab2">Lab 2</Link>
            </li>
            <li className={useMatch("/tv/labslots/ccna") ? "active" : ""}>
              <Link to="/tv/labslots/ccna">CCNA Lab</Link>
            </li>
            <li className={useMatch("/tv/labslots/sr") ? "active" : ""}>
              <Link to="/tv/labslots/sr">Seminar Room</Link>
            </li>
          </ul>
        </li>
        <li className={useMatch("/tv/courses") ? "selected" : ""}>
          <Link to="/tv/courses">
            <img src={CourseOfferingsImg} alt="" />
            Course Offerings
          </Link>
        </li>
        <li className={useMatch("/tv/upcoming") ? "selected" : ""}>
          <Link to="/tv/upcoming">
            <img src={upcomingImg} alt="" />
            Upcoming Events
          </Link>
        </li>
        <li className={useMatch("/tv/previous") ? "selected" : ""}>
          <Link to="/tv/previous">
            <img src={previousImg} alt="" />
            Previous Events
          </Link>
        </li>
        <li className={useMatch("/tv/achivements") ? "selected" : ""}>
          <Link to="/tv/achivements">
            <img src={achivementImg} alt="" />
            Achivements
          </Link>
        </li>
        <li className={useMatch("/tv/maps") ? "selected" : ""}>
          <Link to="/tv/maps">
            <img src={mapsImg} alt="" />
            Maps
          </Link>
        </li>
      </ul>
    </nav>
  );
}

export default Sidebar;
