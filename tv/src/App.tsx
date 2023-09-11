import { useState } from 'react'
import Header from './components/Header'
import Sidebar from './components/SideBar'
import Content from './components/Content'
import bg from './assets/PublicDisplayBackground.png'


function App() {
  const [count, setCount] = useState(0)
  const appStyle = {
    backgroundImage: `url(${bg})`, // Set the background image
    backgroundSize: 'cover', 
    backgroundRepeat: 'no-repeat', // Prevent repeating of the image
  };

  return (

      <div className="App" style={appStyle}>
        <Header/>
        <Sidebar/>
        <Content selectedOption='Lab Slots'/>


      </div>
     

  )
}

export default App
