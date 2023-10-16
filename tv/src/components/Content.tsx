// Content.tsx
import axios from "axios";
import React, { useState, useEffect } from "react";
import { Outlet, useNavigate } from "react-router-dom";
import "./content.css";

const Content = () => {
  const [data, setData] = useState([]);
  const [currentIndex, setCurrentIndex] = useState(0);
  const navigate = useNavigate();
  const [timerId, setTimerId] = useState(null);
  const [active, setActive] = useState(false);
  const [activeTimer, setActiveTimer] = useState(false);

  const routes = [
    {
      path: "/labslots/all",
      name: "Lab Slots",
    },
    {
      path: "/courses",
      name: "Course Offerings",
    },
    {
      path: "/labslots/all",
      name: "Lab Slots",
    },
    {
      path: "/upcoming",
      name: "Upcoming Events",
    },
    {
      path: "/labslots/all",
      name: "Lab Slots",
    },
    {
      path: "/previous",
      name: "Previous Events",
    },
    {
      path: "/labslots/all",
      name: "Lab Slots",
    },
    {
      path: "/achivements",
      name: "Achievements",
    },
  ];

  useEffect(() => {
    axios
      .get(`/backend/api/dashboard/get.php`)
      .then((res) => {
        setData(res.data.features);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  const handleUserActivity = () => {
    if (timerId) {
      clearTimeout(timerId);
      setTimerId(null);
    }
    clearTimeout(activeTimer);
    setActive(true);
    const activeT = setTimeout(() => {
      setActive(false);
    }, 2000);
    setActiveTimer(activeT);
  };

  useEffect(() => {
    const { path } = routes[currentIndex];
    const { name } =
      routes[currentIndex > 0 ? currentIndex - 1 : routes.length - 1];
    const time = data[name] ? data[name].time : 100000000;

    if (!active) {
      const timeoutId = setTimeout(() => {
        navigate(path);
        setCurrentIndex((prevIndex) =>
          prevIndex < routes.length - 1 ? prevIndex + 1 : 0
        );
      }, time * 1000);

      // Store the timer ID
      setTimerId(timeoutId);

      return () => clearTimeout(timeoutId);
    }
  }, [currentIndex, data, active]);

  useEffect(() => {
    // Attach event listeners for user activity
    window.addEventListener("mousemove", handleUserActivity);

    return () => {
      // Clean up event listeners
      window.removeEventListener("mousemove", handleUserActivity);
    };
  }, []);

  return (
    <div className="content">
      <Outlet />
    </div>
  );
};

export default Content;
