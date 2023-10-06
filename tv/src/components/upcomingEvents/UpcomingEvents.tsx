import React, { useState, useEffect } from "react";
import "./upcomingevents.css";
import img1 from "../../assets/upcoming-event-posters/upcoming-event-1.jpg";
import img2 from "../../assets/upcoming-event-posters/upcoming-event-2.jpg";
import img3 from "../../assets/upcoming-event-posters/upcoming-event-3.jpg";
import img4 from "../../assets/upcoming-event-posters/upcoming-event-4.png";
import img5 from "../../assets/upcoming-event-posters/upcoming-event-5.jpg"; // Add  images import here

const initialImages = [img1, img2, img3, img4, img5]; // All images

// const imageTitles = [
//   "NBQSA -The National Best Quality Software Awards",
//   "6th International Conference on Industrial and Information Systems, ICIIS 2021",
//   "PREVET 2023 for VET Undergraduates",
//   "Certificate-Based Computer Skills program (CBCS) -Batch 1",
//   "SITSEP- Staff IT Skills Development Programme- 2022 – Batch 2- Poster Presentation"
// ];

export default function UpcomingEvents() {
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
    <div className="upcomingevents-container">
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
              alt={`UpcomingEvents ${clickedImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        ) : (
          <div>
            <img
              className="center-image"
              src={initialImages[currentImageIndex]}
              alt={`UpcomingEvents ${currentImageIndex + 1}`}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}
        {/* <div className="image-title">
          {imageTitles[currentImageIndex]}
        </div> */}
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
            <img src={image} alt={`UpcomingEvents ${(currentImageIndex + index) % initialImages.length + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}

