import React , { useState, useEffect }from "react";
import { ProcessTable } from "./UIComponents/ProcessTable";
import axios from "axios";

export function HomePage() {
  const [data, setData] = useState({ hits: [] });
  useEffect(async () => {
    const result = await axios.get(
      'http://localhost/api/process');
 
    setData(result.data);
  });
  return (
    <div>
      <h1>Home Page!</h1>
      <ProcessTable processes={data.hits}></ProcessTable>
    </div>
  );
}