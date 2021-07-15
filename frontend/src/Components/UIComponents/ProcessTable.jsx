import React from "react";
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import axios from "axios";

export class ProcessTable extends React.Component {
    render() {
      return (
        <Table striped bordered hover>
            <thead>
                <tr>
                <th>Process Id</th>
                <th>Process Type</th>
                <th>Process Result</th>
                <th>Process Status</th>
                <th>Created At</th>
                <th>Started At</th>
                <th>Finished At</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {this.props.processes.map(process => 
                <tr>
                <td>{process.id}</td>
                <td>{process.type}</td>
                <td>{process.result}</td>
                <td>{process.status}</td>
                <td>{process.created_at}</td>
                <td>{process.started_at}</td>
                <td>{process.finished_at}</td>
                <td><Button onClick={() => this.handleClick(process.id)}>Start</Button></td>
                </tr>
                )}
            </tbody>
        </Table>
      );
    }
    async handleClick(id) {
      const result = axios.post(`http://localhost/api/process/${id}/start`);
      
    }
  }

  