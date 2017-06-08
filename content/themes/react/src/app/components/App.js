// App.js load google maps API from window
// Create markers and flight path
import React from 'react';
import SearchForm from './Search.js'

const google = window.google; /* Use the google API instance attached to the window */

const USA = { lat: 39.4522061, lng: -103.1603733 }; /* Central USA */

var App =  React.createClass({
   
  getInitialState: function () {
      
      return {result:{},
              markers: {}, 
              flightpath: null 
             };
  },
  componentDidMount :  function(){
    
    this.map = new google.maps.Map(this.refs.map, {
      center: USA,
      zoom: 4,
    });
  
  },
  handleSearchResults : function(result){
    
    if(this.state.markers ){
      
      this.clearMarkers();
  
      this.clearFlightPath();

      this.setState({result : result },function(){
           if(!result.error){
            this.setMarker();
          }
      });
   }
  },
  setMarker: function(){

    var markersResult = [
      this.state.result.from,
      this.state.result.to
    ];
    
    var markers = [] ;
    var infowindows = [];

    for(let i=0; i < markersResult.length; i++){
        
        infowindows[i] = new google.maps.InfoWindow({
          content: '<p>' + markersResult[i].name + '<p>'
        });
       
        markers[i] = new google.maps.Marker({
          position: {lat: parseFloat(markersResult[i].latitude), 
                     lng: parseFloat(markersResult[i].longitude)}
        });
      
        markers[i].setMap(this.map);

        markers[i].addListener('click', function() {
          infowindows[i].open(this.map, markers[i]);
        });
      }
     
      this.setState({markers : markers},function(){

        if( this.state.markers ){

          this.fitBoundsToVisibleMarkers();
          this.flightPath();
        }
      });
  },
  clearMarkers: function(){
    
    for(let i=0; i < this.state.markers.length; i++){
      
        
        this.state.markers[i].setMap(null);

    }
    this.setState({markers : null })
  
  },
  fitBoundsToVisibleMarkers: function() {
    
    
    var bounds = new google.maps.LatLngBounds();

    for (var i=0; i<this.state.markers.length; i++) {
        if(this.state.markers[i].getVisible()) {
            bounds.extend( this.state.markers[i].getPosition() );
        }
    }

    this.map.fitBounds(bounds);

  },
  flightPath: function(){
      
    var flightPlanCoordinates = [
        {lat:  parseFloat(this.state.result.from.latitude), lng: parseFloat(this.state.result.from.longitude)},
        {lat: parseFloat(this.state.result.to.latitude), lng: parseFloat(this.state.result.to.longitude)},
      ];

    var distancetxt = this.state.result.distance + ' nmi';

    var flightpath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        strokeOpacity: 0,
        geodesic : true,
        strokeColor: '#FF0000',
        text :  distancetxt ,
        icons: [{
          icon: {
              path: 'M 0,-1 0,1',
              strokeOpacity: 1,
              scale: 4
            },
          offset: '0',
          repeat: '20px'
        }],
      });

     flightpath.setMap(this.map);
    
    this.setState({
      flightpath : flightpath
    });
  },
  clearFlightPath: function() {

      if( !this.state.flightpath) return;
      
      this.state.flightpath.setMap(null);
  },

  render() {
    const mapStyle = {
      width: '100vw',
      height: '100vh',
    };
    
    return (
      <div>
         <div className="search-bar container">

         <SearchForm mapListener={this.handleSearchResults} />
        
         {(() => {
              if(this.state.result.distance){
          
                return <div className="results col-xs-12 text-center">
                The distance between {this.state.result.from.name} and {this.state.result.to.name} is <br />
                <strong>{this.state.result.distance} nmi.</strong>
                </div>;
              }else if(this.state.result.error){
                return <div className="col-xs-12 error text-center">An error has occured.</div>;
              }
          
          
          })()}
          </div>
          <div ref="map"  style={mapStyle}>I should be a map!</div>
        
      </div>
    );
  }
});

export default App;
