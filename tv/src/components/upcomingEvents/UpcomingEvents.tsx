import React, { useState, useEffect } from "react";
import axios from "axios";
import "./upcomingevents.css";

export default function UpcomingEvents() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(
    null
  );
  const [initialImages, setInitialImages] = useState([]);
  const [data, setData] = useState([]);

  useEffect(() => {
    axios
      .get(`/backend/api/upcoming/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          setData(res.data);
          let array = [];
          res.data.forEach((ele) => {
            array.push("http://localhost:8000" + ele["e_img"]);
          });
          setInitialImages(array);
          console.log(data);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedImageIndex === null) {
        setCurrentImageIndex(
          (prevIndex) => (prevIndex + 1) % initialImages.length
        );
      }
    }, 10000); // Change image every 10 seconds (10000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedImageIndex, initialImages]);

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
  const displayedImages = Array.from(
    { length: numImagesToDisplay },
    (_, i) => initialImages[(currentImageIndex + i) % initialImages.length]
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
              alt={initialImages[currentImageIndex]}
              onClick={() => handleImageClick(currentImageIndex)}
            />
          </div>
        )}
        {/* <div className="image-title">{data[currentImageIndex]["e_name"]}</div> */}
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
              currentImageIndex ===
                (currentImageIndex + index) % initialImages.length ||
              clickedImageIndex ===
                (currentImageIndex + index) % initialImages.length
                ? "active"
                : ""
            }`}
            onClick={() =>
              handleImageClick(
                (currentImageIndex + index) % initialImages.length
              )
            }
          >
            <img
              src={image}
              alt={`UpcomingEvents ${
                ((currentImageIndex + index) % initialImages.length) + 1
              }`}
            />
          </div>
        ))}
      </div>
    </div>
  );
}
