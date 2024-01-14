import axios from "axios";
import React, { useEffect } from "react";
import TimingContext from "./TimingContext";

export function TimingProvider({ children }) {
  const [timings, setTimings] = React.useState({});
  const [imageIndex, setImageIndex] = React.useState({});

  useEffect(() => {
    axios
      .get(`/backend/api/dashboard/get.php`)
      .then((res) => {
        setTimings(res.data.features);
      })
      .catch((err) => {
        console.log(err);
      });
  }, [imageIndex]);

  const value = {
    timings,
    setTimings,
    imageIndex,
    setImageIndex,
  };

  return (
    <TimingContext.Provider value={value}>{children}</TimingContext.Provider>
  );
}
