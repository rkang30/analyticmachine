import React from 'react';
import ReactDOM from 'react-dom';
import Charts from './Charts';
import $ from 'jquery';

class ClientLists extends React.Component{

	render(){

		return (
			<div>
				<Charts contacts={this.props.contacts} headers={this.props.headers}/>
				<table width="100%">
				<thead>
					<tr className="head-tb">
						{this.props.headers.map((obj)=>{
							return(<th key={obj._id}>{obj.header}</th>)
						})}
					</tr>
				</thead>	
				<tbody>
					{this.props.contacts.map((obj)=>{
						return (<tr className="row-tb" key={obj._id}>
								{this.props.headers.map((hobj)=>{
									let comp = hobj.header;
									return (<td key={hobj._id}>{obj[comp]}</td>)	
								})}
							</tr>)
					})}
				</tbody>	
			</table>
			</div>
		);
	}
}

export default ClientLists;