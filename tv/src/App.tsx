// App.tsx
import React, { useState } from "react";
import Header from "./components/Header";
import Sidebar from "./components/SideBar";
import Content from "./components/Content";
import "./app.css";

import { createBrowserRouter, RouterProvider } from "react-router-dom";
import LabSlots from "./components/labSlots/LabSlots";
import CourseOfferings from "./components/courseOffering/CourseOfferings";
import UpcomingEvents from "./components/upcomingEvents/UpcomingEvents";
import PreviousEvents from "./components/previousEvents/PreviousEvents";
import Achievements from "./components/achivements/Achievements";
import { redirect } from "../node_modules/react-router-dom/dist/index";

const Root = () => {
  return (
    <div className="App">
      <Header />
      <div className="container">
        <Sidebar />
        <Content />
      </div>
    </div>
  );
};

const router = createBrowserRouter([
  {
    path: "/",
    element: <Root />,
    children: [
      {
        path: "/",
        loader: () => {
          return redirect("/labslots/all");
        },
      },
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
    ],
  },
]);

function App() {
  return <RouterProvider router={router} />;
}

export default App;
