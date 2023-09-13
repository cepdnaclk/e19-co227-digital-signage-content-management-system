// LabSlots.tsx
import React from "react";
import "./labslots.css";
import "./slot";
import Slot from "./slot";

const LabSlots: React.FC = () => {
  const timeSlots: string[] = [
    "08.00-09.00",
    "09.00-10.00",
    "10.00-11.00",
    "11.00-12.00",
    "12.00-13.00",
    "13.00-14.00",
    "14.00-15.00",
    "15.00-16.00",
    "16.00-17.00",
  ];

  type allocation = {
    lab: number;
    start: string;
    end: string;
    name: string;
  };

  const allocations: allocation[] = [
    {
      lab: 1,
      start: "13.30",
      end: "17.00",
      name: "Agri",
    },
    {
      lab: 2,
      start: "08.00",
      end: "12.00",
      name: "Vet",
    },
    {
      lab: 3,
      start: "10.00",
      end: "14.55",
      name: "CCNA",
    },
    {
      lab: 4,
      start: "10.00",
      end: "11.00",
      name: "Agri",
    },
  ];

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
      <div className="timetable">
        {timeSlots.map((slot, index) => (
          <div key={index} className="time-slot">
            <p>{slot}</p>
            {index > 0 && (
              <div className="line" style={{ gridRow: index + 1 }}></div>
            )}
          </div>
        ))}
        {allocations.map((lab, index) => (
          <Slot details={lab} key={index} />
        ))}
      </div>
    </div>
  );
};

export default LabSlots;
