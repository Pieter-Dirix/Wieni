import React, {Component} from 'react';
import './App.css';
import Search from './Search/Search';
import Movie from './Movie/Movie';
import Serie from './Serie/Serie';
import axios from 'axios';
import firebase from './Firebase/Firebase';
import Radium from 'radium';

class App extends Component {
    constructor(props) {
        super(props);
        this.state = {
            searchterm: '',
            searchresult: {},
            timeWasted: 0,
            movies: [],
            series: [],
            backdrop: ''
        };
        this.getData();

    }

    //zoekt de huidige zoek term op in de movie db
    searchHandler = () => {
         if(this.state.searchterm !== '') {
             let url = 'https://api.themoviedb.org/3/search/multi/?api_key=437604c32ed28ed4d9a1e372b2fec8e0&page=1&query=' + this.state.searchterm ;
             axios.get(encodeURI(url))
                 .then(response => {
                     this.setState({
                         searchresult: response.data
                     });
                 });
         }else {
             this.setState({
                 searchresult: {}
             });
         }

    };
    //slaagt bij elke keystroke de zoekterm op in de state
    onChangeHandler = (event) => {
        this.setState({
            searchterm: event.target.value
        });
    };

    //haalt alle gekeken series en films op en saved deze in de state
    getData = () => {
        let m = [];
        let s = [];
        let runtime = 0;
        const db = firebase.firestore();
        db.settings({
            timestampsInSnapshots: true
        });
        let moviesRef = db.collection('movies');
        let allMovies = moviesRef.get()
            .then(snapshot => {
                snapshot.forEach(doc => {

                    console.log(doc.id, '=>', doc.data());
                    runtime += parseInt(doc.data().runtime);
                    m.push(doc.data())
                });
                this.setState({
                    movies: m,
                    timeWasted: runtime
                })
            })
            .catch(err => {
                console.log('Error getting documents', err);
            });


        var seriesRef = db.collection('series');
        var allSeries = seriesRef.get()
            .then(snapshot => {
                snapshot.forEach(doc => {

                    console.log(doc.id, '=>', doc.data());
                    runtime += parseInt(doc.data().runtime);
                    s.push(doc.data());
                });
                this.setState({
                    series: s,
                    timeWasted: runtime
                })
            })
            .catch(err => {
                console.log('Error getting documents', err);
            });


    };
    //voegt de aangeklikte serie/film toe aan fire store en update de state
    addTimeHandler = (e) => {
        e.preventDefault();
        const db = firebase.firestore();
        db.settings({
            timestampsInSnapshots: true
        });

        if (e.target.media_type.value === 'movie') {
            const movieRef = db.collection('movies').add({
                searchid: e.target.id.value,
                runtime: e.target.runtime.value
            }).then(function () {
                console.log("Document successfully written!");
            }).catch(function (error) {
                console.error("Error writing document: ", error);
            });

        } else if (e.target.media_type.value === 'tv') {
            const serieRef = db.collection('series').add({
                seriesid: e.target.id.value,
                runtime: e.target.runtime.value,
                seizoenen: e.target.seasons.value
            }).then(function () {
                console.log("Document successfully written!");
            }).catch(function (error) {
                console.error("Error writing document: ", error);
            });
        }
        this.getData();
    };

    styles = {
        base: {
          margin: 0,
          padding: 0
        },
        header: {
            width: '100%',
            display: 'inline-block',
            background: 'black',
            color: 'white'
        },
        item: {
            ':hover': {
                background: 'grey'
            }
        }
    };

    totalTime = (timeWasted) => {
        let totalyears =Math.floor(timeWasted / (12 * 30* 7 * 24 *60));

        timeWasted = timeWasted % (12 * 30 * 7 * 24* 60);
        let totalmonths =Math.floor(timeWasted / (30 *7 * 24 *60));

        timeWasted = timeWasted % (30 * 7 * 24* 60);
        let totalweeks = Math.floor(timeWasted / (7 * 24* 60));

        timeWasted = timeWasted % (7 * 24* 60);
        let totaldays = Math.floor(timeWasted / (24* 60));

        timeWasted = timeWasted % (24*60);
        let totalhours = Math.floor(timeWasted / 60);

        timeWasted %= 60;
        let totalminutes = timeWasted;

        return totalyears + ' Years, ' + totalmonths + ' months, ' + totalweeks + ' weeks, ' + totaldays + ' days, ' + totalhours + ' hours and ' + totalminutes +  ' minutes.'
    };

    render() {
        //geeft de zoek resultaten weer

        let results;
        if (this.state.searchresult.results) {
            results = this.state.searchresult.results.map((result) => {
                if (result.media_type === "movie") {
                    return <Movie style={this.styles.item} watched="false" title={result.title} overview={result.overview}
                                  addTimeClick={this.addTimeHandler}
                                  id={result.id}/>
                } else if (result.media_type === "tv") {
                    return <Serie style={this.styles.item} watched="false" title={result.name} overview={result.overview}
                                  addTimeClick={this.addTimeHandler}
                                  id={result.id}/>
                }

            });
        }
        //de gekeken films en series
        let watchedMovies = this.state.movies.map((movie) => {
            return <Movie style={this.styles.item} watched="true" id={movie.searchid} runtime={movie.runtime}/>
        });

        let watchedSeries = this.state.series.map((serie) => {
            return <Serie style={this.styles.item} watched="true" id={serie.seriesid} runtime={serie.runtime} nrOfSeasons={serie.seizoenen}/>
        });

        return (
            <div className="App" style={this.styles.base}>
                <div style={this.styles.header}>
                    <h1>Time Wasted: {this.totalTime(this.state.timeWasted)}</h1>
                    <Search search={this.searchHandler} searchterm={this.onChangeHandler}/>
                </div>
                <div className="results">
                    {results}
                </div>
                <hr/>
                <h2>Watched</h2>
                <div className="watched">
                    <div className="movies">
                        {watchedMovies}
                    </div>
                    <div className="series">
                        {watchedSeries}
                    </div>
                </div>
                <h5>Movie/Tv data from: <a href="https://www.themoviedb.org/">https://www.themoviedb.org/</a></h5>
            </div>
        );
    }
}

export default Radium(App);
