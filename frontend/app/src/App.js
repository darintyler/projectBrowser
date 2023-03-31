import {useState, useEffect, useRef} from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.css';
import ProjectDetailsModal from './ProjectDetailsModal.jsx';

const App = ({DEBUG, BACKEND_API_URL}) => {

  const[styleDisplayProjectDetails, setStyleDisplayProjectDetails] = useState('none');
  const[projects, setProjects] = useState([1,2,3]);
  const[projectDetails, setProjectDetails] = useState({});

  const fetchProjects = async () => {
    if(DEBUG) console.log('called fetchProjects()...');

    try {
      const response = await fetch(`${BACKEND_API_URL}projects`);
      const data = await response.json();
      if(DEBUG) {
        console.log('fetchProjects: data == '); console.log(data);
      }

      if(Array.isArray(data)) {
        if(DEBUG) console.log('fetchProjects: result is an array');

        return data;
      } else {
        throw new Error('Fetched data is invalid');
      }
    } catch(e) {
      if(DEBUG) console.log( 'error == ' + JSON.stringify(e) );

      return [];
    }
  }
  const doReload = async () => {
    if(DEBUG) console.log('called doReload()...');

    try {
      const response = await fetch(`${BACKEND_API_URL}reload`);
      const data = await response.json();
      if(DEBUG) {
        console.log('doReload: data == '); console.log(data);
      }

      if(
        typeof data === 'boolean'
        && data === true
      ) {
        window.location.reload();
      } else {
        throw new Error('Reload failed');
      }
    } catch(e) {
      if(DEBUG) console.log( 'error == ' + JSON.stringify(e) );

      return [];
    }
  }

  useEffect( 
    () => {
      let fetchData = async () => {
        setProjects(await fetchProjects());
        if(DEBUG) {
          console.log('useEffect: projects == '); console.log(projects);
        }
      };
      fetchData();
    }
    , []
  );

  // -------------------------------------

  return (
    <div className="App">
      <div style={{}}>
        <h1>GitHub Repository Browser</h1>
        <table className="phpProjectsTable table table-striped table-secondary table-hover">
          <thead className="table-light">
            <tr>
              <th>Repository Id</th>
              <th>Name</th>
              <th>Number of Stars</th>
            </tr>
          </thead>
          <tbody>
            {
              projects.map(
                (item, index, arr) => {
                  return (
                    <tr 
                      key={Math.random()}
                      onClick={
                        (e) => {
                          setProjectDetails(item);
                          setStyleDisplayProjectDetails('block');
                        }
                      }
                      title="Click to view details"
                    >
                      <td>{item.repositoryId}</td>
                      <td>{item.name}</td>
                      <td>{Number(item.numberOfStars).toLocaleString()}</td>
                    </tr>
                  )
                }
              )
            }
          </tbody>
        </table>
      </div>
      <ProjectDetailsModal
        styleDisplayProjectDetails={styleDisplayProjectDetails}
        setStyleDisplayProjectDetails={setStyleDisplayProjectDetails}
        projectDetails={projectDetails}
      />
      <div 
        style={{
          position:'absolute'
          , top:'0.8em'
          , right:'0.8em'
        }}
      >
        <img 
          src="reload.png" 
          style={{width:'34px', cursor:'pointer'}}
          onClick={
            () => {
              doReload();
            }
          }
          alt="Get fresh data from GitHub"
          title="Get fresh data from GitHub"
        />
      </div>
    </div>
  )
}

export default App;
