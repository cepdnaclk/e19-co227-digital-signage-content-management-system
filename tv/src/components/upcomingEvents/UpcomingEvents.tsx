import React, { useState, useEffect } from "react";
import "./upcomingevents.css";
import img1 from "../../assets/upcoming-event-1.jpg";
import img2 from "../../assets/upcoming-event-2.jpg";
import img3 from "../../assets/upcoming-event-3.jpg";
import img4 from "../../assets/upcoming-event-4.png"; // Add  images import here
import img5 from "../../assets/ITCenterLogo.svg";



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

  return (
    
    <div className="upcoming-events">
      <img src={images[currentImageIndex]} alt={`Upcoming Event ${currentImageIndex + 1}`} />
    </div>
    
  );
}

