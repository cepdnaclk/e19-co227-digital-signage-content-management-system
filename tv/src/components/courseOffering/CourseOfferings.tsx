import React, { useState, useEffect } from "react";
import "./courseofferings.css";
import { useSwipeable } from "react-swipeable";
import img1 from '../../assets/course-img-1.jpeg';
import img2 from '../../assets/course-img-2.jpeg';
import img3 from '../../assets/course-img-3.jpeg';

const courseOfferingImages = [
  img1,
  img2,
  img3
  // Add more image URLs as needed
];

export default function CourseOfferings() {
  const [currentIndex, setCurrentIndex] = useState(0);

  const handlers = useSwipeable({
    onSwipedLeft: () => handleSwipe("left"),
    onSwipedRight: () => handleSwipe("right"),
  });

  const handleSwipe = (direction: string) => {
    if (direction === "left") {
      setCurrentIndex((prevIndex) =>
        prevIndex === courseOfferingImages.length - 1 ? 0 : prevIndex + 1
      );
    } else if (direction === "right") {
      setCurrentIndex((prevIndex) =>
        prevIndex === 0 ? courseOfferingImages.length - 1 : prevIndex - 1
      );
    }
  };

  useEffect(() => {
    const interval = setInterval(() => {
      // Automatically swipe to the right image
      setCurrentIndex((prevIndex) =>
        prevIndex === 0 ? courseOfferingImages.length - 1 : prevIndex - 1
      );
    }, 5000); // 5000 milliseconds (5 seconds)

    return () => {
      clearInterval(interval); // Clear the interval when the component unmounts
    };
  }, []);

  return (
    <div className="course-offerings" {...handlers}>
      <div className="course-offering-container">
        <img
          src={courseOfferingImages[currentIndex]}
          alt={`Course Offering ${currentIndex + 1}`}
        />
        <div className="dot-indicators">
          {courseOfferingImages.map((_, index) => (
            <div
              key={index}
              className={`dot ${currentIndex === index ? "active-dot" : ""}`}
              onClick={() => setCurrentIndex(index)}
            ></div>
          ))}
        </div>
      </div>
    </div>
  );
}
