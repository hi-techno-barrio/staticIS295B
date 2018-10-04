var dgram = require("dgram");
var server = dgram.createSocket("udp4");

var crlf = new Buffer(2);
crlf[0] = 0xD; //CR - Carriage return character
crlf[1] = 0xA; //LF - Line feed character

var mysql      = require('mysql');
var dBase = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : 'xxxxxxx',
  database : 'dcmsDB'
});

//For Testing!
dBase.connect();
var sql = "INSERT INTO  Chrisdonbot (uls1,uls2,flight,hmdty0,temp0,hmdty1,temp1,hmdty2,temp2,hmdty3,temp3,DayTime) values('7','7','7','1','2','3','4','5','6','7','8',NOW())";
dBase.query(sql, function (err, result) {
    if (err) throw err;
    console.log("Okay nakasingit");
  });

dBase.end();


server.on("message", function (msg, rinfo) { //every time new data arrives do this:
  var MYtime = new Date().getTime();
 // var MYquery = 'INSERT INTO `arduino`.`arTable` (`id`, `value`, `serialNum`, `date`, `datetime`, `IP`) VALUES (NULL, "' + msg.readUInt16BE(1) + msg.readUInt16BE(0) +  '", "' + msg.readUInt16BE(2) + msg.readUInt16BE(3) + msg.readUInt16BE(4) + '", CURRENT_TIMESTAMP, "'+ MYtime + '", "'+ rinfo.address + ":" + rinfo.port + '");';
   var MYquery = "INSERT INTO  Chrisdonbot (uls1,uls2,flight,hmdty0,temp0,hmdty1,temp1,hmdty2,temp2,hmdty3,temp3,DayTime) values('7','7','7','1','2','3','4','5','6','7','8',NOW())";

  //console.log(MYquery); // you can comment this line out
  connection.query(MYquery, function(err, rows) {
  });
});

server.on("listening", function () {
  var address = server.address();
  console.log("server listening " + address.address + ":" + address.port);
});

server.bind(8080); //listen to udp traffic on port 8080
