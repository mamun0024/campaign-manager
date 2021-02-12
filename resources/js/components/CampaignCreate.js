import React, {Component} from 'react';
import ReactDOM from "react-dom";
import axios from "axios";

class CampaignCreate extends Component {
    constructor(props)
    {
        super(props);
        this.state = {
            noOfFiles: 1,
            formdata: {},
            errors: {},
            errorMessage: null
        }
    }

    createCampaign = (event) => {
        event.preventDefault()
        let errors = {}
        let errorMessage = null
        this.setState({
            errors,
            errorMessage
        })

        const formData = new FormData();
        for (let key in this.state.formdata) {
            formData.append(key, this.state.formdata[key])
        }

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }

        axios.post('/api/v1/campaign/create', formData, config)
            .then(res => {
                window.location = '/'
            })
            .catch(err => {
                let errors = err.response.data.errors
                let errorMessage = err.response.data.message
                this.setState({
                    errors,
                    errorMessage
                })
            })
    }

    handleChange = (event) => {
        let formdata = {...this.state.formdata}
        if (event.target.type === 'file') {
            formdata[event.target.name] = event.target.files[0]
        } else {
            formdata[event.target.name] = event.target.value
        }
        this.setState({
            formdata
        })
    }

    addMoreFileInput = () => {
        this.setState({
            noOfFiles: this.state.noOfFiles + 1
        })
    }

    render() {
        return (
            <div>
                <div className="row">
                    <div className="col-md-12">
                        {this.state.errorMessage &&
                        <div className="alert alert-danger">
                            <h6>{this.state.errorMessage}</h6>
                        </div>}
                    </div>
                </div>
                <form onSubmit={this.createCampaign}>
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" name="name" onChange={this.handleChange} className="form-control" required/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="exampleInputEmail1">From Date</label>
                        <input type="date" name="from_date" onChange={this.handleChange} className="form-control"
                               required/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="exampleInputEmail1">To Date</label>
                        <input type="date" name="to_date" onChange={this.handleChange} className="form-control"
                               required/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="exampleInputEmail1">Total Budget</label>
                        <input type="number" name="total_budget" onChange={this.handleChange} className="form-control"
                               required/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="exampleInputEmail1">Daily Budget</label>
                        <input type="number" name="daily_budget" onChange={this.handleChange} className="form-control"
                               required/>
                    </div>
                    <div className="form-group">
                        <label className="d-block" htmlFor="exampleInputEmail1">Creatives
                            <button type="button" className="btn btn-sm btn-outline-dark rounded-0 float-right"
                                    onClick={this.addMoreFileInput}>Add More File</button>
                        </label>
                        {[...Array(this.state.noOfFiles)].map((val, key) =><div className="row mb-3">
                            <div className="col-12" key={'file_input_'+key}>
                                <input type="file" name={'creatives['+key+']'} onChange={this.handleChange}
                                       className="form-control"
                                       required/>
                            </div>
                        </div>)}
                    </div>
                    <button type="submit" className="btn btn-dark rounded-0 mt-2">Submit</button>
                </form>
            </div>
        );
    }
}

export default CampaignCreate;

if (document.getElementById('create-campaign')) {
    ReactDOM.render(<CampaignCreate/>, document.getElementById('create-campaign'));
}
