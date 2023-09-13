// Content.tsx
import React, { FunctionComponent } from "react";
import LabSlots from "./labSlots/LabSlots";
import CourseOfferings from "./courseOffering/CourseOfferings";
import UpcomingEvents from "./upcomingEvents/UpcomingEvents";
import PreviousEvents from "./previousEvents/PreviousEvents";
import Achievements from "./achivements/Achievements";
import "./Content.css";

interface ContentProps {
  selectedOption: string;
}

const Content: FunctionComponent<ContentProps> = ({ selectedOption }) => {
  const getContentComponent = () => {
    switch (selectedOption) {
      case "Lab Slots":
        return <LabSlots />;
      case "Course Offerings":
        return <CourseOfferings />;
      case "Upcoming Events":
        return <UpcomingEvents />;
      case "Previous Events":
        return <PreviousEvents />;
      case "Achievements":
        return <Achievements />;
      default:
        return <div>Content not found.</div>;
    }
  };

  return (
    <div className="content">
      <div className="content-card">{getContentComponent()}</div>
    </div>
  );
};

export default Content;
