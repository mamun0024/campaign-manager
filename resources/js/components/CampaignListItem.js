import React, {Component} from 'react';
import Modal from 'react-bootstrap/Modal';

class CampaignListItem extends Component {
    constructor(props)
    {
        super(props);
        this.state = {
            campaign: this.props.campaign,
            show: false,
        }
    }

    handleClose = () => this.setState({show: false})
    handleShow = () => {
        this.setState({
            show: true
        })
    }

    render()
    {
        return (
            <tr>
                <th scope="row">{this.state.campaign.id}</th>
                <td>{this.state.campaign.name}</td>
                <td>{this.state.campaign.from_date}</td>
                <td>{this.state.campaign.to_date}</td>
                <td>${this.state.campaign.daily_budget}</td>
                <td>${this.state.campaign.total_budget}</td>
                <td>
                    <a href="#"
                       onClick={this.handleShow}
                       className="btn btn-sm btn-outline-dark rounded-0 mr-2">Preview</a>
                    <a href={'/campaign/'+this.state.campaign.id+'/update'} className="btn btn-sm btn-outline-dark rounded-0 mr-2">Edit</a>
                </td>
                <Modal size="lg" show={this.state.show} onHide={this.handleClose}>
                    <Modal.Header closeButton>
                        <Modal.Title>{this.state.campaign.name}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <div className="row">
                            {this.state.campaign.creatives.map(creative =>
                                <div key={creative.file_name} className="col-md-4 mb-3">
                                    <img src={creative.file_path} className="img-fluid" alt={creative.file_name}/>
                                </div>
                            )}
                        </div>
                    </Modal.Body>
                    <Modal.Footer>
                        <button className="btn btn-secondary" onClick={this.handleClose}>
                            Close
                        </button>
                    </Modal.Footer>
                </Modal>
            </tr>
        );
    }
}

export default CampaignListItem;
