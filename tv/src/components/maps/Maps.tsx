import React, { useState, useEffect } from "react";
import axios from "axios";
import "./maps.css"; // Make sure to adjust the CSS file accordingly

export default function Maps() {
  const [currentVideoIndex, setCurrentVideoIndex] = useState(0);
  const [clickedVideoIndex, setClickedVideoIndex] = useState<number | null>(
    null
  );
  const [initialVideos, setInitialVideos] = useState<string[]>([]);
  const [data, setData] = useState<any[]>([]); // Adjust the type as per your API response

  useEffect(() => {
    axios
      .get(`/backend/api/maps/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          setData(res.data);
          let array = [];
          res.data.forEach((ele) => {
            array.push(axios.defaults.baseURL + ele["m_file"]);
          });
          setInitialVideos(array);
          console.log(data);
          console.log(array);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  // useEffect(() => {
  //   const interval = setInterval(() => {
  //     if (clickedVideoIndex === null) {
  //       setCurrentVideoIndex(
  //         (prevIndex) => (prevIndex + 1) % initialVideos.length
  //       );
  //     }
  //   }, 10000); // Change video every 10 seconds (10000 milliseconds)

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedVideoIndex === null) {
        // Check if the current video has reached the end
        const currentVideo = document.getElementById("center-video");
        if (currentVideo.currentTime === currentVideo.duration) {
          handleNextVideo();
        } else {
          setCurrentVideoIndex(
            (prevIndex) => (prevIndex + 1) % initialVideos.length
          );
        }
      }
    }, 20000); // Change video every 20 seconds (20000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedVideoIndex, initialVideos]);

  const handlePrevVideo = () => {
    setCurrentVideoIndex((prevIndex) =>
      prevIndex === 0 ? initialVideos.length - 1 : prevIndex - 1
    );
  };

  const handleNextVideo = () => {
    setCurrentVideoIndex((prevIndex) =>
      prevIndex === initialVideos.length - 1 ? 0 : prevIndex + 1
    );
  };

  const handleVideoClick = (index: number) => {
    setCurrentVideoIndex(index);
    setClickedVideoIndex(null); // Reset clickedVideoIndex to null to exit full-screen mode
  };

  // Determine the number of videos to display in the list
  const numVideosToDisplay = Math.min(6, initialVideos.length);
  const displayedVideos = Array.from(
    { length: numVideosToDisplay },
    (_, i) => initialVideos[(currentVideoIndex + i) % initialVideos.length]
  );

  return (
    <div className="map-videos">
      <div className="mapvideos-container">
        <div className="video-controls">
          <button className="left" onClick={handlePrevVideo}>
            &#10094;
          </button>
        </div>
        <div className="center-content">
          <video
            className="center-video"
            autoPlay 
            muted
            src={initialVideos[currentVideoIndex]}
            onClick={() => handleVideoClick(currentVideoIndex)}
            onEnded={handleNextVideo}

          />
        </div>
        <div className="video-controls">
          <button className="right" onClick={handleNextVideo}>
            &#10095;
          </button>
        </div>
        <div className="video-list">
          {displayedVideos.map((video, index) => (
            <div
              key={index}
              className={`video-item ${
                currentVideoIndex ===
                  (currentVideoIndex + index) % initialVideos.length ||
                clickedVideoIndex ===
                  (currentVideoIndex + index) % initialVideos.length
                  ? "active"
                  : ""
              }`}
              onClick={() =>
                handleVideoClick(
                  (currentVideoIndex + index) % initialVideos.length
                )
              }
            >
              <video autoPlay muted src={video} />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
