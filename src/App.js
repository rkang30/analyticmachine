import React from 'react';
import ReactDOM from 'react-dom';
import ClientLists from './ClientLists';
import $ from 'jquery';

class App extends React.Component{

	constructor(){
		super();
		this.state = {
			contacts: [],
			search: ''
		};
	}

	componentDidMount(){
		this.serverRequest = $.ajax({
			type: 'get',
			url: this.props.source,
			dataType: 'json',
			cache: false,
			success: function(result){
				this.setState({
					contacts: result
				});
			}.bind(this)
		});	
	}

	componentWillUnmount(){
		this.serverRequest.abort();
	}

	updateLists(event){
		this.setState({
			search: event.target.value
		});
	}

	render(){

		let filteredContacts = this.state.contacts.filter((contact) => {
			if(contact.name.toLowerCase().indexOf(this.state.search.toLowerCase()) !== -1){
				return true;
			}else{
				return false;
			}
		});

	    return (
	      <div>
	      	<input type="text" name="search" onChange={this.updateLists.bind(this)} value={this.state.search}/>
	      	<ClientLists contacts={filteredContacts} />
	      </div>
	    );
	}
}

ReactDOM.render(<App source="http://myreact.com/src/data.json"/>, document.getElementById('app'));