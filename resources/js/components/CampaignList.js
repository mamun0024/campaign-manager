import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios'
import CampaignListItem from "./CampaignListItem";

class CampaignList extends Component {
    constructor()
    {
        super();
        this.state = {
            campaigns: [],
            selectedCampaign: null
        }
    }

    componentDidMount()
    {
        this.getCampaigns()
    }

    getCampaigns()
    {
        let url = '/api/v1/campaigns'
        axios.get(url)
            .then(res => {
                let campaigns = res.data.data
                this.setState({
                    campaigns
                })
            })
            .catch(err => {
                console.log(err)
            })
    }

    render()
    {
        return (
            <div className="row">
                <div className="col-md-12">
                    <div className="table-responsive">
                        <table className="table table-striped table-hover">
                            <thead>
                            <tr className="bg-dark text-white">
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">From Date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Daily Budget</th>
                                <th scope="col">Total Budget</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                this.state.campaigns.map(campaign =>
                                    <CampaignListItem key={campaign.id} campaign={campaign}></CampaignListItem>
                                )
                            }
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        );
    }
}

export default CampaignList;

if (document.getElementById('campaign-list')) {
    ReactDOM.render(<CampaignList />, document.getElementById('campaign-list'));
}
