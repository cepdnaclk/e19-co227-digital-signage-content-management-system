import React, { useState } from 'react';
import './sidebar.css'; 

function Sidebar() {
  const [selectedOption, setSelectedOption] = useState('Lab Slots');

  return (
    <nav className="sidebar"> {}
      <ul>
        <li onClick={() => setSelectedOption('Lab Slots')}>Lab Slots</li>
        <li onClick={() => setSelectedOption('Course Offerings')}>Course Offerings</li>
        <li onClick={() => setSelectedOption('Upcoming Events')}>Upcoming Events</li>
        <li onClick={() => setSelectedOption('Previous Events')}>Previous Events</li>
        <li onClick={() => setSelectedOption('Achievements')}>Achievements</li>
      </ul>
    </nav>
  );
}

export default Sidebar;
