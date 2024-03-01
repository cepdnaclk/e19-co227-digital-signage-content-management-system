import React from "react";
import "./maps.css";
import qrCode from "/src/assets/qr_code.png";

export default function Maps() {
  return (
    <div className="more-info">
      <h3>For More info</h3>
      <img src={qrCode} alt="" />
      <p className="link">http://192.248.43.4/cms-guest-portal/</p>
      <p>CMS GUEST PORTAL</p>
    </div>
  );
}
