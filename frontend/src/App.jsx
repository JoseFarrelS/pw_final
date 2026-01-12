import { BrowserRouter, Routes, Route, NavLink } from "react-router-dom";
import Predict from "./pages/Predict";
import History from "./pages/History";
import Statistics from "./pages/Statistics";

export default function App() {
  return (
    <BrowserRouter>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="container">
          <span className="navbar-brand">Waste Classification</span>
          <div className="navbar-nav">
            <NavLink className="nav-link" to="/">Predict</NavLink>
            <NavLink className="nav-link" to="/history">History</NavLink>
            <NavLink className="nav-link" to="/stats">Statistics</NavLink>
          </div>
        </div>
      </nav>

      <div className="container mt-4">
        <Routes>
          <Route path="/" element={<Predict />} />
          <Route path="/history" element={<History />} />
          <Route path="/stats" element={<Statistics />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}
