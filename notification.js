var server = require('http').Server();
var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis(6379);

redis.subscribe('notification');

redis.on('message', function(channel, message) {
	console.log(message);
});

// redis.on('message', function(channel, message) {
//     message = JSON.parse(message);

//     io.emit(channel + ':' + message.event, message.data);
// });

server.listen(6379);