const dates = document.querySelectorAll(".timetable .day");
const dateCaption = document.querySelectorAll(".timetable .day .date");
const dateColHeight =
  dates[0].getBoundingClientRect().height -
  dateCaption[0].getBoundingClientRect().height;

const baseStartTime = new Date();
baseStartTime.setHours(8, 0, 0);
const baseEndTime = new Date();
baseEndTime.setHours(17, 0, 0);

const calHeight = (start, end) => {
  const startTimeParts = start.split(":");
  const endTimeParts = end.split(":");

  const startTime = new Date();
  startTime.setHours(
    parseInt(startTimeParts[0]),
    parseInt(startTimeParts[1]),
    0
  );

  const endTime = new Date();
  endTime.setHours(parseInt(endTimeParts[0]), parseInt(endTimeParts[1]), 0);

  const timeDifference = endTime - startTime;
  const totalTimeSpan = baseEndTime - baseStartTime;

  return (timeDifference / totalTimeSpan) * dateColHeight;
};

const calTop = (start) => {
  const startTimeParts = start.split(":");

  const startTime = new Date();
  startTime.setHours(
    parseInt(startTimeParts[0]),
    parseInt(startTimeParts[1]),
    0
  );

  const timeDifference = startTime - baseStartTime;
  const totalTimeSpan = baseEndTime - baseStartTime;

  return (
    (timeDifference / totalTimeSpan) * dateColHeight +
    dateCaption[0].getBoundingClientRect().height
  );
};

function convertTimeFormat(timeString) {
  // Split the input time string by ':' to get hours and minutes
  const timeParts = timeString.split(":");

  // Ensure we have at least hours and minutes
  if (timeParts.length >= 2) {
    // Extract hours and minutes
    const hours = timeParts[0];
    const minutes = timeParts[1];

    // Combine hours and minutes with a dot separator
    const formattedTime = `${hours}.${minutes}`;

    return formattedTime;
  } else {
    // Return the original string if it doesn't match the expected format
    return timeString;
  }
}

const labslot = (id, date, start, end, course) => {
  let labSlot = document.getElementById(id);
  if (!labSlot) {
    labSlot = document.createElement("div");
    labSlot.classList.add("labslot");
    labSlot.id = id;
    const h3 = document.createElement("h3");
    h3.textContent = course;
    const p = document.createElement("p");
    p.textContent = `${convertTimeFormat(start)} - ${convertTimeFormat(end)}`;
    labSlot.appendChild(h3);
    labSlot.appendChild(p);
    dates[date].appendChild(labSlot);
  }

  labSlot.style.height = `${calHeight(start, end)}px`;
  labSlot.style.top = `${calTop(start)}px`;
};
