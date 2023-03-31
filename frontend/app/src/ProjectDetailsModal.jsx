import React from 'react';

const ProjectDetailsModal = ({
    styleDisplayProjectDetails
    , setStyleDisplayProjectDetails
    , projectDetails
}) => {
    return (
        <div style={{display:styleDisplayProjectDetails}}>
            <div 
                className="overlayBackground" 
                style={{
                    zIndex:10
                    , position:'fixed'
                    , top:0
                    , left:0
                    , width:'100%'
                    , height:'100%'
                    , background:'white'
                    , opacity:0.8
                }}
            >
            </div>
            <div 
                className="overlayContentContainer d-flex min-vh-100 min-vw-100 justify-content-center" 
                style={{
                    zIndex:20
                    , position:'fixed'
                    , top:0
                    , left:0
                    , height:'1px'
                }}
            >
                <div className="d-flex flex-grow-0" style={{width:'8%'}}></div>
                <div className="d-flex flex-grow-1 my-3">
                    <div 
                        style={{
                            overflow:'auto'
                            , width:'100%'
                        }}
                    >
                        <div
                        className="p-3 border border-2 border-dark rounded-3" 
                            style={{
                                display:'block'
                                , background:'#ddd'
                                , width:'100%'
                            }}
                        >
                            <table 
                                className="table table-striped" 
                                style={{textAlign:'left'}}
                            ><tbody>
                                <tr>
                                    <th style={{width:'1px'}}>Repository Id</th>
                                    <td>{('repositoryId' in projectDetails) ? projectDetails.repositoryId : '(No data)'}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{('name' in projectDetails) ? projectDetails.name : '(No data)'}</td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td>{
                                        ('url' in projectDetails) 
                                        ? <a href={projectDetails.url} target="_blank">{projectDetails.url}</a>
                                        : '(No data)'
                                    }</td>
                                </tr>
                                <tr>
                                    <th>Date&nbsp;Created</th>
                                    <td>{('createdDate' in projectDetails) ? projectDetails.createdDate : '(No data)'}</td>
                                </tr>
                                <tr>
                                    <th>Date&nbsp;Last&nbsp;Pushed</th>
                                    <td>{('lastPushDate' in projectDetails) ? projectDetails.lastPushDate : '(No data)'}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{('description' in projectDetails) ? projectDetails.description : '(No data)'}</td>
                                </tr>
                                <tr>
                                    <th>Number of Stars</th>
                                    <td>{('numberOfStars' in projectDetails) ? Number(projectDetails.numberOfStars).toLocaleString() : '(No data)'}</td>
                                </tr>
                            </tbody></table>
                            <button
                                className="rounded-3"
                                onClick={
                                    (e) => {
                                        setStyleDisplayProjectDetails('none');
                                    }
                                }
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
                <div className="d-flex flex-grow-0" style={{width:'8%'}}></div>
            </div>
        </div>
    )
}

export default ProjectDetailsModal;