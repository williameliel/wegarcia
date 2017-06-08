import React from 'react'
import { Route, IndexRoute, onEnter } from 'react-router'
import App from './App'
import {fetchData} from './Fetch'
// import About from './About'
// import Repos from './Repos'
// import Repo from './Repo'
import Home from './Home'

function loadData() {
  console.log('load')
  var posts = fetchData('wp-json/wp/v2/posts');
  this.setState({ posts });
};

export default React.createClass({
  render() {
    <Route path="/" component={App}   >
      <IndexRoute component={Home} onEnter={loadData} />
    </Route>
  }
})


