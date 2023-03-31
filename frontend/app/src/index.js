import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';

const DEBUG = false;
//const BACKEND_API_URL = 'http://localhost:80/projectBrowser/api/v1/'; // DEVELOPMENT
const BACKEND_API_URL = 'http://darintyler.com/portfolio/projectBrowser/api/v1/'; // PRODUCTION

const root = ReactDOM.createRoot(document.getElementById('root'));

root.render(
  <React.StrictMode>
    <App 
      DEBUG={DEBUG}
      BACKEND_API_URL={BACKEND_API_URL}
    />
  </React.StrictMode>
);