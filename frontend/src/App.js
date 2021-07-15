import React from 'react';
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";
import { HomePage } from "./Components/HomePage";
import { Navbar, Nav, Container } from 'react-bootstrap';


import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
    <div>
      <Router>
        <Navbar bg="light" expand="lg">
          <Container>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
              <Nav className="me-auto">
                <Nav.Link href="/">Home</Nav.Link>
                <Nav.Link href="/create_process">Create Process</Nav.Link>
                
              </Nav>
            </Navbar.Collapse>
          </Container>
        </Navbar>
        <Switch>
          <Route exact path="/" component={HomePage} />
        </Switch>
      </Router>
    </div>
  );
}

export default App;