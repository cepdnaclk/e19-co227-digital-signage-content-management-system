import React, { useState, useEffect } from "react";
import "./previousevents.css"; // CSS file
import img1 from "../../assets/previous-events-posters/img1.jpg";
import img2 from "../../assets/previous-events-posters/img2.jpg";
import img3 from "../../assets/previous-events-posters/img3.jpg";
import img4 from "../../assets/previous-events-posters/img4.jpg";

const initialImages = [img1, img2, img3, img4]; // All images
const imageTitles = [
  "Providing technology support to the Ministry of Health - Central Province",
  "Website for Department of Ophthalmology (Center for Sight), Teaching Hospital, Kandy",
  "Gynecology and obstetrics patient information analysis system",
  "IT Center organizes a free workshop for GCE (O/L) students in and around Kandy",
];

export default function PreviousEvents() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(null);

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedImageIndex === null) {
        setCurrentImageIndex((prevIndex) => (prevIndex + 1) % initialImages.length);
      }
    }, 5000); // Change image every 5 seconds (5000 milliseconds)

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

  const displayedImages = initialImages.slice(0, 6);

  return (
    <div className="previousevents-container">
      <div className="image-controls">
        <button className="left" onClick={handlePrevImage}>
          &#10094;
        </button>
      </div>
      <div className="center-content">
        <div className="image-title">
          {imageTitles[currentImageIndex]}
        </div>
        {clickedImageIndex !== null ? (
          <div>
            <img
              className="center-image"
              src={initialImages[clickedImageIndex]}
              alt={`PreviousEvents ${clickedImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        ) : (
          <div>
            <img
              className="center-image"
              src={initialImages[currentImageIndex]}
              alt={`PreviousEvents ${currentImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}
        
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
              currentImageIndex === index || clickedImageIndex === index
                ? "active"
                : ""
            }`}
            onClick={() => handleImageClick(index)}
          >
            <img src={image} alt={`PreviousEvents ${index + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}
