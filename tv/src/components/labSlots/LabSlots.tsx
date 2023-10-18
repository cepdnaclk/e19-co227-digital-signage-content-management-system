import React, { useState, useEffect } from "react";
import { useMatch } from "react-router-dom";
import "./labslots.css";
import Slot from "./slot";
import axios from "axios";

const LabSlots: React.FC = () => {
  const [data, setData] = useState([]);
  const [date, setDate] = useState(new Date());
  const param = useMatch("/labslots/:lab").params.lab;
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

  const dateFormatter = (currentDate: Date): string => {
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");

    const formattedDate: string = `${year}-${month}-${day}`;
    return formattedDate;
  };

  const isToday = (date: Date) => {
    const currentDate: Date = new Date();
    return (
      currentDate.getFullYear() === date.getFullYear() &&
      currentDate.getMonth() === date.getMonth() &&
      currentDate.getDate() === date.getDate()
    );
  };

  const shortMonthDateFormatter = (currentDate: Date): string => {
    const year = currentDate.getFullYear();
    const monthNames = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    const month = monthNames[currentDate.getMonth()];
    const day = String(currentDate.getDate()).padStart(2, "0");

    const formattedDate: string = `${day} ${month} ${year}`;
    return formattedDate;
  };

  useEffect(() => {
    const today = date;
    const formattedDate = dateFormatter(today);

    axios
      .get(`/backend/api/labslots/get.php?date=${formattedDate}`)
      .then((res) => {
        setData([]);
        console.log(res.data);
        if (res.data.length >= 1) {
          if (param != "all") {
            setData(res.data.filter((slot) => slot.lab == param));
          } else {
            setData(res.data);
          }
        }
      })
      .catch((err) => {
        console.log(err);
      });
  }, [param, date]);

  const labMapping = {
    lab1: 1,
    lab2: 2,
    ccna: 3,
    sr: 4,
  };

  const convertTimeFormat = (timeString: string): string => {
    // Split the input time string by ':' to get hours and minutes
    const timeParts: string[] = timeString.split(":");

    // Ensure we have at least hours and minutes
    if (timeParts.length >= 2) {
      // Extract hours and minutes
      const hours = timeParts[0];
      const minutes = timeParts[1];

      // Combine hours and minutes with a dot separator
      const formattedTime: string = `${hours}.${minutes}`;

      return formattedTime;
    } else {
      // Return the original string if it doesn't match the expected format
      return timeString;
    }
  };

  const allocations = data.map((item) => ({
    lab: labMapping[item.lab] ?? null,
    start: convertTimeFormat(item.start),
    end: convertTimeFormat(item.end),
    name: item.course,
  }));

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
        <h3>{isToday(date) ? "Today" : shortMonthDateFormatter(date)}</h3>
        <p>{isToday(date) ? shortMonthDateFormatter(date) : ""}</p>
      </div>
      <div className="datepicker">
        <label htmlFor="">Choose date</label>
        <input
          type="date"
          onChange={(e) => setDate(new Date(e.target.value))}
          value={dateFormatter(date)}
        />
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
