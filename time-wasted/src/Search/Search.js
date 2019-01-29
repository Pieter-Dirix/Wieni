import React from 'react';

const search = (props) => {

    return <div className="form">
        <input type="text" placeholder="search" onChange={props.searchterm}/>
        <input type="submit" value="Submit" onClick={props.search}/>
    </div>

};

export default search;