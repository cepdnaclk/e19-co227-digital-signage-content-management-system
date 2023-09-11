import React from 'react';
import './header.css'; 
import uoplogo from '../assets/UOPLogo.svg';
import itclogo from '../assets/ITCenterLogo.svg';

function Header() {
  return (
    <header className="header">
      <div className="university-info">
        <img src={uoplogo} alt="University Logo" className="logo" />
        University of Peradeniya
      </div>
      <div className="it-center-logo">
        <img src={itclogo} alt="IT Center Logo" className="logo" />
      </div>
    </header>
  );
}

export default Header;