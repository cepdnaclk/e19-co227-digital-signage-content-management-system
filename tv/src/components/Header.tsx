
import './header.css'; 

function Header() {
  return (
    <header className="header"> {/* Use the 'header' class */}
      <div className="university-info">
        <img src="../assets/UOPLogo.svg" alt="University Logo" className="logo" />
        University of Peradeniya
      </div>
      <div className="it-center-logo">
        <img src="../assets/ITCenterLogo.svg" alt="ITCenter Logo" className="logo" />
      </div>
    </header>
  );
}

export default Header;
