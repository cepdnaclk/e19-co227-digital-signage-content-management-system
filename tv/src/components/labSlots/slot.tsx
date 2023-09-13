import { useState, useEffect } from "react";

const startTimeMinutes: number = convertToMinutes("08.00");
const endTimeMinutes: number = convertToMinutes("17.00");

const Slot: React.FC = ({ details }) => {
  const startMinutes: number = convertToMinutes(details.start);
  const endMinutes: number = convertToMinutes(details.end);

  const [tableHeight, setTableHeight] = useState(0);

  useEffect(() => {
    const tableElement = document.querySelector(".timetable");
    if (tableElement) {
      const height = tableElement.getBoundingClientRect().height;
      setTableHeight(height);
    }
  }, []);

  const style = {
    backgroundColor: `var(--color-${details.lab == 1 ? 1 : details.lab + 1})`,
    gridColumn: details.lab + 1,
    gridRow: getGridRow(startMinutes),
    height: `${getHeight(startMinutes, endMinutes, tableHeight)}px`,
    transform: `translateY(${getRowOffset(startMinutes, tableHeight)}px)`,
  };

  return (
    <div className="slot" style={style}>
      <h3 className="name">{details.name}</h3>
      <p>{details.start + " - " + details.end}</p>
    </div>
  );
};

function getHeight(start: number, end: number, tableHeight: number): number {
  return ((end - start) / (endTimeMinutes - startTimeMinutes)) * tableHeight;
}

const getGridRow = (start: number): number => {
  return Math.floor((start - startTimeMinutes) / 60) + 1;
};

const getRowOffset = (start: number, tableHeight: number): number => {
  return (((start - startTimeMinutes) % 60) * tableHeight) / (60 * 9);
};

function convertToMinutes(time: string): number {
  const [hours, minutes] = time.split(".").map(Number);
  return hours * 60 + minutes;
}

export default Slot;
