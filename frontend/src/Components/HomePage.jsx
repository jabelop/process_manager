import React from "react";
import { ProcessTable } from "./UIComponents/ProcessTable";
import axios from "axios";
import { Container } from "react-bootstrap";

export function HomePage() {
  return (
    <div>
      <h1>Proccesses</h1>
      <Container>
        <ProcessTable></ProcessTable>
      </Container>
     
    </div>
  );
}