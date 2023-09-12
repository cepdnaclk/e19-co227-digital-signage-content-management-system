// App.tsx
import Header from './components/Header'
import Sidebar from './components/SideBar'
import Content from './components/Content'
import './app.css'


function App() {
 
  return (
      <div className="App">
        <Header/>
        <div className="container">
          <Sidebar/>
          <Content selectedOption='Lab Slots'/>
        </div>
      </div>
  )
}

export default App
    