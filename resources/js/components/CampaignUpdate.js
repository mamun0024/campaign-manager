import React, {Component} from 'react';
import ReactDOM from "react-dom";
import axios from "axios";

class CampaignUpdate extends Component {
    constructor(props)
    {
        super(props);
        this.state = {
            campaignId: this.props.campaignId,
            campaign: null,
            noOfFiles: 1,
            formdata: {},
            errors: {},
            errorMessage: null
        }
    }

    componentDidMount()
    {
        axios.get('/api/v1/campaign/' + this.state.campaignId)
            .then(res => {
                let campaign = res.data.data

                let formdata = {}
                formdata['name'] = campaign['name']
                formdata['from_date'] = campaign['from_date']
                formdata['to_date'] = campaign['to_date']
                formdata['total_budget'] = campaign['total_budget']
                formdata['daily_budget'] = campaign['daily_budget']
                formdata['creatives'] = campaign['creatives']

                this.setState({
                    campaign,
                    formdata
                })
            })
            .catch(err => {
                window.location = '/'
            })
    }

    updateCampaign = (event) => {
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

        axios.post('/api/v1/campaign/' + this.state.campaignId + '/update', formData, config)
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

    deleteCampaignCreative(CampaignCreativeId)
    {
        axios.delete('/api/v1/campaign/creative/' + CampaignCreativeId + '/delete')
            .then(res => {
                const display = document.getElementById('campaign_creative_img_' + CampaignCreativeId);
                display.style.display = "none";
            })
            .catch(err => {
                let errorMessage = err.response.data.details
                this.setState({
                    errorMessage
                })
            })
    }

    render() {
        return (
            <form onSubmit={this.updateCampaign}>
                <div className="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value={this.state.campaign ? this.state.formdata.name : ''}
                           onChange={this.handleChange} className="form-control" required/>
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">From Date</label>
                    <input type="date" name="from_date"
                           value={this.state.campaign ? this.state.formdata.from_date : ''}
                           onChange={this.handleChange} className="form-control" required/>
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">To Date</label>
                    <input type="date" name="to_date" value={this.state.campaign ? this.state.formdata.to_date : ''}
                           onChange={this.handleChange} className="form-control" required/>
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">Total Budget</label>
                    <input type="number" name="total_budget"
                           value={this.state.campaign ? this.state.formdata.total_budget : ''}
                           onChange={this.handleChange} className="form-control" required/>
                </div>
                <div className="form-group">
                    <label htmlFor="exampleInputEmail1">Daily Budget</label>
                    <input type="number" name="daily_budget"
                           value={this.state.campaign ? this.state.formdata.daily_budget : ''}
                           onChange={this.handleChange} className="form-control" required/>
                </div>
                <div className="form-group">
                    <label className="d-block" htmlFor="exampleInputEmail1">Creatives
                        <button type="button" className="btn btn-sm btn-outline-dark rounded-0 float-right"
                                onClick={this.addMoreFileInput}>Add More File</button>
                    </label>
                    {[...Array(this.state.noOfFiles)].map((val, key) => <div className="row mb-3">
                        <div className="col-12" key={'file_input_' + key}>
                            <input type="file" name={'creatives[' + key + ']'} onChange={this.handleChange}
                                   className="form-control"
                            />
                        </div>
                    </div>)}

                    <div>
                        {this.state.campaign ? (
                            <div className="row">
                                {this.state.formdata.creatives.map(creative =>
                                    <div key={creative.file_name} className="col-md-4 mb-3" id={'campaign_creative_img_' + creative.id}>
                                        <img src={creative.file_path} className="img-fluid" alt={creative.file_name}/>
                                        <button type="button" className="btn btn-sm btn-outline-dark rounded-0 float-right"
                                                onClick={() => this.deleteCampaignCreative(creative.id)}>Delete</button>
                                    </div>
                                )}
                            </div>
                        ) : (
                            <div className="row"></div>
                        )}
                    </div>

                </div>
                <button type="submit" className="btn btn-dark rounded-0 mt-2">Update</button>
            </form>
        );
    }
}

export default CampaignUpdate;

if (document.getElementById('update-campaign')) {
    let editDom = document.getElementById('update-campaign');
    ReactDOM.render(<CampaignUpdate campaignId={editDom.dataset.campaign_id}/>, editDom);
}
