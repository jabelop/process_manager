import React, { useState, useEffect } from "react";
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import axios from "axios";

export function ProcessTable (props) {
  const handleClick = async (id) => {
    const result = await axios.post(`http://localhost/api/process/${id}/start`);
    
  };
  const [data, setData] = useState([]);
  useEffect(async () => {
    const result = await axios.get(
      'http://localhost/api/process');
    console.log(result);
    setData(result.data);
  }, []);
  return (
    <Table striped bordered hover>
        <thead>
            <tr>
            <th>Process Id</th>
            <th>Process Type</th>
            <th>Process Output</th>
            <th>Process Status</th>
            <th>Created At</th>
            <th>Started At</th>
            <th>Finished At</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {data?.map(process => 
            <tr>
            <td>{process.process_id}</td>
            <td>{process.type}</td>
            <td>{process.output}</td>
            <td>{process.status}</td>
            <td>{process.created_at}</td>
            <td>{process.started_at}</td>
            <td>{process.finished_at}</td>
            <td><Button onClick={() => handleClick(process.process_id)}>Start</Button></td>
            </tr>
            )}
        </tbody>
    </Table>
  );
}

  