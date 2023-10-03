// Content.tsx
import React, { FunctionComponent } from "react";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import LabSlots from "./labSlots/LabSlots";
import CourseOfferings from "./courseOffering/CourseOfferings";
import UpcomingEvents from "./upcomingEvents/UpcomingEvents";
import PreviousEvents from "./previousEvents/PreviousEvents";
import Achievements from "./achivements/Achievements";
import "./content.css";

const router = createBrowserRouter([
  {
    path: "/labslots/:lab",
    element: <LabSlots />,
  },
  {
    path: "/courses",
    element: <CourseOfferings />,
  },
  {
    path: "/upcoming",
    element: <UpcomingEvents />,
  },
  {
    path: "/previous",
    element: <PreviousEvents />,
  },
  {
    path: "/achivements",
    element: <Achievements />,
  },
]);

const Content = () => {
  return (
    <div className="content">
      <RouterProvider router={router} />
    </div>
  );
};

export default Content;
