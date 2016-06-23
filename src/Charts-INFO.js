import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

class Charts extends React.Component{

	render(){	

		function start(contacts, headers)
		{

			return function(){
				let groups = [];
				headers.map(function(obj){
					
					let colm = obj.header;
					
				   	let colmval	 = contacts.reduce(function(result, current) {
				        result[current[colm]] = result[current[colm]] || [];
				        result[current[colm]].push(current);
				        return result;
				    }, {})
				    
				    groups[colm] = colmval;
				});

				let labels = [];
				let series = [];
				$.each(groups['created'], function(i, v){
					labels.push(i);
					series.push(v.length);
				});

		  		let lineData = {
			  
				  labels: labels,
				  series: [
				    series
				  ]
				};

				new Chartist.Line('.ct-chart', lineData);
			}

		}

		$(document).ready(start(this.props.contacts, this.props.headers));
		
	    return (
	    	<div>
		      	<div className="row">
		      		<div className="col-md-3">
		      			<div className="ct-chart ct-perfect-fourth"></div>
		      		</div>
		      	</div>		    	
	    	</div>
	    );
	}
}

export default Charts;