import React from 'react';
import axios from "axios";
import Radium from 'radium';

class Serie extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            searchresult: '',
            searchid: '',
            totRuntime: 0,
            runtime: '',
            nrOfSeasonsWatched: '',
            seasons: '',
            nrOfSeasons: ''
        };
    }

    //gebruikt de meegekregen id om al de specifieke info op te halen
    componentDidMount(){
        let url = 'https://api.themoviedb.org/3/tv/' + this.props.id + '?api_key=437604c32ed28ed4d9a1e372b2fec8e0';
        axios.get(encodeURI(url)).then(response => {
            this.setState({
                searchresult: response.data,
                searchid: response.data.id,
                totRuntime: 0,
                runtime: response.data.episode_run_time[0],
                nrOfSeasonsWatched: '',
                seasons: response.data.seasons,
                nrOfSeasons: response.data.number_of_seasons
            });
        });
    };
    //berekent de totale runtime voor de hoeveelheid geselecteerde seizoenen op basis van de runtime per episode
    calculateTotalRuntime = (e) => {
        e.preventDefault();
        let nrS = e.target.value;
        let s = this.state.seasons;
        let epRT = this.state.runtime;
        let tRT = 0;

        for(let i = 0; i < nrS; i++) {
            let cs = s[i];
            let epC = cs.episode_count;
            tRT += epC * epRT;
        }
        console.log(tRT);

        this.setState({
            totRuntime: tRT
        })
    };



    render() {
        //this.getSerieDetails();
        if(this.props.watched === "false") {
            return (
                <div className="serie" style={this.props.style}>

                    <h2> {this.props.title} </h2>
                    <p>{this.state.nrOfSeasons} Seasons</p>
                    <img src={this.props.img} alt=""/>
                    <form onSubmit={this.props.addTimeClick}>
                        <input onChange={this.calculateTotalRuntime}  name="seasons" type="number" min="0" max={this.state.nrOfSeasons} placeholder="Seasons"/>
                        <input name="id" type="hidden" defaultValue={this.props.id} />
                        <input name="runtime"type="hidden" defaultValue={this.state.totRuntime}/>
                        <input name="bgimg" type="hidden" defaultValue={"https://image.tmdb.org/t/p/" + this.state.searchresult.backdrop_path}/>
                        <input name="media_type"type="hidden" defaultValue={'tv'}/>
                        <button type="submit"><b>+</b></button>
                    </form>

                </div>

            )
        }else {
            return(
                <div className="serie watched" style={this.props.style}>

                    <h3> {this.state.searchresult.name} </h3>
                    <p>{this.props.nrOfSeasons} Seasons</p>
                    <p>{this.props.runtime} min.</p>

                </div>
            )
        }

    }
}


export default Radium(Serie);
