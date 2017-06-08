// Search.js 
// Executes the search form the airports list.
import React from 'react';
import AutoCompleteInput from './Autocomplete.js';  // Component for the autocomplete feature
import {calculateHaversine} from './Calculate.js';  // Function to calculate the distance in nautical miles

// Load the US airports list
const airports = require('./data.json');
 
var SearchForm =  React.createClass({
   
  getInitialState: function() {
       return {
                to:{},
                from:{},
                distance: null,
                error:false,
              };
  },

  handleChange: function(val){
    
    this.setState(val);
  
  },

  handleSubmit : function(e){
    
    e.preventDefault();
   
    var error = this.validate();
    
    this.setState( { error : error },
        function(){ 
          this.calculateDistance();
        }
    );
  
  },
  calculateDistance : function(){
      

    if( !this.state.error.status){
    
      var distance = calculateHaversine(this.state);
     
      this.setState({
        distance : distance
      }, function(){
        
        var result = {to:this.state.to,
               from:this.state.from,
               distance: distance
              };
        this.props.mapListener(result);
     
      });

    }
  },

  validate : function(){
    
    if( !this.state.to|| !this.state.from || Object.keys(this.state.to).length === 0 ||  Object.keys(this.state.from).length===0 ){
      return {status:true,message:'Please fill out the form'};
    }else if( this.state.to === this.state.from ){
      return {status:true,message:'From & To airports are the same.'};
    }else{
      return {status:false,message:''};
    }

  },
  
  render() {
      return (
        <div >
          <div className="col-md-2 col-xs-12 ">
            <h1><a href="/" title="#A2">#A2</a></h1>
          </div>  
         
          <div className="col-md-10 col-xs-12">
            <form className="form-inline " onSubmit={this.handleSubmit} >
                <div className="col-xs-12 col-md-5 text-center add-pad">
                   
                  <AutoCompleteInput listenChange={this.handleChange} 
                                    autofocus={true}
                                    options={airports} 
                                    ref="from" 
                                    name="from"
                                    placeholder="From"
                                    value="" />

                </div>
                <div className="col-xs-12 col-md-5 text-center add-pad">
                  
                  <AutoCompleteInput listenChange={this.handleChange} 
                                    options={airports} 
                                    autofocus={false}
                                    ref="to"
                                    name="to"
                                    placeholder="To" 
                                    value="" />
             
                </div>
                <div className="message col-xs-12 col-md-2 text-center add-pad">
                  <input type="submit" className="btn btn-primary" value="Calculate" />
                </div>
             </form>
          </div>
          {(() => {
            if(this.state.error.status){
                return <div className="message col-xs-12 error text-center">{this.state.error.message}</div>;
              }
          
          
          })()}
        </div>
      );
  }
});

export default SearchForm;