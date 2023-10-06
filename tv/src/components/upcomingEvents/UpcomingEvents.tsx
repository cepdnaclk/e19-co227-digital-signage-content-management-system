import React, { useState, useEffect } from "react";
import "./upcomingevents.css";
import img1 from "../../assets/upcoming-event-posters/upcoming-event-1.jpg";
import img2 from "../../assets/upcoming-event-posters/upcoming-event-2.jpg";
import img3 from "../../assets/upcoming-event-posters/upcoming-event-3.jpg";
import img4 from "../../assets/upcoming-event-posters/upcoming-event-4.png";
import img5 from "../../assets/upcoming-event-posters/upcoming-event-5.jpg";  // Add  images import here
//Test images

const images = [img1, img2, img3, img4, img5];
export default function Upcomingevents() {
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
    <div className="upcomingevents-container">
      <div className="image-controls">
        <button className="left" onClick={handlePrevImage}>&#10094;</button>
      </div>
      <div className="center-content">
        {clickedImageIndex !== null ? (
          <div>
            <img
              className="center-image"
              src={images[clickedImageIndex]}
              alt={`upcomingevent ${clickedImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        ) : (
          <div>
            <img
              className="center-image"
              src={images[currentImageIndex]}
              alt={`upcomingevent ${currentImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}


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
            <img src={image} alt={`upcomingevent ${index + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}