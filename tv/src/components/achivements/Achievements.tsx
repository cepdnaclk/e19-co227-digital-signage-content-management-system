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
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(null);

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedImageIndex === null) {
        setCurrentImageIndex((prevIndex) => (prevIndex + 1) % images.length);
      }
    }, 5000); // Change image every 5 seconds (5000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedImageIndex]);

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

  const handleImageClick = (index: number) => {
    setCurrentImageIndex(index);
    setClickedImageIndex(null); // Reset clickedImageIndex to null to exit full-screen mode
  };

  return (
    <div className="achievements-container">
      <div className="image-controls">
        <button className="left" onClick={handlePrevImage}>&#10094;</button>
      </div>
      <div className="center-content">
        {clickedImageIndex !== null ? (
          <div>
            <img
              className="center-image"
              src={images[clickedImageIndex]}
              alt={`Achievement ${clickedImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        ) : (
          <div>
            <img
              className="center-image"
              src={images[currentImageIndex]}
              alt={`Achievement ${currentImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}
        <div className="image-title">
          &#10029; {imageTitles[currentImageIndex]} &#10029;
        </div>
        {/* <div className="image-text">
          This is the text below the title of the middle image.
        </div> */}
      </div>
      <div className="image-controls">
        <button className="right" onClick={handleNextImage}>&#10095;</button>
      </div>
      <div className="image-list">
        {images.map((image, index: number) => (
          <div
            key={index}
            className={`image-item ${
              currentImageIndex === index || clickedImageIndex === index
                ? "active"
                : ""
            }`}
            onClick={() => handleImageClick(index)}
          >
            <img src={image} alt={`Achievement ${index + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}
