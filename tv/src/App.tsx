// App.tsx
import "./app.css";
import Content from "./components/Content";
import Header from "./components/Header";
import Sidebar from "./components/SideBar";

import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { redirect } from "../node_modules/react-router-dom/dist/index";
import Achievements from "./components/achivements/Achievements";
import CourseOfferings from "./components/courseOffering/CourseOfferings";
import LabSlots from "./components/labSlots/LabSlots";
import Maps from "./components/maps/Maps";
import PreviousEvents from "./components/previousEvents/PreviousEvents";
import UpcomingEvents from "./components/upcomingEvents/UpcomingEvents";
import { TimingProvider } from "./context/TimingContextProvider";

const Root = () => {
  return (
    <TimingProvider>
      <div className="App">
        <Header />
        <div className="container">
          <Sidebar />
          <Content />
        </div>
      </div>
    </TimingProvider>
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
      {
        path: "/maps",
        element: <Maps />,
      },
    ],
  },
]);

function App() {
  return <RouterProvider router={router} />;
}

export default App;
