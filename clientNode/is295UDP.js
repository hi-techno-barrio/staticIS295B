
//conect to javascript
var express = require('express'); 
var app = express();
var server = app.listen(4000);
var io = require('socket.io').listen(server);
var mysql = require('mysql');
var excelbuilder = require('msexcel-builder');

var dgram = require("dgram");
var udpServer = dgram.createSocket("udp4");
var fs = require('fs');

// user datagram protocol
var host = '192.168.8.104';
var dPort = 5555;
var rPort = 3333;
//-----------------------------------------//

io = require('socket.io').listen(server);		    // filter the server using socket.io
//var portName = '/dev/ttyACM0';                      // Assign to your own port		
//console.log("opening serial port: " + portName);	// print out the port you're listening on

server.listen(3000);	
// listen for incoming requests on the server

app.use(express.static(__dirname));

var IS295data = mysql.createConnection({
    host: '127.0.0.1',
    user: 'root',
    password: 'robook1234',
    database: 'dcmsDB;'
});	

var workbook = excelbuilder.createWorkbook('', 'is295data.xlsx')

IS295data.connect(function(error) {
	if (!!error) {
		console.log('Error');
	}else {
		  console.log('Connected to database');
	  }
});

// Create a new worksheet with 10 columns and 12 rows 
var sheet1 = workbook.createSheet('Aquisition', 10, 12);
         sheet1.set(1, 1, 'Humidity');
         sheet1.set(2, 1, 'Smoke');
         sheet1.set(3, 1, 'Noice');
		 sheet1.set(4, 1, 'Light');
		 sheet1.set(5, 1, 'Temperature');
		 sheet1.set(6, 1, 'Gyro');
		 sheet1.set(7, 1, 'Vibration');
// Fill some data 
  //   sheet1.set(1, 1, 'I am title');
  //   for (var i = 2; i < 5; i++)
  //   sheet1.set(i, 1, 'test'+i);
  //   Save it 
workbook.save(function(ok){
    if (!ok) 
      workbook.cancel();
    else
      console.log('congratulations, your workbook created');
  });


var channel = io.sockets.on("connection", function (socket) {
         //switch C
	   // sp.write('c');
  
    // If socket.io receives message from the client browser then 
    // this call back will be executed.
    
    socket.on('ToSerialPort', function(data){
//check the data
     	var receive = JSON.stringify(data);
//udp hit!       
       var  message = receive.toString();
        send(message, host, dPort);
        console.log(message);
	  });
	  
       socket.on("message", function (msg) {
       // console.log(msg);
         });
         
// If a web browser disconnects from Socket.IO then this callback is called.
      socket.on("disconnect", function () {
      console.log("disconnected");
       });
});


function send(message, host, dPort) {
  udpServer.send(message, 0, message.length, dPort, host, function(err, bytes) {
    //console.log(message);
  // udpServer.close();
  });
}

/*
server.on("message", function (msg) { // it should be coming from the socket.io on message
 var serialData = JSON.parse(msg);
	 console.log(serialData);
	 console.log(serialData.dust);
}); 
*/
udpServer.on("message", function (msg,rinfo) { // it should be coming from the socket.io on message
	//  var strData = msg.toString('ascii');
	// console.log(strData);
	  var serialData = JSON.parse(msg);
	  console.log(serialData);
	// channel.emit ('distanceHTML',serialData); 
	  channel.emit ('message',serialData); 
});
/*
server_socket.on(‘message’, function(msg, rinfo) {
message = new Buffer(‘Server Says: ‘+msg.toString());
server_socket.send(message,0,message.length,rinfo.port,rinfo.address);
console.log(‘Datagram details’);
console.dir(rinfo);
});
*/
udpServer.bind(rPort);
