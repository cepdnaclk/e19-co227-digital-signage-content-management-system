// LabSlots.tsx
import React from 'react';
import './labSlots.css';

const LabSlots: React.FC = () => {
  return (
    <div className="lab-slots">
      <h2>Lab Slots for Today</h2>
      <div className="lab-slot-table">
        <div className="lab-slot">
          <h3>Lab 1</h3>
          <p>08:00 AM - 10:00 AM</p>
          <p>Available</p>
        </div>
        <div className="lab-slot">
          <h3>Lab 2</h3>
          <p>10:30 AM - 12:30 PM</p>
          <p>Occupied</p>
        </div>
        <div className="lab-slot">
          <h3>CCNA Lab</h3>
          <p>01:00 PM - 03:00 PM</p>
          <p>Available</p>
        </div>
        <div className="lab-slot">
          <h3>Seminar Room</h3>
          <p>03:30 PM - 05:30 PM</p>
          <p>Available</p>
        </div>
      </div>
    </div>
  );
};

export default LabSlots;
