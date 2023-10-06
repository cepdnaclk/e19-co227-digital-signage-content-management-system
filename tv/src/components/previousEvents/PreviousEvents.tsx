import React, { useState, useEffect } from "react";
import axios from "axios";
import "./previousevents.css";

export default function PreviousEvents() {
  const [events, setEvents] = useState([]);
  const [currentSlide, setCurrentSlide] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      if (clickedImageIndex === null) {
        setCurrentImageIndex((prevIndex) => (prevIndex + 1) % images.length);
      }
    }, 8000); // Change image every 5 seconds (5000 milliseconds)

    return () => {
      clearInterval(interval);
    };
  }, [clickedImageIndex]);

  const handlePrevImage = () => {
    setCurrentImageIndex((prevIndex) =>
      prevIndex === 0 ? images.length - 1 : prevIndex - 1
    );
  };

    return () => clearInterval(slideInterval);
  }, [events.length]);

  useEffect(() => {
    axios
      .get(`http://localhost:8000/backend/api/previous/get.php`)
      .then((res) => {
        if (res.data.length >= 1) {
          setEvents(res.data);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  const handleImageClick = (index: number) => {
    setCurrentImageIndex(index);
    setClickedImageIndex(null); // Reset clickedImageIndex to null to exit full-screen mode
  };

  return (
    <div className="card-container">
      {visibleEvents.map((event, index) => (
        <div className="card" key={index}>
          <img
            src={"http://localhost:8000/" + event.e_img}
            alt={event.e_name}
            className="card-image"
          />
          <div className="card-content">
            <h2 className="card-title">{event.e_name}</h2>
            <div className="card-description">
              <p>Date : {event.e_date}</p>
              <p>Time : {event.e_time}</p>
              <p>Venue : {event.e_venue}</p>
            </div>
          </div>
        )}
        {/* <div className="image-title">
          {imageTitles[currentImageIndex]};
        </div> */}
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
            <img src={image} alt={`PreviousEvents ${index + 1}`} />
          </div>
        ))}
      </div>
    </div>
  );
}










// export default function PreviousEvents() {
//   const events = [
//     {
//       title: "NBQSA -The National Best Quality Software Awards",
//       description: "NBQSA -The National Best Quality Software Awards. The awareness session for the University of Peradeniya was held on 16th June at the IT Center. This was organized by BCS- The charted institute for IT and University of Peradeniya. NBQSA has been recognizing and honoring individuals and organizations in Sri Lanka who have made notable contributions to the development of high-quality ICT products. The objective of the competition is to elevate local ICT product standards to meet international marketplace requirements.",
//       image: img1,
//     },
//     {
//       title: "6th International Conference on Industrial and Information Systems, ICIIS 2021",
//       description: "6th International Conference on Industrial and Information Systems, ICIIS 2021 was held on 2021 December 9-10. This event was organized by Department of Electrical and Electronic Engineering Faculty of Engineering and all technical support was provided by the Information Technology Center, University of Peradeniya.",
//       image: img2,
//     },
//     {
//       title: "PREVET 2023 for VET Undergraduates",
//       description: "The PREVET course for the First year undergraduates of the Faculty of Veterinary Medicine and Animal Science started on 19/07/2023 at the IT Center",
//       image: img3,
//     },
//     {
//       title: "Certificate-Based Computer Skills program (CBCS) -Batch 1",
//       description: "The inauguration and orientation of Batch I of the Certificate-Based Computer Skills program (CBCS) by the IT Center for undergraduates of the University of Peradeniya. This initiative focuses on offering students a certificate through self-directed learning and examination.",
//       image: img4,
//     },
//   ];

//   const [currentSlide, setCurrentSlide] = useState(0);

//   useEffect(() => {
//     const slideInterval = setInterval(() => {
//       setCurrentSlide((prevSlide) => (prevSlide + 1) % (events.length - 1));
//     }, 10000); // Change to 10,000 milliseconds (10 seconds)

//     return () => clearInterval(slideInterval);
//   }, [events.length]);

//   const visibleEvents = events.slice(currentSlide, currentSlide + 2);

//   return (
//     <div className="card-container">
//       {visibleEvents.map((event, index) => (
//         <div className="card" key={index}>
//           <img src={event.image} alt={event.title} className="card-image" />
//           <div className="card-content">
//             <h2 className="card-title">{event.title}</h2>
//             <div className="card-description">
//               <p>{event.description}</p>
//             </div>
//           </div>
//         </div>
//       ))}
//     </div>
//   );
// }