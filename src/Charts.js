import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

class Charts extends React.Component{

	constructor()
	{
		super();
		this.state = {
			xlinechrtval: ''
		};
	}

	updateXvalue()
	{
		let selectedVal = $('#line_charts option:selected').val();
		this.setState({
			xlinechrtval: selectedVal
		});
	}

	render(){

		let data = this.props.contacts;
		let groups = [];
		this.props.headers.map(function(obj){
			
			let colm = obj.header;
			
		   	let colmval	 = data.reduce(function(result, current) {
		        result[current[colm]] = result[current[colm]] || [];
		        result[current[colm]].push(current);
		        return result;
		    }, {})
		    
		    groups[colm] = colmval;
		   	//console.log(colmval);
		});
		
		let passKey = false;
		let keyName = '';
		let headerNum = this.props.headers.length;
		let i = 1;

		if(this.state.xlinechrtval != ''){
			passKey = true;
			keyName = this.state.xlinechrtval;
		}else{
			this.props.headers.map(function(obj){
				if(obj.header.toLowerCase().indexOf('create') !== -1){
					//line chart
					passKey = true;
					keyName = obj.header;
					return false;
				}

				if(passKey == false){
					if((obj.header.toLowerCase().indexOf('date') !== -1) || (obj.header.toLowerCase().indexOf('dt') !== -1)){
						//line chart
						passKey = true;
						keyName = obj.header;
						return false;
					}

					if(passKey == false){
						if(i == headerNum){
							passKey = true;
							keyName = obj.header;
						}
					}
				}
			  i++;	
			});
		}


		if(passKey == true){
			//show line chart
			let labels = [];
			let values = [];

			$.each(groups[keyName], function(i, v){
				labels.push(i);
				values.push(v.length);
			});
			
	  		let barData = {
		  
			  labels: labels,
			  series: values
			 
			};
		
			//console.log(scaleStr);
			let MaxBar = Math.max.apply(Math, values); 
			let MinBar = Math.min.apply(Math, values); 
			if(MinBar > 0){
				MinBar = 0;
			}
			let barOptions = {
			  	high: MaxBar,
			  	low: MinBar,
				distributeSeries: true,
			  	axisX: {
				    labelInterpolationFnc: function(value, index) {
				    	if(values.length <= 3){
				    		return value;
				    	}else if((values.length > 3) && (values.length <= 10)){
				    		return index % 2 === 0 ? value : null;
				    	}else if(values.length > 10){
				    		return index % 5 === 0 ? value : null;
				    	}
				      
				    }
			  	}
			};

			let pieData = {
				labels: labels,
				series: values
			};

			var pieOptions = {
				labelInterpolationFnc: function(value) {
					return value[0]
				}
			};	

			var PieResponsiveOptions = [
			  ['screen and (min-width: 640px)', {
			    chartPadding: 10,
			    labelOffset: 20,
			    labelDirection: 'explode',
			    labelInterpolationFnc: function(value) {
			      return value;
			    }
			  }],
			  ['screen and (min-width: 1024px)', {
			    labelOffset: 30,
			    chartPadding: 10
			  }]
			];					

			var BarChart = new Chartist.Bar('.ct-chart', barData, barOptions);

			BarChart.on('draw', function(data) {
			  if(data.type === 'bar') {
			    data.element.animate({
			      y2: {
			        dur: 1000,
			        from: data.y1,
			        to: data.y2,
			        easing: Chartist.Svg.Easing.easeOutQuint
			      },
			      opacity: {
			        dur: 1000,
			        from: 0,
			        to: 1,
			        easing: Chartist.Svg.Easing.easeOutQuint
			      }
			    });
			  }
			});

			var PieChart = new Chartist.Pie('.ct-piechart', pieData, pieOptions, PieResponsiveOptions);	

/*			PieChart.on('draw', function(data) {
			  if(data.type === 'slice') {
			    // Get the total path length in order to use for dash array animation
			    var pathLength = data.element._node.getTotalLength();

			    // Set a dasharray that matches the path length as prerequisite to animate dashoffset
			    data.element.attr({
			      'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
			    });

			    // Create animation definition while also assigning an ID to the animation for later sync usage
			    var animationDefinition = {
			      'stroke-dashoffset': {
			        id: 'anim' + data.index,
			        dur: 100,
			        from: -pathLength + 'px',
			        to:  '0px',
			        easing: Chartist.Svg.Easing.easeOutQuint,
			        // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
			        fill: 'freeze'
			      }
			    };

			    // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
			    if(data.index !== 0) {
			      animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
			    }

			    // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us
			    data.element.attr({
			      'stroke-dashoffset': -pathLength + 'px'
			    });

			    // We can't use guided mode as the animations need to rely on setting begin manually
			    // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
			    data.element.animate(animationDefinition, false);
			  }
			});*/	

		}

	    return (
	    	<div>
		      	<div className="row chart-dashboard">
		      		<div className="col-md-5">
		      			<div className="ct-chart ct-perfect-fourth"></div>
		      		</div>
		      		<div className="col-md-5">
		      			<div className="ct-piechart"></div>
		      		</div>
		      		<div className="col-md-2">
		      			<fieldset className="form-group">
			      			<select id="line_charts" className="form-control" value={keyName} onChange={this.updateXvalue.bind(this)}>
			      				{this.props.headers.map((obj)=>{
			      					return(<option key={obj._id} value={obj.header}>{obj.header}</option>)
			      				})}
			      			</select>
		      			</fieldset>
		      		</div>		      		
		      	</div>	    	
	    	</div>
	    );
	}
}

export default Charts;