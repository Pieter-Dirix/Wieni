import React from 'react';
import axios from "axios";
import Radium from 'radium';

class Movie extends React.Component {

    state = {
        searchresult: '',
        searchid: '',
        runtime: ''
    };

    //gebruikt de meegekregen id om al de specifieke info op te halen
    componentDidMount() {
        let url = 'https://api.themoviedb.org/3/movie/' + this.props.id + '?api_key=437604c32ed28ed4d9a1e372b2fec8e0';
        axios.get(url).then(response => {
            this.setState({
                searchresult: response.data,
                searchid: response.data.id,
                runtime: response.data.runtime
            });
        });
    }

    render() {
        if (this.props.watched === "false") {
            return (
                <div className="movie" style={this.props.style}>

                    <h2> {this.props.title} </h2>
                    <p> {this.state.runtime} min.</p>
                    <form onSubmit={this.props.addTimeClick}>
                        <input name="id" type="hidden" defaultValue={this.props.id}/>
                        <input name="runtime" type="hidden" defaultValue={this.state.runtime}/>
                        <input name="media_type" type="hidden" defaultValue={'movie'}/>
                        <button type="submit"><b>+</b></button>
                    </form>

                </div>
            )
        }else {
            return (
                <div className="watched movie" style={this.props.style}>
                    <h3> {this.state.searchresult.title} </h3>
                    <p> {this.props.runtime} min. </p>
                </div>
            )
        }
    }
}


export default Radium(Movie);
