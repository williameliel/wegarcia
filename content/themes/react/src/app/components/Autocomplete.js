// Autocomplete.js executes auto-completion on passed list.
// uses react-select for autocomplete field functionality
import React from 'react';
import Select from 'react-select';

var AutoCompleteInput = React.createClass({
  displayName: 'AirportsField',
  propTypes: {
    label: React.PropTypes.string,
    searchable: React.PropTypes.bool,
    listenChange: React.PropTypes.func,
    autofocus : React.PropTypes.bool,
  },
  getDefaultProps () {
    return {
      label: 'Airports:',
      searchable: true,
    };
  },
  getInitialState () {
     return {
      disabled: false,
      searchable: this.props.searchable,
      clearable: true,
      placeholder: this.props.placeholder,
      autofocus : this.props.autofocus,
      airportsFlattened : this.props.options.map((airport,key ) => {

        return {
            label : airport.name + ' ' +airport.iata,
            value : key 
        };
      })
    };
  },
  updateValue (newValue) {

    var valueChange = {};
    var key = this.props.name;
    var result = {};

    valueChange[key] = newValue;

    this.setState({
      selectValue: newValue
    });

    result[this.props.name] = this.props.options[newValue];
    // pass the selected object back to he parent component
    this.props.listenChange(result);
   
  },
  render () {
    return (
        <Select ref="airportSelect" 
                options={this.state.airportsFlattened} 
                simpleValue 
                autofocus={this.state.autofocus}
                placeholder={this.state.placeholder}
                clearable={this.state.clearable} 
                name={this.props.name}
                disabled={this.state.disabled} 
                value={this.state.selectValue} 
                onChange={this.updateValue}  />
     
    );
  }
});


module.exports = AutoCompleteInput;
