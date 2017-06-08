import React from 'react';
import { render } from 'react-dom';
import { Router, Route, IndexRoute, Link, IndexLink, browserHistory } from 'react-router';
import axios from 'axios';
import routes from './modules/routes';

//import './styles/main.scss';

render(
  <Router routes={routes} history={browserHistory}/>,
  document.getElementById('root')
) 


// class FetchDemo extends React.Component {
//   constructor(props) {
//     super(props);

//     this.state = {
//       posts: []
//     };
//   }

//   componentDidMount() {
//     axios.get('/wp-json/wp/v2/posts')
//       .then(res => {
//          console.log(res)
//         const posts = res.data.map(obj => obj );
//         this.setState({ posts });
//       });

      
//   }

//   render() {
//     return (
//       <div>
//           {this.state.posts.map(post =>
//             <article key={post.id} id={post.id}> 
//               <a href={post.link}>
//                 <h1 dangerouslySetInnerHTML={{__html: post.title.rendered}} />
//               </a>
//               <div dangerouslySetInnerHTML={{__html: post.content.rendered}} />
//             </article>
//           )}   
//       </div>
//     );
//   }
// }

// ReactDOM.render(
//   <FetchDemo/>,
//   document.getElementById('root')
// );