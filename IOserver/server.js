let express = require('express');
let app     = express();
let server  = require('http').createServer(app);
let io      = require('socket.io').listen(server);

users = {};
connections = [];

server.listen(process.env.PORT || 4001);
console.log('server is running ...');

app.get("/" , function (req , res) {
	
	res.sendFile(__dirname + '/index.html'); 
});

io.sockets.on('connection' , function (socket) {
	connections.push(socket);
	console.log('connected : %s sockets connected' , connections.length);

	socket.on('disconnected' , function(data) {
		connections.splice(connections.indexOf(socket) , 1 );
		console.log('disconnected : %s socket disconnected ' , connections.length);
	});

	// set new users
	socket.on('new user' , function(data) {

		let already = false;

		for (var i = 0; i < users.length; i++) {
			
			if(users[i] == data) {
				
				already = true;

			}
		}

		if (already) {
			console.log("user already : " , data);
		}else {
			socket.username = data;
			users[socket.username] = socket;
			console.log("new user : " , data);
			console.log(users);
		}
		

	});

	socket.on('new chat' , function(data) {
		

		// users.data.user_key.emit()
	});

});
