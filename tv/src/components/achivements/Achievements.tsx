import React, { useState, useEffect } from "react";
import "./achievements.css"; // CSS file
import img1 from "../../assets/achievements-posters/img-1.png";
import img2 from "../../assets/achievements-posters/img-2.png";
import img3 from "../../assets/achievements-posters/img-3.jpg";
import img4 from "../../assets/achievements-posters/img-4.jpg";
import img5 from "../../assets/achievements-posters/img-5.jpg";
import img6 from "../../assets/achievements-posters/img-6.jpg";
import img7 from "../../assets/achievements-posters/img-7.jpeg";
import img8 from "../../assets/achievements-posters/img-8.jpeg";
import img9 from "../../assets/achievements-posters/img-9.jpg";

const initialImages = [img1, img2, img3, img4, img5, img6, img7, img8, img9]; // All images
const imageTitles = [
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner",
  "Epic Lanka Award Winner",
  "National ICT Award Winner"
];

export default function Achievements() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(null);

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedImageIndex === null) {
        setCurrentImageIndex((prevIndex) => (prevIndex + 1) % initialImages.length);
      }
    }, 10000); // Change image every 10 seconds (10000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedImageIndex]);

  const handlePrevImage = () => {
    setCurrentImageIndex((prevIndex) =>
      prevIndex === 0 ? initialImages.length - 1 : prevIndex - 1
    );
  };

  const handleNextImage = () => {
    setCurrentImageIndex((prevIndex) =>
      prevIndex === initialImages.length - 1 ? 0 : prevIndex + 1
    );
  };

  const handleImageClick = (index: number) => {
    setCurrentImageIndex(index);
    setClickedImageIndex(null); // Reset clickedImageIndex to null to exit full-screen mode
  };

  // Determine the number of images to display in the list
  const numImagesToDisplay = Math.min(6, initialImages.length);
  const displayedImages = Array.from({ length: numImagesToDisplay }, (_, i) =>
    initialImages[(currentImageIndex + i) % initialImages.length]
  );

  return (
    <div className="achievements-container">
      <div className="image-controls">
        <button className="left" onClick={handlePrevImage}>
          &#10094;
        </button>
      </div>
      <div className="center-content">
        {clickedImageIndex !== null ? (
          <div>
            <img
              className="center-image"
              src={initialImages[clickedImageIndex]}
              alt={`Achievement ${clickedImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        ) : (
          <div>
            <img
              className="center-image"
              src={initialImages[currentImageIndex]}
              alt={`Achievement ${currentImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}
        <div className="image-title">
          &#9733; {imageTitles[currentImageIndex]} &#9733;
        </div>
      </div>
      <div className="image-controls">
        <button className="right" onClick={handleNextImage}>
          &#10095;
        </button>
      </div>
      <div className="image-list">
        {displayedImages.map((image, index) => (
          <div
            key={index}
            className={`image-item ${
              currentImageIndex === (currentImageIndex + index) % initialImages.length || clickedImageIndex === (currentImageIndex + index) % initialImages.length
                ? "active"
                : ""
            }`}
            onClick={() => handleImageClick((currentImageIndex + index) % initialImages.length)}
          >
            <img src={image} alt={`Achievement ${(currentImageIndex + index) % initialImages.length + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}
