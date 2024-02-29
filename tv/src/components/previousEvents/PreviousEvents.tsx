import axios from "axios";
import { useContext, useEffect, useState } from "react";
import TimingContext from "../../context/TimingContext";
import "./previousevents.css"; // CSS file

export default function PreviousEvents() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(
    null
  );
  const [initialImages, setInitialImages] = useState([]);
  const { timings, setTimings, imageIndex, setImageIndex } =
    useContext(TimingContext);

  useEffect(() => {
    axios
      .get(`/backend/api/previous/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          let array = [];
          res.data.forEach((ele) => {
            array.push(axios.defaults.baseURL + ele["e_img"]);
          });
          setInitialImages(array);
        } else {
          setInitialImages([`${axios.defaults.baseURL}/images/notFound.png`]);
        }

        setCurrentImageIndex(imageIndex["Previous Events"] || 0);
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
    }, timings["Previous Events"]["time_slide"] * 1000); // Change image every 10 seconds (10000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedImageIndex, initialImages]);

  useEffect(() => {
    const indexData = { ...imageIndex };
    indexData["Previous Events"] = currentImageIndex;
    setImageIndex(indexData);
  }, [currentImageIndex]);

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

  let intervalId = null;

  useEffect(() => {
    const centerContent = document.querySelector(".center-content");
    let startX = 0;

    if (!intervalId) {
      intervalId = setInterval(() => {
        handleNextImage();
      }, timings["Upcoming Events"]["time_slide"] * 1000);
    }

    const handleTouchStart = (e) => {
      startX = e.touches[0].clientX; // Store initial touch position

      if (intervalId) {
        clearInterval(intervalId);
      }
    };

    const handleTouchEnd = (e) => {
      const swipeDistance = e.changedTouches[0].clientX - startX; // Calculate swipe distance
      if (swipeDistance > 50 && !clickedImageIndex) {
        // Minimum swipe distance threshold (adjust as needed)
        handleNextImage();
      } else if (swipeDistance < -50 && !clickedImageIndex) {
        handlePrevImage();
      }
      startX = 0; // Reset startX on touch end
      if (!intervalId) {
        intervalId = setInterval(() => {
          handleNextImage();
        }, timings["Upcoming Events"]["time_slide"] * 1000);
      }
    };

    centerContent.addEventListener("touchstart", handleTouchStart);
    centerContent.addEventListener("touchend", handleTouchEnd);

    return () => {
      centerContent.removeEventListener("touchstart", handleTouchStart);
      centerContent.removeEventListener("touchend", handleTouchEnd);
      if (intervalId) {
        clearInterval(intervalId);
      }
    };
  }, [handlePrevImage, handleNextImage, clickedImageIndex]);
  
  // Determine the number of images to display in the list
  const numImagesToDisplay = Math.min(6, initialImages.length);
  const displayedImages = Array.from(
    { length: numImagesToDisplay },
    (_, i) => initialImages[(currentImageIndex + i) % initialImages.length]
  );

  return (
    <div className="previous">
      <div className="previousevents-container">
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
          {/* <div className="image-title">{imageTitles[currentImageIndex]}</div> */}
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
                alt={`PreviousEvents ${
                  ((currentImageIndex + index) % initialImages.length) + 1
                }`}
              />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
