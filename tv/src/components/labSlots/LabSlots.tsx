// LabSlots.tsx
import React from "react";
import "./labSlots.css";

const LabSlots: React.FC = () => {
  return (
    <div className="labslots">
      <div className="legend">
        <div className="legend-bit">
          <div className="color-box"></div>
        </div>
      </div>
      <div className="date"></div>
    </div>
  );
};

export default LabSlots;
