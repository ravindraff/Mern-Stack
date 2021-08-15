#Create Server
=>create server like backend
=>cretae sample json file package.json
=>cretae sample js file server.js
=>download all modules for backend server
=>yarn add express mongodb mongoose body-parser nodemon  --save
=>import downloaded modules and implement server
=>in server.js:
======================
const express = require("express");
const cors = require("cors");
const mongoDb = require("mongodb");
const bodyparser = require("body-parser");

const app = express();
const mClient = mongoDb.MongoClient;
const dbUrl = "mongodb+srv://admin:admin@mycluster.zvdho.mongodb.net/mern-db?retryWrites=true&w=majority";
const ObjectId = mongoDb.ObjectId;
app.use(cors());
app.use(bodyparser.json())
app.use(bodyparser.urlencoded({
    extended: false
}));

app.get("/getEmployees", (req, res) => {
    mClient.connect(dbUrl, (err, connection) => {
        if (err) throw err;
        else {
            const db = connection.db("mern-db")
            db.collection("employees").find().toArray((err, resData) => {
                if (err) throw err;
                else {
                    res.send(resData);
                }
            })
        }
    });
});

app.get("/employee/:id", (req, res) => {
    mClient.connect(dbUrl, (err, connection) => {
        if (err) throw err;
        else {
            const db = connection.db("mern-db")
            try {
                db.collection("employees").find({
                    "_id": new ObjectId(req.params.id)
                }).toArray((err, resData) => {
                    if (err) throw err;
                    else {
                        if (resData.length > 0) {
                            res.send(resData[0]);
                        } else {
                            res.send({
                                message: "Product Not Available"
                            })
                        }
                    }
                })
            } catch (error) {
                res.send({message:"invalid product"});
            }
        }
    });

});
app.post("/addEmployee", (req, res) => {
    let resObj = {
        "id": req.body.id,
        "fullName": req.body.fullName,
        "email": req.body.email,
        "mobile": req.body.mobile,

    };
    mClient.connect(dbUrl, (err, connection) => {
        if (err) throw err;
        else {
            let db = connection.db("mern-db");
            db.collection("employees").insertOne(resObj, (err, Result) => {
                if (err) throw err;
                else {
                    res.status(200).json({
                        insert: "successfully inserted "
                    });
                }
            })
        }
    })
})
app.put("/editEmployee", (req, res) => {
    resOb = {
        "mobile": req.body.mobile,
        "email": req.body.email
    }
    mClient.connect(dbUrl, (err, connection) => {
        if (err) throw err;
        else {
            let db = connection.db("mern-db");
            db.collection("employees").updateOne({
                "id": req.body.id
            }, {
                $set: resOb
            }, (err, result) => {
                if (err) throw err;
                else {
                    res.send({
                        update: "success"
                    })
                }
            })
        }
    })
})
app.delete("/deleteEmployee", (req, res) => {
    mClient.connect(dbUrl, (err, connection) => {
        if (err) throw err;
        else {
            let db = connection.db("mern-db");
            db.collection("employees").deleteOne({
                "id": req.body.id
            }, (err, response) => {
                if (err) throw err;
                else {
                    res.send({
                        delete: "success"
                    });
                }

            })
        }
    })
})
app.listen(8080, () => {
    console.log("serevr started successfully....");
});


=>create frontend react-app
   =>create-react-app client
   =>cd client
   =>download modules 
     =>yarn add axios redux react-redux redux-thunk react-router-dom --save
   =>create folder like actions add reducers in src folder
   =>create actions like employees add getEmployeeDetais in actions folder
   =>create reducers like employees add getEmployeeDetais in reducers folder

   =>create employees.js,details.js in actions folder
   in employees.js file:
   ===============
   import axios from "axios";

    export const employees=()=>{
        return async(dispatch)=>{
            dispatch({type:"GET_EMP",loading:true})
            try {
                const {data} = axios.get("http://localhost:8080/getEmployees");
                dispatch({type:"GET_EMP_SUC",loading:false,value:data}) ;
            } catch (error) {
                dispatch({type:"GET_EMP_FAIL",loading:false,error:error.message}) ;
            }
        };
    }


   in details.js file:
   ===============
   import axios from "axios";
    export const getDetailsEmp = (id) => {
        return async (dispatch) => {
            dispatch({type: "GET_DET_EMP",loading: true});
            try {
                const {data} = axios.get(`http://localhost:8080/employee/${id}`);
                dispatch({type: "GET_DET_EMP_SUC",loading: false,value: data}); 
                
            } catch (error) {
                dispatch({type: "GET_DET_EMP_FAIL",loading: false,error: error.message});
                
            }
        };

    };

    =>create employees.js,details.js in reducers folder

    in employees.js file:
    =============
        const initialState = {
            loading: false,
            employees: [],
            error: false,
        };

        const employee = (state = initialState, action) => {
            switch (action.type) {
                case "GET_EMP":
                    return {
                        ...state,
                        loading: action.loading,

                    };
                case "GET_EMP_SUC":
                    return {
                        ...state,
                        loading: action.loading,
                            employees: action.value
                    };
                case "GET_EMP_FAIL":
                    return {
                        ...state,
                        loading: action.loading,
                            error: action.error,
                    }
                    default:
                        return state;
            }
        };
        export default employee;

        in details.js file:
        =============

            const initialState = {
                loading: false,
                employees: {},
                error: false,
            };

            const details = (state = initialState, action) => {
                switch (action.type) {
                    case "GET_DET_EMP":
                        return {
                            ...state,
                            loading: action.loading,

                        };
                    case "GET_DET_EMP_SUC":
                        return {
                            ...state,
                            loading: action.loading,
                                employees: action.value
                        };
                    case "GET_DET_EMP_FAIL":
                        return {
                            ...state,
                            loading: action.loading,
                                error: action.error,
                        }
                        default:
                            return state;
                }
            };
            export default details;

    =>in index.js file :
    ========================================================
        import React from 'react';
        import ReactDOM from 'react-dom';
        import './index.css';
        import App from './App';
        import reportWebVitals from './reportWebVitals';


        import { createStore, applyMiddleware,combineReducers } from "redux"
        import { Provider } from "react-redux";
        import {thunk} from "redux-thunk";
        import employees from './reducers/employees';
        import details from './reducers/details';
        const rootReducer = combineReducers({
        "employees": employees,
        "details": details
        })
        const store = createStore(rootReducer,applyMiddleware(thunk))




        ReactDOM.render(
        <Provider store={store}>
            <React.StrictMode>
            <App />
            </React.StrictMode>
        </Provider>
        ,
        document.getElementById('root')
        );

        // If you want to start measuring performance in your app, pass a function
        // to log results (for example: reportWebVitals(console.log))
        // or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
        reportWebVitals();

        =>create screens folder in that folder we can create HomeScreen and Employee screens 
        ================================================================
        in HomeScreen.js file:
        ===============

            import React, { useEffect } from 'react'
            import {useDispatch,useSelector} from "react-redux";
            import * as action from "../actions/employees";

            function HomeScreen() {
                const dispatch = useDispatch();
                const  data = useSelector(state=>(state.employees));
                const { loading,employees,error } = data;
                useEffect(()=>{
                    dispatch(action.employees())
                },[]);
                return (
                    <div>
                    <h1>{JSON.stringify(data)}</h1> 
                    </div>
                )
            }
            export default HomeScreen
