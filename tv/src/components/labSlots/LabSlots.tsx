// LabSlots.tsx
import React from "react";
import "./labSlots.css";
import img from "../../assets/lab-slots-img.png";


const LabSlots: React.FC = () => {
  return (
    // <div className="labslots">
    //   <div className="legend">
    //     <div className="legend-bit"></div>
    //   </div>
    //   <div className="date"></div>
    // </div>

    <div className="lab-slot-image">
      <img src={img}/>
    </div>
  );
};

export default LabSlots;
