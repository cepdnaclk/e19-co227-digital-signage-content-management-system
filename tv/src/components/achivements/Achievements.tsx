import axios from "axios";
import { useEffect, useState } from "react";
import "./achievements.css";

export default function Achievements() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [clickedImageIndex, setClickedImageIndex] = useState<number | null>(
    null
  );

  const [initialImages, setInitialImages] = useState([]);
  const [data, setData] = useState([]);

  useEffect(() => {
    axios
      .get(`/backend/api/achivements/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          setData(res.data);
          let array = [];
          res.data.forEach((ele) => {
            array.push(axios.defaults.baseURL + ele["a_img"]);
          });
          setInitialImages(array);
          console.log(data);
        } else {
          setInitialImages([`${axios.defaults.baseURL}/images/notFound.png`]);
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
    <div className="achievement">
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
          {/* <div className="image-title">
          &#9733; {imageTitles[currentImageIndex]} &#9733;
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
                alt={`Achievement ${
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
