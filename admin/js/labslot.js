const dates = document.querySelectorAll(".timetable");
const dateCaption = document.querySelectorAll(".timetable .date");
const captionHeight = dateCaption[0].getBoundingClientRect().height;
const dateColHeight = dates[0].getBoundingClientRect().height - captionHeight;

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

const findGridRow = (start) => {
  const startTimeParts = start.split(":");

  const startTime = new Date();
  startTime.setHours(
    parseInt(startTimeParts[0]),
    parseInt(startTimeParts[1]),
    0
  );

  const timeDifference = startTime - baseStartTime;
  const totalTimeSpan = baseEndTime - baseStartTime;

  return Math.floor(((timeDifference / totalTimeSpan) * dateColHeight) / 50);
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

  return ((timeDifference / totalTimeSpan) * dateColHeight) % 50;
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

const selectedTimeAsDate = (time) => {
  const [hours, minutes] = time.split(":");
  const timeAsDate = new Date();
  timeAsDate.setHours(parseInt(hours), parseInt(minutes), 0, 0);

  return timeAsDate;
};

const clipTime = (newTime, lowerBound, upperBound) => {
  const start = selectedTimeAsDate(lowerBound);
  const end = selectedTimeAsDate(upperBound);
  const nowTime = selectedTimeAsDate(newTime);

  if (start > nowTime) return lowerBound;
  if (end < nowTime) return upperBound;
  else return newTime;
};
