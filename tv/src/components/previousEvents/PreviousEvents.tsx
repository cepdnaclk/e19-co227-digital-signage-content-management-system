import React, { useState, useEffect } from "react";
import axios from "axios";
import "./previousevents.css";

export default function PreviousEvents() {
  const [events, setEvents] = useState([]);
  const [currentSlide, setCurrentSlide] = useState(0);

  useEffect(() => {
    const slideInterval = setInterval(() => {
      setCurrentSlide((prevSlide) => (prevSlide + 1) % (events.length - 1));
    }, 10000); // Change to 10,000 milliseconds (10 seconds)

    return () => clearInterval(slideInterval);
  }, [events.length]);

  useEffect(() => {
    axios
      .get(`http://localhost:8000/backend/api/previous/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          setEvents(res.data);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  const visibleEvents = events.slice(currentSlide, currentSlide + 2);

  return (
    <div className="card-container">
      {visibleEvents.map((event, index) => (
        <div className="card" key={index}>
          <img
            src={"http://localhost:8000/" + event.e_img}
            alt={event.e_name}
            className="card-image"
          />
          <div className="card-content">
            <h2 className="card-title">{event.e_name}</h2>
            <div className="card-description">
              <p>Date : {event.e_date}</p>
              <p>Time : {event.e_time}</p>
              <p>Venue : {event.e_venue}</p>
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}
