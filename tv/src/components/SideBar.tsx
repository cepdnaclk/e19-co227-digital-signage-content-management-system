// SideBar.tsx

import React, { useState } from 'react';
import './sidebar.css';
import logo_a from '../assets/logo_a.svg';
import logo_b from '../assets/logo_b.svg';

function Sidebar({ selectedOption, setSelectedOption }) {
  const [hoveredOption, setHoveredOption] = useState('');

  // Define your options and their corresponding logos
  const options = [
    { label: 'Lab Slots', logo: hoveredOption === 'Lab Slots' ? logo_b : logo_a },
    { label: 'Course Offerings', logo: hoveredOption === 'Course Offerings' ? logo_b : logo_a },
    { label: 'Upcoming Events', logo: hoveredOption === 'Upcoming Events' ? logo_b : logo_a },
    { label: 'Previous Events', logo: hoveredOption === 'Previous Events' ? logo_b : logo_a },
    { label: 'Achievements', logo: hoveredOption === 'Achievements' ? logo_b : logo_a },
    // Add other options and logos here...
  ];

  return (
    <nav className="sidebar">
      <ul>
        {options.map((option) => (
          <li
            key={option.label}
            className={selectedOption === option.label ? 'selected' : ''}
            onMouseEnter={() => setHoveredOption(option.label)} // Change logo on hover
            onMouseLeave={() => setHoveredOption('')} // Reset logo when mouse leaves
            onClick={() => setSelectedOption(option.label)}
          >
            <img src={option.logo} alt={`${option.label} Logo`} />
            {option.label}
          </li>
        ))}
      </ul>
    </nav>
  );
}

export default Sidebar;
