import React, { useState, useEffect } from "react";
import "./achievements.css"; // CSS file
import img1 from "../../assets/achievements-posters/img-1.png";
import img2 from "../../assets/achievements-posters/img-2.png";
import img3 from "../../assets/achievements-posters/img-1.png";
import img4 from "../../assets/achievements-posters/img-2.png";
import img5 from "../../assets/achievements-posters/img-1.png";
import img6 from "../../assets/achievements-posters/img-2.png";

const images = [img1, img2, img3, img4, img5, img6]; // Add more images as needed

const imageTitles = [
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
];

export default function Achievements() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentImageIndex((prevIndex) => (prevIndex + 1) % images.length);
    }, 5000); // Change image every 5 seconds (5000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, []);

  const handlePrevImage = () => {
    setCurrentImageIndex((prevIndex) =>
      prevIndex === 0 ? images.length - 1 : prevIndex - 1
    );
  };

  const handleNextImage = () => {
    setCurrentImageIndex((prevIndex) =>
      prevIndex === images.length - 1 ? 0 : prevIndex + 1
    );
  };

  return (
    <div className="achievements-container">
      <div className="image-controls">
        <button className="left" onClick={handlePrevImage}>
          &lt;
        </button>
      </div>
      <div className="center-image">
        <img
          src={images[currentImageIndex]}
          alt={`Achievement ${currentImageIndex + 1}`}
        />
        <div className="image-title">
          {imageTitles[currentImageIndex]}
        </div>
        {/* <div className="image-text">
          This is the text below the title of the middle image.
        </div> */}
      </div>
      <div className="image-controls">
        <button className="right" onClick={handleNextImage}>
          &gt;
        </button>
      </div>
      <div className="image-list">
        {images.map((image, index) => (
          <div
            key={index}
            className={`image-item ${
              currentImageIndex === index ? "active" : ""
            }`}
          >
            <img src={image} alt={`Achievement ${index + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}
