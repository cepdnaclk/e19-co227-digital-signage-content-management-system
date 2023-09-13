// LabSlots.tsx
import React from "react";
import "./labslots.css";

const LabSlots: React.FC = () => {
  return (
    <div className="labslots">
      <div className="legend">
        <div className="legend-bit lab1">
          <div className="color-box"></div>
          <p>Lab 1</p>
        </div>
        <div className="legend-bit lab2">
          <div className="color-box"></div>
          <p>Lab 2</p>
        </div>
        <div className="legend-bit lab3">
          <div className="color-box"></div>
          <p>CCNA Lab</p>
        </div>
        <div className="legend-bit sr">
          <div className="color-box"></div>
          <p>Seminar Room</p>
        </div>
      </div>
      <div className="date">
        <h3>Today</h3>
        <p>27 Aug 2023</p>
      </div>
    </div>
  );
};

export default LabSlots;
