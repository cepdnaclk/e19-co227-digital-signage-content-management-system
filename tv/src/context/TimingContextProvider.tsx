import axios from "axios";
import React, { useEffect } from "react";
import TimingContext from "./TimingContext";

export function TimingProvider({ children }) {
  const [timings, setTimings] = React.useState({});
  const [imageIndex, setImageIndex] = React.useState({});
  const [loading, setLoading] = React.useState(true);

  useEffect(() => {
    axios
      .get(`/backend/api/dashboard/get.php`)
      .then((res) => {
        setTimings(res.data.features);
        setLoading(false);
      })
      .catch((err) => {
        console.log(err);
        setLoading(false);
      });
  }, [imageIndex]);

  const value = {
    timings,
    setTimings,
    imageIndex,
    setImageIndex,
  };

  if (loading) {
    return <div>Loading...</div>; // or your own loading component
  }

  return (
    <TimingContext.Provider value={value}>{children}</TimingContext.Provider>
  );
}
