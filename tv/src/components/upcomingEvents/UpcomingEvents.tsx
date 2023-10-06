import React, { useState, useEffect } from "react";
import axios from "axios";
import "./upcomingevents.css";
import img1 from "../../assets/upcoming-event-posters/upcoming-event-1.jpg";
import img2 from "../../assets/upcoming-event-posters/upcoming-event-2.jpg";
import img3 from "../../assets/upcoming-event-posters/upcoming-event-3.jpg";
import img4 from "../../assets/upcoming-event-posters/upcoming-event-4.png";
import img5 from "../../assets/upcoming-event-posters/upcoming-event-5.jpg"; // Add  images import here
//Test images

export default function UpcomingEvents() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const images = [img1, img2, img3, img4, img5]; // Add  image paths to this array

  useEffect(() => {
    const timer = setTimeout(() => {
      // Increment the current image index
      setCurrentImageIndex((prevIndex) =>
        prevIndex === images.length - 1 ? 0 : prevIndex + 1
      );
    }, 5000); // Change the time interval (in milliseconds) as needed

    return () => {
      // Clean up the timer to avoid memory leaks
      clearTimeout(timer);
    };
  }, [currentImageIndex, images]);

  useEffect(() => {
    axios
      .get(`http://localhost:8000/backend/api/previous/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          console.log(res.data);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  return (
    <div className="upcoming-events">
      <img
        src={images[currentImageIndex]}
        alt={`Upcoming Event ${currentImageIndex + 1}`}
      />
    </div>
  );
}
