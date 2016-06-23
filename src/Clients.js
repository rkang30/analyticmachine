import React from 'react';
import ReactDOM from 'react-dom';
import ClientLists from './ClientLists';
import $ from 'jquery';

let sourcedata = window.location.href+'/data';

class Clients extends React.Component{

	constructor(){
		super();
		this.state = {
			contacts: [],
			category: '',
			search: '',
			header: '',
			marked: ''
		};
	}

	componentDidMount(){

		this.serverRequest = $.ajax({
			type: 'get',
			url: this.props.source,
			dataType: 'json',
			cache: false,
			success: function(result){
				
				var sortKey = '';
				$.each(result[0], function(i, v){
					if(i.indexOf('create') !== -1){
						sortKey = i;
						return false;
					}

					if(sortKey == ''){
						if((i.indexOf('date') !== -1) || (i.indexOf('dt') !== -1)){
							sortKey = i;
							return false;
						}
					}

					if(sortKey == ''){
						if((i.indexOf('id') !== -1) && (typeof i === "number")){
							sortKey = i;
							return false;
						}
					}

				});

				if(sortKey != ''){
					function SortByKey(a, b){
					  var aVal = a[sortKey];
					  var bVal = b[sortKey]; 
					  return ((aVal > bVal) ? -1 : ((aVal > bVal) ? 1 : 0));
					}

					var sortedResult = result.sort(SortByKey);

					this.setState({
						contacts: sortedResult
					});
				}else{
					this.setState({
						contacts: result
					});					
				}

			}.bind(this)
		});	

	}

	componentWillUnmount(){
		this.serverRequest.abort();
	}

	updateHeader(event){
		var cat = $("#category option:selected").val();
		
		this.setState({
			marked: event.target.value,
			category: cat,
			search: ''
		});
	}	

	updateLists(event){
		this.setState({
			search: event.target.value
		});
	}

	render(){

/*		let url = window.location.href;
		console.log(url);*/

		let filteredContacts = this.state.contacts.filter((contact) => {
			let cat = this.state.category;
			
			if(cat == ''){
				let num = 0;
				$.each(this.state.contacts[0], function(i, v){
					if(typeof contact[i] === "string"){
						cat = i;
						return false;
					}				 	
				});
			}

			if(contact[cat].toLowerCase().indexOf(this.state.search.toLowerCase()) !== -1){
				return true;
			}else{
				return false;
			}
		});

		let Contacts = this.state.contacts;
		let headers = [];
		$.each(Contacts, function(i, v){
			if(i == 0){
				var count = 1;
				$.each(v, function(k, l){
					
					if(k.indexOf('id') !== -1){
						return true;
					}
					var obj = {_id: count, header: k}
					headers.push(obj);
				  count++;	
				});
			}
		});

		let selected = this.state.marked;
		let disabled = '';
		if(selected == ''){
			disabled = 'disabled';
		}else{
			disabled = '';
		}

	    return (
	      <div>
	        <fieldset className="form-group">
		      	<select id="category" className="form-control" onChange={this.updateHeader.bind(this)}>
		      		<option value="">select one</option>
			      	{headers.map((obj)=>{
			      		return(<option key={obj._id} value={obj.header}>{obj.header}</option>)
			      	})}
		      	</select>
	      	</fieldset>
			<fieldset className="form-group">
			   <input type="text" className="form-control" name="search" id="search" onChange={this.updateLists.bind(this)} disabled={disabled} value={this.state.search} placeholder="Enter Your Search"/>
			</fieldset>
  
	      	<ClientLists contacts={filteredContacts} headers={headers}/>
	      </div>
	    );
	}
}

ReactDOM.render(<Clients source={sourcedata}/>, document.getElementById('app'));