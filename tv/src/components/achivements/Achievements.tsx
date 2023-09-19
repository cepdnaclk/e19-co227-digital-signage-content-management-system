import React, { useState, useEffect } from "react";
import "./achievements.css"; // CSS file
import img1 from "../../assets/achievements-posters/th 6.png";
import img2 from "../../assets/achievements-posters/th 8.png"
import img4 from "../../assets/achievements-posters/th 6.png";
import img3 from "../../assets/achievements-posters/th 8.png"

const images = [img1, img2, img3, img4]; // Add more images as needed

export default function Achievements() {
  const [currentPage, setCurrentPage] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentPage((prevPage) => (prevPage + 1) % Math.ceil(images.length / 2));
    }, 6000); // Change page every 6 seconds (6000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, []);

  return (
    <div className="slider-container">
      <div className="slider">
        {images.slice(currentPage * 2, currentPage * 2 + 2).map((image, index) => (
          <div className="custom-card" key={index}>
            <img src={image} alt={`Card Title ${index + 1}`} className="custom-card-image" />
            <div className="custom-card-content">
              <div className="custom-card-header">
                <h2 className="custom-card-title">Achievement {index + 1}</h2>
                <button className="custom-card-button">View More</button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
