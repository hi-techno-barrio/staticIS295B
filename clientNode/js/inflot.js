

!function() {

			
			//--------------------------------------------------Start Porting--------------------------------
			var cpu = [], cpuCore = [], disk = [];
			var dataset;
			var totalPoints = 100;
			var updateInterval = 5000;
			var now = new Date().getTime();
			
			var options = {
				series: {
					lines: {
						lineWidth: 1.2
					},
					bars: {
						align: "center",
						fillColor: { colors: [{ opacity: 1 }, { opacity: 1}] },
						barWidth: 500,
						lineWidth: 1
					}
				},
				xaxis: {
					mode: "time",
					tickSize: [60, "second"],
					tickFormatter: function (v, axis) {
						var date = new Date(v);

						if (date.getSeconds() % 20 == 0) {
							var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
							var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
							var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

							return hours + ":" + minutes + ":" + seconds;
						} else {
							return "";
						}
					},
					axisLabel: "Time",
					axisLabelUseCanvas: true,
					axisLabelFontSizePixels: 12,
					axisLabelFontFamily: 'Verdana, Arial',
					axisLabelPadding: 10
				},
				yaxes: [
					{
						min: 0,
						max: 200,
						tickSize: 5,
						tickFormatter: function (v, axis) {
							if (v % 10 == 0) {
								return v + "%";
							} else {
								return "";
							}
						},
						axisLabel: "CPU loading",
						axisLabelUseCanvas: true,
						axisLabelFontSizePixels: 12,
						axisLabelFontFamily: 'Verdana, Arial',
						axisLabelPadding: 6
					}, {
						max: 300,
						position: "right",
						axisLabel: "Disk",
						axisLabelUseCanvas: true,
						axisLabelFontSizePixels: 12,
						axisLabelFontFamily: 'Verdana, Arial',
						axisLabelPadding: 6
					}
				],
				legend: {
					noColumns: 0,
					position:"nw"
				},
				grid: {      
					backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
				}
			};
//--------------------------------------------------socket communications--------------------------------
			var socket = io.connect("/", {
				"reconnect" : true,
				"reconnection delay" : 500,
				"max reconnection attempts" : 10

			});
			
//--------------------------------------------------InitData-------------------------------------			
			  socket.on("connect", function(data) {
				socket.emit("message", "Connected - " + (new Date()).toString());
//--------------------------------------------------InitData-------------------------------------
		         for (var i = 0; i < totalPoints; i++) {
					var temp = [now += updateInterval, 0];
					cpu.push(temp);
					cpuCore.push(temp);
					disk.push(temp);
					//datasets.hmdty0.data.push(temp);
				}
			});
			
//--------------------------------------------------Update Data-------------------------------------------			   
			socket.on("message", function (data) {	

				//Gauge.Collection.get('temp').setValue(data.celcius); 
               // Gauge.Collection.get('temp1').setValue(data.z); 
				
				cpu.shift();
				cpuCore.shift();
				disk.shift();
                //datasets.hmdty0.data.shift();
				now += updateInterval;

				temp = [now, data.farenheit];
				cpu.push(temp);

				temp = [now, data.celcius];
				cpuCore.push(temp);

				temp = [now, data.z];
				disk.push(temp);

				dataset = [
					{ label: "Temperature:" + data.farenheit + "%", data: cpu, lines: { fill: true, lineWidth: 1.2 }, color: "#00FF00" },
					{ label: "Humidity:" + data.celcius + "%", data: disk, color: "#0044FF", bars: { show: true }, yaxis: 2 },
					{ label: "Vibrations:" + data.z + "%", data: cpuCore, lines: { lineWidth: 1.2}, color: "#FF0000" }        
				];

				$.plot($("#flot-placeholder1"), dataset, options);
				
//--------------------------------------------------Update Data-------------------------------------------
			
			});

			$.plot($("#flot-placeholder1"), dataset, options);
		}();
//-------------------------------------------------Send to Serial-------------------------------------------		

		
function toggle_led(state){
  socket.emit('toggle_led' , state ); 
  var button = $('#led_button'); 
  if(state === 'on'){
     button.attr("onclick", "toggle_led('off')"); 
     button.html('Turn off led'); 
   } else {
     button.attr("onclick", "toggle_led('on')"); 
    button.html("Turn on led");
   }
 }
