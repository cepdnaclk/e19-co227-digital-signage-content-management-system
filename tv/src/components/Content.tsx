// Content.tsx
import axios from "axios";
import React, { useState, useEffect } from "react";
import { Outlet, useNavigate } from "react-router-dom";
import "./content.css";

const Content = () => {
  const [data, setData] = useState([]);
  const [currentIndex, setCurrentIndex] = useState(0);
  const navigate = useNavigate();

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
        console.log(res.data.features);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  useEffect(() => {
    if (currentIndex < routes.length) {
      const { path } = routes[currentIndex];
      const { name } =
        routes[currentIndex > 0 ? currentIndex - 1 : routes.length - 1];
      const time = data[name] ? data[name].time : "";
      if (time > 1) {
        const timeoutId = setTimeout(() => {
          navigate(path);
          setCurrentIndex((prevIndex) => prevIndex + 1);
        }, time * 1000);

        return () => clearTimeout(timeoutId);
      }
    } else {
      setCurrentIndex(0);
    }
  }, [currentIndex, data]);

  return (
    <div className="content">
      <Outlet />
    </div>
  );
};

export default Content;
