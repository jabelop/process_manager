import React, { useEffect, useState} from "react";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import axios from "axios";
import { Container } from "react-bootstrap";

import { v4 as uuid } from 'uuid';

export function CreateProcessPage() {
 

    const [data, setData] = useState([]);
    useEffect(async () => {
        const result = await axios.get('http://localhost/api/process_type');
        console.log(result);
        setData(result.data);
    }, []);

    const [input, setInput] = useState("");
  
    const handleSubmit = (evt) => {
        evt.preventDefault();
        alert(`Submitting input ${input} - type ${type}`)
    };

    const [type, setType] = useState("");

    const id = uuid();
    const handleClickSave = async (evt) => {
        const bodyRequest = {id, type, input};
            console.log("body request");
            console.log(bodyRequest);
            const result = await axios.post(`http://localhost/api/process`, bodyRequest); 
    };

    const handleClickSaveAndStart = async (e) => {
        await handleClickSave(e);
        const result = await axios.post(`http://localhost/api/process/${id}/start`);
    };

    return (
        <Container>
            <Form>
            <Form.Group className="mb-3" controlId="formBasicEmail">
                <Form.Label>Process Type</Form.Label>
                <Form.Control as="select" className="rounded-0 shadow" selected={type} onChange={e => setType(e.target.value)}>
                    <option className="d-none" value="">Select Option</option>
                    {data?.map(processType => 
                        <option key={processType.type}>{processType.type}</option>
                    )}
                </Form.Control>
            </Form.Group>
            <Form.Group className="mb-3" controlId="formBasicPassword">
                <Form.Label>Input</Form.Label>
                <Form.Control type="textarea" placeholder="Input" value={input} onChange={e => setInput(e.target.value)}/>
            </Form.Group>
            <Button variant="primary" type="button" onClick={e => handleClickSave(e)}>
                Save
            </Button>
            <Button variant="primary" type="button" onClick={e => handleClickSaveAndStart(e)}>
                Save and start
            </Button>
            </Form>
        </Container>
    );
}