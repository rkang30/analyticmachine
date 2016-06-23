import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

class Clients extends React.Component{

	constructor(){
		super();
		this.state = {
			projects: [],
			search: '',
			header: ''
		};
	}

	componentDidMount(){

		this.serverRequest = $.ajax({
			type: 'get',
			url: this.props.source,
			dataType: 'json',
			cache: false,
			success: function(result){
				this.setState({projects:result});
			}.bind(this)
		});	

	}

	componentWillUnmount(){
		this.serverRequest.abort();
	}	

	updateProjectList(event){
		this.setState({
			search: event.target.value
		});
	}

	render(){

		let filteredProjects = this.state.projects.filter((project)=>{
			if(project.name.toLowerCase().indexOf(this.state.search.toLowerCase()) !== -1){
				return true;
			}else{
				return false;
			}
		});

		return (<div className="col-md-10 col-md-offset-1">
					<h1>Projects</h1>
					<fieldset className="form-group">
						<input type="text" className="form-control" id="project_search" onChange={this.updateProjectList.bind(this)} value={this.state.search} placeholder="Search"/>
					</fieldset>
					<ul className="list-group">
						{filteredProjects.map((project)=>{
							let projectLink = '/projects/detail/'+project.slug;
							return (<li className="list-group-item" key={project.id}><a href={projectLink}>{project.name}</a></li>)
						})}
					</ul>
				</div>)
	}
}

ReactDOM.render(<Clients source='http://analyticmachine.com/projects/lists'/>, document.getElementById('project_list'));