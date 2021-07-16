import React from "react";
import { ProcessTable } from "./UIComponents/ProcessTable";
import axios from "axios";

export function HomePage() {
  return (
    <div>
      <h1>Proccesses</h1>
      <ProcessTable></ProcessTable>
    </div>
  );
}