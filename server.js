const express = require('express')
const app = express()
const mongoose = require('mongoose')
const Registeruser = require('./model')
const jwt = require('jsonwebtoken')
const middleware = require('./middleware') 
app.use(express.json())
mongoose.connect("mongodb+srv://admin:admin@mycluster.zvdho.mongodb.net/myFirstDatabase?retryWrites=true&w=majority",{
    useUnifiedTopology: true,
    useNewUrlParser: true,
    useCreateIndex:true,

}).then(()=>{
    console.log("DB Connection established")
})

app.post("/register",async (req, res)=>{
    try {
        const {username,email,password,confirmpassword} = req.body;
        let exist = await Registeruser.findOne({email})
        if(exist) {
            return res.status(400).send("User Already Registered")
        }
        if(password !== confirmpassword) {
            return res.status().send("Passwords are not match")
        }
        let newUser = new Registeruser({
            username,
            email,
            password,
            confirmpassword
        })
        await newUser.save();
        res.status(200).send("User Registered successfully")
        
    } catch (error) {
        console.log("Error: " + error)
        res.status(500).send("Internal Server Error")
    }
})

app.post("/login",async (req, res) => {
    try {
        const {email,password} = req.body
        let exist = await Registeruser.findOne({email})
        if (!exist) {
            res.status(404).send("User Not Found")
        }
        if(exist.password!==password) {
            res.status(403).send("Invalid Credentials")
        }
        let payload = {
            user:{
                id:exist.id,
            }
        }
        jwt.sign(payload,"JwtSecret",{expiresIn:3600000},(err,token)=>{
            if(err) throw err;
            return res.json({token})
        })
        
    } catch (error) {
        console.log("Error: " + error)
        res.status(500).send("Internal Server Error")
    }

})
app.get("/myprofile",middleware,async (req, res)=>{
    try {
        let exist = await Registeruser.findById(req.user.id);
        if(!exist){
          return res.status(400).send("User not found")
        }
        return res.json(exist)
    } catch (error) {
        console.log(error)
        return res.status(500).send("Internal Server Error")
    }
})
app.listen(5000,()=>{
    console.log("server running successfully")
})