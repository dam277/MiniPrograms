import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
// Inject Tailwind CDN
const tailwindScript = document.createElement('script');
tailwindScript.src = 'https://cdn.tailwindcss.com';
tailwindScript.defer = true;
document.head.appendChild(tailwindScript);

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
