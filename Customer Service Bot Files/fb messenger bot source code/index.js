'use strict'

const express = require('express')
const bodyParser = require('body-parser')
const request = require('request')
const apiai = require('apiai')
const cool = require('cool-ascii-faces')


const app = express()

const PORT = process.env.PORT || 5000

let PAGE_ACCESS_TOKEN = "#facebook page access token here"
let apiaiApp = apiai("#api ai token here");

app.set('port', (PORT));
console.log("running on port "+PORT);
//Allows us to process the data
app.use(bodyParser.urlencoded({extended: false}))

app.use(bodyParser.json())

//ROUTES

app.get('/', function(req, res){
	res.send("Hie I am a faceboook messenger chatbot, please use messenger to converse with me.")
})

// for facebook
app.get('/webhook', function(req, res){
	if (req.query['hub.verify_token']==="kudzieN01414178P") {
		res.status(200).send(req.query['hub.challenge'])
		console.log("verify token verified");
	}else{
		res.status(403).end()
		res.send("Wrong token")
	}
})

//Post event

app.post('/webhook', (req, res) =>{
	//console.log(req.body)
	if(req.body.object === 'page'){
		//console.log("object is page then ");
		let messaging_events = req.body.entry[0].messaging
		for (let i = 0; i < messaging_events.length; i++){
			let event = messaging_events[i]
			let sender = event.sender.id
			if(event.message && event.message.text){
				let text = event.message.text 
				//console.log(text);
				sendMessage(sender, text.substring(0, 100))
				//sendText(sender, "Text echo: "+ text.substring(0, 100))
			}
		}
		res.status(200).end()
	}
})

function sendText(sender, text){
	let messageData = {text: text}
	request({
		url: "https://graph.facebook.com/v2.6/me.messages",
		qs: {access_token: PAGE_ACCESS_TOKEN},
		method: "POST",
		json: {
			receipt: {id: sender},
			message: messageData
		}
	}, function(error, response, body){
		if(error){
			console.log("sending error")
		}else if(response.body.error){
			console.log("response body error")
		}
	})
}

function sendMessage(sender, text){
	/*
	let sender = event.sender.id
	let text = event.message.text
	*/
	let apiai = apiaiApp.textRequest(text, {
		sessionId: 'UNIQUE_SESSION_ID'
	})

	apiai.on('response', (response) => {
		var aiText = response.result.fulfillment.speech.toString();
		//console.log(aiText)
		request({
			url: 'https://graph.facebook.com/v2.6/me/messages',
			qs: {access_token: PAGE_ACCESS_TOKEN},
			method: 'POST',
			json:{
				recipient: {id: sender},
				message: {text: aiText}
			}
		}, (error, response) => {
			if(error){
				console.log("Messenger error")
				console.log('Error sending message: ', error)
			}else if(response.body.error){
				console.log("Messenger error")
				console.log('Error: ', response.body.error)
			}
		})

		postToDb(response)
	})

	apiai.on('error', (error) => {
		console.log("API AI error");
		console.log(error)
	})

	apiai.end()


}

app.listen(app.get('port'), function(){
	console.log("running: port ")
})



function postToDb(apiAiResponseObject){

	if(apiAiResponseObject.result.actionIncomplete=== false){
		var x
		if (apiAiResponseObject.result.action == "Food-order"){
			var roomNumber = apiAiResponseObject.result.parameters.roomNumber;
			var foodx = apiAiResponseObject.result.parameters.food;
			var beverage = apiAiResponseObject.result.parameters.beverage;
			var foodItems = beverage;

			for(var x in foodx){
				foodItems = foodItems+" + "+foodx[x]
			}
			

			//then we send to saveOrder.php with data being food and room number

			request({
					uri: "https://your url/saveFoodOrder.php",
					method: "POST",
					form: {
					room: roomNumber,
					food: foodItems
					}
			}, function(error, response, body){
				console.log(body);
				console.log(response.statusCode)
				console.log(error)
			})
		}

		if(apiAiResponseObject.result.action == "complaint-housekeeping"){
			var roomNumber = apiAiResponseObject.result.parameters.roomNumber
			var complaintTxt = apiAiResponseObject.result.resolvedQuery
			var facilitytxt = apiAiResponseObject.result.parameters.facility
			var department = "House Keeping"

			request({
				uri: "https://your url/saveComplaint.php",
				method: "POST",
				form: {
				room: roomNumber,
				complaintText: complaintTxt,
				facility: facilitytxt,
				dept: department

			}
			}, function(error, response, body){
				console.log(body);
				console.log(response.statusCode)
				console.log(error)
			})
		}
		else if(apiAiResponseObject.result.action == "complaint-food"){
			var roomNumber = apiAiResponseObject.result.parameters.roomNumber
			var complaintTxt = apiAiResponseObject.result.resolvedQuery
			var facilitytxt = "Food and Beverages"
			var department = "Food and Beverages"

			request({
				uri: "https://your url/saveComplaint.php",
				method: "POST",
				form: {
				room: roomNumber,
				complaintText: complaint,
				facility: facilitytxt,
				dept: department

			}
			}, function(error, response, body){
				console.log(body);
				console.log(response.statusCode)
				console.log(error)
			})
		}
		else if(apiAiResponseObject.result.action == "complaint-maintenance"){
			var roomNumber = apiAiResponseObject.result.parameters.roomNumber
			var complaintTxt = apiAiResponseObject.result.resolvedQuery
			var department = "Food and Beverages"
			var facilitytxt  = apiAiResponseObject.result.parameters.Maintenance;

			for(x in facilitytxt){
				facilityTxt += facilitytxt[x]
			}

			request({
				uri: "https://your url/saveComplaint.php",
				method: "POST",
				form: {
				room: roomNumber,
				complaintText: complaint,
				facility: facilitytxt,
				dept: department

			}
			}, function(error, response, body){
				console.log(body);
				console.log(response.statusCode)
				console.log(error)
			})
		}
	}
}

