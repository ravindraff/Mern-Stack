download and install npm
===========================
npm is node pakaging manager

after that install npm

install yarn tool
=====================
npm install -g yarn@latest



create-react-app tool using create react projects
npm install -g create-react-app

=============================================

create folder
switch to created folder
>cd folder name
>create-react-app first-app
switch to folder
>cd first-app
start the project 
>npm start/yarn start

Git Commit:
===================
echo "# ReactPractices" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/ravindraff/ReactPractices.git
https://github.com/ravindraff/React_Ex.git
git push -u origin main

yarn add @material-ui/core @material-ui/icons --save
lazy load:
yarn add react-lazy-load-image-component --save

Create Lazy load App:
===================
>create-react-app get-app --template typescript
>yarn add @material-ui/core @material-ui/icons --save
>yarn add axios --save
https://morioh.com/p/a9ec38a35c23
>yarn add @types/react-lazy-load-image-component --save
>yarn add react-lazy-load-image-component --save

axios:
    ===========
    assyncCall:
    ===================
    import React from 'react';
    import axios from 'axios';
    import urlName from './config';

    function assyncCall():any{
        return axios.get(urlName)
    }
    export default assyncCall;

urlName:
    ===========
    config.tsx:
    =========
    const urlName: string = "https://restcountries.eu/rest/v2/all";
    export default urlName;

Get Countries:
    ===========
    import { TableBody, TableRow } from '@material-ui/core';
    import { TableHead } from '@material-ui/core';
    import { Table, TableContainer ,TableCell, Paper } from '@material-ui/core';

    import React, {useState,useEffect} from 'react';
    import assyncCall from './assyncCall'
    const [countries,getCountries] = useState([]);
    useEffect(()=>{
        assyncCall()
        .then((posRes:any)=>{
           console.log(posRes.data);
            getCountries(posRes.data);
        },(err:any)=>{
            console.log(err);
        })
    },[]);
    useEffect(()=>{
        
    },[]);
    countries.map((element,index)=>(

    ));






Loading indicator:
======================
create-react-app get-app --template typescript
yarn add axios
yarn add @material-ui/core @material-ui/icons --save
https://www.basefactor.com/react-how-to-display-a-loading-indicator-on-fetch-calls
yarn add react-promise-tracker --save
https://morioh.com/p/a9ec38a35c23
npm i --save-dev @types/react-lazy-load-image-component
yarn add react-lazy-load-image-component --save
yarn add @types/react-lazy-load-image-component
yarn add react-loader-spinner --save


mongodb+srv://admin:<password>@cluster0.ary28.mongodb.net/myFirstDatabase?retryWrites=true&w=majority

USER : nodejs_usr
PWD:admin
DATABASE: mern-db
Collection :employees
mongodb+srv://nodejs_usr:admin@cluster0.6mktf.mongodb.net/nodjs_db?retryWrites=true&w=majority
to download node modules : 
npm i express mongodb cors body-parser --save


USER : admin
PWD:admin
mongodb+srv://admin:<password>@mycluster.zvdho.mongodb.net/myFirstDatabase?retryWrites=true&w=majority


Create Server : 
====================================
>create server folder

>cd server
=>create smaple json file
=>download modules express mongodb cors body-parser
>server>npm i express mongodb cors body-parser --save
>server>yarn add express mongodb cors body-parser --save

=>create server.js file
=>in server.js file import all modules
=================================
let express = require('express');
let mongodb = require('mongodb');
let cors = require('cors');
let bodyParser = require('body-parser');

//create the client
let mclient = mongodb.MongoClient;


//create rest object
let app = express();

//to enable the port communication
app.use(cors());

//MIME type 
app.use(bodyParser.json());

//Read the post data 
app.use(bodyParser.urlencoded:{extended:true})

let password = "admin";
let db_name = "mern-db";
let collection_name = "employees";
let url = 'mongodb+srv://admin:'+password+'@mycluster.zvdho.mongodb.net/'+db_name+'?retryWrites=true&w=majority';


//create the post request object
app.post('',function(req,res){
    mclient.connect(url,(err,client)=>{
        if(err) throw err;
        else
        {
            let db = client.db(db_name);
            db.collection(collection_name).insertOne(obj,(err,result)=>{
                if(err) throw err;
                else {
                    res.send({insert : "success"});
                }
                
            });
        }
    })
})
//Create the get request object
app.get('',function(req,res){
    mclient.connect(url, function (err, connection) {
        if(err) throw err;
        else{
            var db = connection.db(db_name);
            db.collection(collection_name).find().toArray(function (err, array) {});
        } 
    })

})
//Create the update request object
app.put('',function(req,res){
    let obj = {};
    mclient.connect(url,(err,client) => {
        if (err) throw err;
        else{
            let db = client.db(db_name);
            db.collection(collection_name).updateOne({"id":req.body.id},{$set:obj},(err,result) => {
                if (err) throw err;
                else{
                    res.send({update : "success"})
                }
            }
            )
        }
    });
})

//listening for port 
app.listen('port',function(

))



ex:
================================================================

//import all modules
//require('');
let express = require('express');
let cors = require('cors');
let bodyparser = require('body-parser');
let mongodb = require('mongodb');

//create a object for rest services
let app = express();
//where app is the rest object
//where app object helps to develop the rest services

//to enable ports communication

app.use(cors());

//JSON as MIME type
app.use(bodyparser.json());

//read the form data 
app.use(bodyparser.urlencoded({ extended :false }));


let password = "admin";
let db_name = "mern-db";
let collection_name = "employees";
let url = 'mongodb+srv://admin:'+password+'@mycluster.zvdho.mongodb.net/'+db_name+'?retryWrites=true&w=majority';
//let db_url ='mongodb+srv://admin:'+password+'@cluster0.ary28.mongodb.net/'+db_name+'?retryWrites=true&w=majority';
let mclient = mongodb.MongoClient;

//create the get request
//var url = "mongodb+srv://nodejs_usr:admin@cluster0.6mktf.mongodb.net/nodejs_db?retryWrites=true&w=majority";
app.get('/getproducts', function (req, res) {
    mclient.connect(url, function (err, connection) {
        if (err) throw err;
        else {
            var db = connection.db(db_name);
            db.collection(collection_name).find().toArray(function (err, array) {
                if (err) throw err;
                else {
                    res.send(array);
                }
            });
        }
    });
});

// Create the post request
app.post('/createEmployee', function (req, res) {
    let obj = {
        "id":req.body.id,
        "fullName":req.body.fullName,
        "email":req.body.email,
        "mobile":req.body.mobile,
        "departmentId":req.body.departmentId,
        "gender":req.body.gender,
        "hireDate":req.body.hireDate,
    };
    mclient.connect(url,(err,client)=>{
        if(err) throw err;
        else
        {
            let db = client.db(db_name);
            db.collection(collection_name).insertOne(obj,(err,result)=>{
                if(err) throw err;
                else {
                    res.send({insert : "success"});
                }
                
            });
        }
    })

})

//create the update request

app.put('/updateEmployee', function (req, res) {
    let obj = {
        "email":req.body.email,
        "mobile":req.body.mobile,
    };
    mclient.connect(url,(err,client) => {
        if (err) throw err;
        else{
            let db = client.db(db_name);
            db.collection(collection_name).updateOne({"id":req.body.id},{$set:obj},(err,result) => {
                if (err) throw err;
                else{
                    res.send({update : "success"})
                }
            }
            )
        }
    });
})

let port = process.env.PORT || 8080 ;
app.listen(port,()=>{
    console.log("server started successfully.........");
    console.log(url);
})



//Create State Management
===============================
>yarn add redux --save
=>import createStore function in redux
    const {createStore} = require('redux');
=>create store using createStore()
    const store = createStore();
=>create reducer
    const reducer = (state,action)=>{};
=>deploy reducer
    const store = createStore(reducer);
=>create initialState
    const initialState ={}
=>implement initialState to reducer
    const reducer = (state=initialState,action)=>{};
=>create the dispatcher
    store.dispatch({type:"AGE_UP",value:1})
    store.dispatch({type:"AGE_DOWN",value:1})
=>implement the business logic into reducer
    const reducer=(state=initialState,action)=>{
        switch(action.type){
            case "AGE_UP":
                return{
                    ...state,
                    age:state.age + 1
                }
                break;
            case "AGE_DOWN":
                return{
                    ...state,
                    age:state.age - 1
                }
        }
        return state;
    }
=>create subscribe
    store.subscribe(()=>{
        console.log(store.getState());
    })


Example:
============================================
create-react-app crud-app-thunk --template typescript
cd crud-app-thunk
yarn add @material-ui/core --save
in index.html include this
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
yarn add @material-ui/icons --save
to change main css => font family to 'Roboto',
yarn start

create components folder
=======================
App.tsx:
==========
    import React from 'react';
    import Header from '../components/Header';
    import SideMenu from '../components/SideMenu';
    import PageHeader from '../components/PageHeader';
    import './App.css';
    import {createMuiTheme, makeStyles, ThemeProvider} from '@material-ui/core';
    import GroupAddIcon from '@material-ui/icons/GroupAdd';
    const useStyles = makeStyles({
    appMain: {
    paddingLeft:"320px",
    //width:"100%"
    }
    })
    const customTheme = createMuiTheme({
    palette:{ 
        primary:{
        main : "#FF0000"
        }
    }
    })
    function App() {
    const classes = useStyles();
    return (
        <ThemeProvider theme={customTheme}>
        <SideMenu />
        <div className={classes.appMain }>
            <Header />
            <PageHeader 
            title="Employee Management System" 
            subtitle='Add Employee' 
            icon={<GroupAddIcon />} />
        </div>

        </ThemeProvider>  
    );
    }

    export default App;

1.Header file
================
    import { AppBar, Badge, Grid, IconButton, InputBase, Toolbar ,makeStyles} from "@material-ui/core";
    import {  MailOutlined, NotificationsOff } from "@material-ui/icons";
    import SettingsPowerIcon from '@material-ui/icons/SettingsPower';
    import SearchIcon from '@material-ui/icons/Search';
    import React from "react";
    const useStyles = makeStyles(theme=>({
        root:{ 
            background:"white",
            transform:"translateZ(0)"
        },
        searchItem: {
            opacity:"0.6",
            padding: `0px ${theme.spacing(1)}px`,
            fontSize:"0.8rem",
            width:"300px",
            border: "1px solid grey",
            borderRadius:"10px",
            '&:hover':{
                backgroundColor:"#f2f2f2"
            },
            '& .MuiSvgIcon-root':{
                marginRight:theme.spacing(1)
            }

            
        }
    }));
    function Header() {
        const classes = useStyles();
        return(
            <AppBar position="static" className={classes.root}>
                <Toolbar>
                    <Grid container alignItems="center">
                        <Grid item>
                            <InputBase  className={classes.searchItem} placeholder="Search Here" 
                            startAdornment={<SearchIcon fontSize={"small"} />}
                            />
                        </Grid>
                        <Grid item sm={true}>
                        </Grid>
                        <Grid item>
                            <IconButton>
                            <Badge badgeContent={4} color="secondary">
                                <NotificationsOff />
                            </Badge>
                            </IconButton>
                            <IconButton>
                            <Badge badgeContent={4} color="secondary">
                                <MailOutlined />
                            </Badge>
                            </IconButton>
                            <IconButton>
                            <Badge color="secondary">
                                <SettingsPowerIcon />
                            </Badge>
                            </IconButton>

                        </Grid>

                    </Grid>
                </Toolbar>
            </AppBar>
        )
    }
    export default Header;
2.Page header file
===========================
    import React from "react";
    import {makeStyles, Paper, Card, Typography} from '@material-ui/core';
    const useStyles = makeStyles(theme=>({
        root: {
            backgroundColor:"#fdfdff",
            
        },
        PageHeader: {
            padding:theme.spacing(4),
            display: "flex",
            marginBottom:theme.spacing(2)
        },
        PageIcon: {
            display:'inline-block',
            padding:theme.spacing(2)
        },
        PageTitle: {
            paddingLeft:theme.spacing(2),
            '& .MuiTypography-subtitle2':{
                opacity:'0.6',
                marginTop:theme.spacing(1)
            }

        }
    }))
    function PageHeader(props:any){
        const classes = useStyles();
        const {title,subtitle,icon} = props
        return(
            <div>
                <Paper elevation={0} className={classes.root}>
                    <div className={classes.PageHeader}>
                        <Card className={classes.PageIcon}>
                            {icon}
                        </Card>
                        <div className={classes.PageTitle}>
                            <Typography variant="h6" component="div">{title}</Typography>
                            <Typography variant="subtitle2" component="div">{subtitle}</Typography>
                        </div>
                    </div>
                </Paper>
            </div>
        )
        
    }
    export default PageHeader;
3.Side Menu file
======================================
    import React from "react";
    import { makeStyles } from '@material-ui/core';
    const useStyles = makeStyles({
        SideMenu:{ 
            display:"flex",
            flexDirection:"column",
            width:"320px",
            height:"100%",
            position:"absolute",
            left:"0px",
            //backgroundColor:"linear-gradient(#e66465, #9198e5)",
            background: 'linear-gradient(to right bottom, #430089, #82ffa1)',

        }
    })

    function SideMenu() {
        const classes = useStyles();
        return(
            <div className={classes.SideMenu}>
            </div>
        )
    }
    export default SideMenu;

yarn add axios @types/axios --save
yarn add redux @types/redux --save
yarn add react-redux @types/react-redux --save
yarn add redux-thunk @types/redux-thunk --save
yarn add axios @types/axios redux @types/redux redux-thunk @types/redux-thunk --save

create actions file 
===================
    import axios from 'axios';

    /*------------------------------FETCH-----------------------------------*/
    export const getEmployees =()=>{
        return (dispatch:any) =>{
            return axios.get("http://localhost:8080/getEmployees").then((posData:any)=>{
                dispatch(employees(posData.data));
            },(errRes:any)=>{
                console.log(errRes);
            })
        }
    }
    export const employees =(records:any)=>{
        return {type:"FETCH",value:records}
    }
    /*----------------------------------------------------------------------*/
    /*------------------------------ADD-------------------------------------*/
    export const addEmployee=(employee:any)=>{
        return (dispatch:any)=>{
            return axios.post("http://localhost:8080/createEmployee", employee).then((posData:any)=>{
                posData.data.createEmployee = employee;
                dispatch(addemp(posData));
            },(err:any)=>{
                console.log(err);
            })
        }
    }
    export const addemp = (result:any) =>{
        return {type:"ADD",value:result};
    }
    /*-----------------------------END--------------------------------------*/
    /*-----------------------------Edit-------------------------------------*/
    export const updateEmployee=(employee:any)=>{
        return (dispatch:any)=>{
            return axios.put("http://localhost:8080/updateEmployee", employee).then((posData:any)=>{
                posData.data.createEmployee = employee;
                dispatch(updateemp(posData));
            },(err:any)=>{
                console.log(err);
            })
        }
    }
    export const updateemp = (result:any) =>{
        return {type:"EDIT",value:result};
    }
    /*------------------------------END-------------------------------------*/
    /*-----------------------------DELETE-------------------------------------*/
    export const deleteEmployee=(employee:any)=>{
        return (dispatch:any)=>{
            return axios.delete("http://localhost:8080/deleteEmployee", {data: employee}).then((posData:any)=>{
                posData.data.createEmployee = employee;
                dispatch(delemp(posData));
            },(err:any)=>{
                console.log(err);
            })
        }
    }
    export const delemp = (result:any) =>{
        return {type:"DELETE",value:result};
    }
    /*------------------------------END-------------------------------------*/

create reducer file
=========================
    const initialState:any = {
        records: []
    }
    const reducer:any =(state=initialState,actions:any)=>{
        switch(actions.type){
            case "FETCH":
                return{
                    ...state,
                    records :state.records.concat(actions.value)
                }
                break;
            case "ADD":
            case "EDIT":
            case "DELETE":
                return{
                    ...state,
                    status:actions.value
                }
        }
    }
    export default reducer;


    ==========================

    in index.tsx:
    ================
    import {createStore , applyMiddleware} from 'redux';
    import { Provider } from 'react-redux';
    import reducer from './reducers/reducer'
    import thunk from 'redux-thunk';
    const store = createStore(reducer,applyMiddleware(thunk));
    <Provider store={store}>
    <App />
    </Provider>,




    validate:
    =======================
    const validate:any=(fieldValues=values)=>{
        const temp:any = {...errors};
        if("fullName" in fieldValues)
            temp.fullName = fieldValues.fullName?"":"fullName is Required";
        if("id" in fieldValues)
            temp.id = fieldValues.id?"":"Id is Required";
        if("email" in fieldValues)
           <!--  temp.email = fieldValues.email?"":"email is Required"; -->
            temp.email =(/$^|.+@.+..+/).test(fieldValues.email)?"":"email is invalid";
        if("city" in fieldValues)
            temp.city = fieldValues.city?"":"city is Required";
        if("mobile" in fieldValues)
            temp.mobile = fieldValues.mobile.length>9?"":"mobile number is 10 digits mandatory";
        setErrors({...temp});

    }

    const {values,setValues,errors,setErrors,handleInputChange,resetForm} = useForm(initialFValue,true,validate);

    import React, { useState } from "react";
export default function useForm(initialFValue:any,validateOnChange:boolean=false,validate:any){
    const [values,setValues] = useState(initialFValue);
    const [errors,setErrors] = useState({fullName:"",id:"",email:"",city:"",mobile:""});
    const handleInputChange:any =(event:any):any=>{
        const {name,value} = event.target;
        setValues({
            ...values,
            [name]: value
        });
        if(validateOnChange){
            validate({ [name]: value})
        }
    }
    const resetForm:any =(event:any):any=>{
        setValues(initialFValue);
        setErrors({fullName:"",id:"",email:"",city:"",mobile:"",});
    }
    return{
        values,
        setValues,
        errors,
        setErrors,
        handleInputChange,
        resetForm
    };
};

Form Creation :
===================
import { Grid } from "@material-ui/core";
import React from "react";
import Input from '../../Controls/Input';
import Controls from '../../Controls/Controls';
import Form from "../../Form";
import useForm from "../../useForm";
const initialFValue:any={
    fullName : "",
    id:"",
    email : "",
    city :"",
    mobile : "",
}

export default function EmployeeForm():any{
    const validate:any=(fieldValues=values)=>{
        const temp:any = {...errors};
        if("fullName" in fieldValues)
            temp.fullName = fieldValues.fullName?"":"fullName is Required";
        if("id" in fieldValues)
            temp.id = fieldValues.id?"":"Id is Required";
        if("email" in fieldValues)
            temp.email = fieldValues.email?"":"email is Required";
        if("city" in fieldValues)
            temp.city = fieldValues.city?"":"city is Required";
        if("mobile" in fieldValues)
            temp.mobile = fieldValues.mobile.length>9?"":"mobile number is 10 digits mandatory";
        setErrors({...temp});

    }
    const {values,setValues,errors,setErrors,handleInputChange,resetForm} = useForm(initialFValue,true,validate);
    return(
        <Form>
            <Grid container>
                <Grid item xs={6}>
                    
                    <Controls.Input 
                    name="fullName"
                    label="full Name"
                    value={values.fullName}
                    error={errors.fullName}
                    onChange={handleInputChange}/>
                    <Controls.Input 
                    name="email"
                    label="Email"
                    value={values.email}
                    error={errors.email}
                    onChange={handleInputChange}/>
                    <Controls.Input 
                    name="city"
                    label="City"
                    value={values.city}
                    error={errors.city}
                    onChange={handleInputChange}/>
                   
                </Grid>
                <Grid item xs={6}>
                <Controls.Input 
                    name="fullName"
                    label="full Name"
                    value={values.fullName}
                    error={errors.fullName}
                    onChange={handleInputChange}/>
                    <Controls.Input 
                    name="email"
                    label="Email"
                    value={values.email}
                    error={errors.email}
                    onChange={handleInputChange}/>
                    <Controls.Input 
                    name="mobile"
                    label="mobile"
                    value={values.mobile}
                    error={errors.mobile}
                    onChange={handleInputChange}/>
                </Grid>
            </Grid>

        </Form>
    );
}

yarn add @date-io/date-fns
yarn add @material-ui/pickers --save
yarn add --dev package.json



>yarn add express @types/express mongodb @types/mongodb body-parser @types/body-parser cors @types/cors axios @types/axios react-router-dom @types/react-router-dom --save


tic-tac-toe:
function Square(props) {
  return (
    <button className="square" onClick={props.onClick}>
      {props.value}
    </button>
  );
}

class Board extends React.Component {
  renderSquare(i) {
    return (
      <Square
        value={this.props.squares[i]}
        onClick={() => this.props.onClick(i)}
      />
    );
  }

  render() {
    return (
      <div>
        <div className="board-row">
          {this.renderSquare(0)}
          {this.renderSquare(1)}
          {this.renderSquare(2)}
        </div>
        <div className="board-row">
          {this.renderSquare(3)}
          {this.renderSquare(4)}
          {this.renderSquare(5)}
        </div>
        <div className="board-row">
          {this.renderSquare(6)}
          {this.renderSquare(7)}
          {this.renderSquare(8)}
        </div>
      </div>
    );
  }
}

class Game extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      history: [
        {
          squares: Array(9).fill(null)
        }
      ],
      stepNumber: 0,
      xIsNext: true
    };
  }

  handleClick(i) {
    const history = this.state.history.slice(0, this.state.stepNumber + 1);
    const current = history[history.length - 1];
    const squares = current.squares.slice();
    if (calculateWinner(squares) || squares[i]) {
      return;
    }
    squares[i] = this.state.xIsNext ? "X" : "O";
    this.setState({
      history: history.concat([
        {
          squares: squares
        }
      ]),
      stepNumber: history.length,
      xIsNext: !this.state.xIsNext
    });
  }

  jumpTo(step) {
    this.setState({
      stepNumber: step,
      xIsNext: (step % 2) === 0
    });
  }

  render() {
    const history = this.state.history;
    const current = history[this.state.stepNumber];
    const winner = calculateWinner(current.squares);

    const moves = history.map((step, move) => {
      const desc = move ?
        'Go to move #' + move :
        'Go to game start';
      return (
        <li key={move}>
          <button onClick={() => this.jumpTo(move)}>{desc}</button>
        </li>
      );
    });

    let status;
    if (winner) {
      status = "Winner: " + winner;
    } else {
      status = "Next player: " + (this.state.xIsNext ? "X" : "O");
    }

    return (
      <div className="game">
        <div className="game-board">
          <Board
            squares={current.squares}
            onClick={i => this.handleClick(i)}
          />
        </div>
        <div className="game-info">
          <div>{status}</div>
          <ol>{moves}</ol>
        </div>
      </div>
    );
  }
}

// ========================================

ReactDOM.render(<Game />, document.getElementById("root"));

function calculateWinner(squares) {
  const lines = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
  ];
  for (let i = 0; i < lines.length; i++) {
    const [a, b, c] = lines[i];
    if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
      return squares[a];
    }
  }
  return null;
}
