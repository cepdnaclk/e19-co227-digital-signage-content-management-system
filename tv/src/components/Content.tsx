import React, { FunctionComponent } from 'react';
import LabSlots from './LabSlots';
import CourseOfferings from './CourseOfferings';
import UpcomingEvents from './UpcomingEvents';
import PreviousEvents from './PreviousEvents';
import Achievements from './Achievements';
import './Content.css';

interface ContentProps {
  selectedOption: string;
}

const Content: FunctionComponent<ContentProps> = ({ selectedOption }) => {
  const getContentComponent = () => {
    switch (selectedOption) {
      case 'Lab Slots':
        return <LabSlots />;
      case 'Course Offerings':
        return <CourseOfferings />;
      case 'Upcoming Events':
        return <UpcomingEvents />;
      case 'Previous Events':
        return <PreviousEvents />;
      case 'Achievements':
        return <Achievements />;
      default:
        return <div>Content not found.</div>;
    }
  };

  return (
    <div className="content">
      {getContentComponent()}
    </div>
  );
};

export default Content;
