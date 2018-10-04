
$(function(){
	
	
var options = { 
						series:{
						//lines:{  fill: true ,show:true},
						 lines:{ show:true},
							bars: {
								align: "center",
								fillColor: { colors: [{ opacity: 1 }, { opacity: 1}] },
								barWidth: 500,
								lineWidth: 1
							}					   
						},               
						legend:{
						show:true,
						 },               
						xaxes: [{
						 tickSize: [60, "second"],
						 mode: "time",
						 //timeformat: "%H:%M:%S/%P",
						 //twelveHourClock: true,
						 //minTickSize: [1, "seconds"],
						 //timeformat:"%d/%m (%0h:%0m)",
						 autoscaleMargin:0.0,
						 timezone:"browser"
							}], 
						 yaxes: [{}],
						 grid: {      
							backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
						}				 
					   };
var totalPoints = 100;  // var totalPoints = 100;
var updateInterval = 5000;  // var updateInterval = 5000;
var now = new Date().getTime();
			  
//---------------------DATASETS--------------------------
var datasets = {
		"hmdty0": {
			label: "Humidty-A",
			data: []
		},
		"temp0": {
			label: "Temperature-A",
			data: []
		},
		"hmdty1": {
			label: "Humidity-B",
			data: []
		},
		"temp1": {
			label: "Temperature-B",
			data: []
		},
		"hmdty2": {
			label: "Humidity-C",
			data: []
		},
		"temp2": {
			label: "Temperature-C",
			data: []
		},
		"hmdty3": {
			label: "Humidty-D",
			data: []
		},
		"temp3": {
			label: "Temperature-D",
			data: []
		}
		
};
//------------------------------Choice data to Graph------------------------------------------
//------------------------------socket communications---------------------------------------------
var socket = io.connect("/", {
				"reconnect" : true,
				"reconnection delay" : 500,
				"max reconnection attempts" : 10
			});			
		socket.on("connect", function(data) 	
			  {
			  socket.emit("message", "Connected - " + (new Date()).toString());			  
//--------------------------------------------------InitData-------------------------------------
		         for (var i = 0; i < totalPoints; i++) {
					var temp = [now += updateInterval, 0];
				
					  datasets.hmdty0.data.push(temp);
					  datasets.temp0.data.push(temp);
					  datasets.hmdty1.data.push(temp);     
					  datasets.temp1.data.push(temp);
					  datasets.hmdty2.data.push(temp);     
					  datasets.temp2.data.push(temp);
					  datasets.hmdty3.data.push(temp);     
					  datasets.temp3.data.push(temp);      
			         }
			
			});
			
			socket.on("message", function (data) {
					 //console.log(datasets.light.data);	
					  datasets.hmdty0.data.shift();
					  datasets.temp0.data.shift();
					  datasets.hmdty1.data.shift();     
					  datasets.temp1.data.shift();
					  datasets.hmdty2.data.shift();    
					  datasets.temp2.data.shift();
					  datasets.hmdty3.data.shift();  
					  datasets.temp3.data.shift();
					  
					   now += updateInterval
					  /* Try this gauge out  */
					  Gauge.Collection.get('temp').setValue(data.celcius); 
					  Gauge.Collection.get('temp1').setValue(data.z); 

					  temp = [now, data.light];
					   datasets.hmdty0.data.push(temp);
					  
					  temp = [now, data.noise];
					  datasets.temp0.data.push(temp);

					  temp = [now, data.height];
					  datasets.hmdty1.data.push(temp); 
					  
					  temp = [now, data.smoke];
					  datasets.temp1.data.push(temp);
					  
					  temp = [now, data.dust];
					  datasets.hmdty2.data.push(temp);   
					  
					  temp = [now, data.humidity];  
					  datasets.temp2.data.push(temp); 
					  
					  temp = [now, data.temperature];
					  datasets.hmdty3.data.push(temp);  
					  
					  temp = [now, data.vibration]; 
					  datasets.temp3.data.push(temp); 		
							  
	 //-----------------Flot Graph--------------------
					  plotAccordingToChoices();	             
		});

//--------------------------------------------Flot Graph------------------------------------


//------------------Choice data to Graph---------------------
var i = 0;
$.each(datasets,function(key,val) {
	val.color = i;
	++i;
});
//--------------------------------()-------------------------
var choiceContainer = $(".sidemenu");
function plotAccordingToChoices() {
	var data = [];
	
	choiceContainer.find("input:checked").each(function () {
		var key = $(this).attr("name");
		if (key && datasets[key]) {
			data.push(datasets[key]);
		}	
	});

	if (data.length > 0) {
		$.plot(".displayarea", data, options);
	}	
} 

/*Start Status code*/
$('.stat_item').click(function(){

	var stat_id = $(this).find('input').attr('id');
	
	if(document.getElementById(stat_id).checked == true){
		document.getElementById(stat_id).checked = false;
	}
	else if(document.getElementById(stat_id).checked == false) {
		document.getElementById(stat_id).checked = true;
	}
	
	switch(stat_id){
		case "idhmdty0":
			//alert("this is Humidty-A button.Under development");						
		break;
		case "idtemp0":
			//alert("this is Temperature-A button. Under development");
		break;
		case "idhmdty1":
			//alert("this is Humidty-B button. Under development");
		break;
		case "idtemp1":
			//alert("this is Temperature-B button. Under development");
		break;
		case "idhmdty2":
			//alert("this is Humidity-C button. Under development");
		break;
		case "idtemp2":
			//alert("this is Temperature-C button. Under development");
		break;
		case "idhmdty3":
			//alert("this is Temperature-D Under development");
		break;
		case "idtemp3":
		//alert("this is Temperature-D Under development");
		break;
		default:
		break;
	
	}
	 plotAccordingToChoices();
	// plot.setData( datasets); 
	// plot.setupGrid();
	// plot.draw();
	
});

/*Data Controller Code*/

$('.vdcontent').show();

$(document).ready(function () {	

//Default state	of command
var lastCmd = "STP";
//Sending command to server
			function jsonSERIAL( name, power){
					socket.json.emit('ToSerialPort', {
						CTL: name,
						PWR: power,
					});
					//-console.log(name + ": power:" + power);
				}
				
//length data from server
				socket.on('distanceHTML', function(data){				
					$('#distance').val(data);
					$(".warn-disp").html(data);	
				});

// These buttons control the forward movement of the robot
				$("#fwd").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Forward");			
				    $("#gauge").val("DOWN");
				    
				    //lastCmd = "FORWARD";
				    	    lastCmd = "FWD";
				    jsonSERIAL(lastCmd, $('#slideValue').val());		           
				}).mouseup(function () {
					   $(".warn-disp").html("Forward Stop");
					   $("#gauge").val("UP");
					console.log("Button Released");  
				      
				   //  jsonSERIAL("STOP", $('#slideValue').val());     
				       jsonSERIAL("STP", $('#slideValue').val());   
				}); 

 // These buttons control the backward movement of the robot
				$("#bcwd").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Backward");
				     $("#gauge").val("DOWN");				     
				    lastCmd = "BWD"; 
				    jsonSERIAL(lastCmd, $('#slideValue').val());		            
				}).mouseup(function () {
					   $(".warn-disp").html("Backward Stop");
					   $("#gauge").val("UP");
					console.log("Button Released");
	
				     jsonSERIAL("STP", $('#slideValue').val());  
				});            
              				                      
 // These buttons control the right movement of the robot
				$("#right").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Right");
				     $("#gauge").val("DOWN");				     
				     lastCmd = "RGT";
				     jsonSERIAL(lastCmd, $('#slideValue').val());		           
				}).mouseup(function () {
					   $(".warn-disp").html("Right Stop");
					   $("#gauge").val("UP");					   
					console.log("Button Released");
					  
				     jsonSERIAL("STP", $('#slideValue').val());  
					//socket.emit('robot command', { command: 'stop' });        
				});         
				        
 // These buttons control the left movement of the robot
				$("#left").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Left");
				     $("#gauge").val("DOWN");
				     lastCmd = "LFT"; 
				     jsonSERIAL(lastCmd, $('#slideValue').val());				     
				}).mouseup(function () {
					  //window.alert("DOWN");
					   $(".warn-disp").html("Left Stop");
					   $("#gauge").val("UP");
					console.log("Button Released");
				     
				      jsonSERIAL("STP", $('#slideValue').val());  
				});            
            
 // These buttons control turn right  the robot
				$("#trt").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Turn Right");
				     $("#gauge").val("DOWN");
				     lastCmd = "TRT"; 
				     jsonSERIAL(lastCmd, $('#slideValue').val());
				     //jsonSERIAL(lastCmd, "245");  
				}).mouseup(function () {
					  //window.alert("DOWN");
					 $(".warn-disp").html("Turn Right Stop");
					   $("#gauge").val("UP");
					   console.log("Button Released");			     
				      jsonSERIAL("STP", $('#slideValue').val());  
					//socket.emit('robot command', { command: 'stop' });        
				});   
    
 // These buttons control the turn left of the robot
				$("#tlt").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Turn Left");
					$("#gauge").val("DOWN");
				     lastCmd = "TLT"; 
				     jsonSERIAL(lastCmd, $('#slideValue').val());		
				  //   $("#gauge").val("DOWN");
				   //   jsonSERIAL(lastCmd, "128");  
				}).mouseup(function () {
					   $(".warn-disp").html("Turn Left Stop");
					   $("#gauge").val("UP");
					   console.log("Button Released");			     
				      jsonSERIAL("STP", $('#slideValue').val());  
					//console.log("Button Released");
					//socket.emit('robot command', { command: 'stop' });        
				});            

 // These buttons control the stop movement of the robot
				$("#stop").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Stop");
				     $("#gauge").val("DOWN");
				       lastCmd = "STP"; 
				       jsonSERIAL(lastCmd, $('#slideValue').val());	
				}).mouseup(function () {
					   $(".warn-disp").html("Stop");
					   $("#gauge").val("UP");
					console.log("Button Released"); 
				    jsonSERIAL("STP", $('#slideValue').val());    // lastCmd 
				});  
				              
 // These buttons control the active movement of the robot
				$("#actv").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Active");
				     $("#gauge").val("DOWN");
				}).mouseup(function () {
					  //window.alert("DOWN");
					   $(".warn-disp").html("Enactive");
					   $("#gauge").val("UP");
					console.log("Button Released");
					//socket.emit('robot command', { command: 'stop' });        
				});            
        
 // These buttons control the down movement of the robot
				$("#down").mousedown(function () {
					console.log("Button Pressed");
					$(".warn-disp").html("Down");
				     $("#gauge").val("DOWN");
				}).mouseup(function () {
					  //window.alert("DOWN");
					   $(".warn-disp").html("UP");
					   $("#gauge").val("UP");
					console.log("Button Released");
					//socket.emit('robot command', { command: 'stop' });        
				});            
});            
            

  
  var $document = $(document).ready(function () {
	  // var $document = $(document);
        var selector = '[data-rangeslider]';
        var $element = $(selector);

        // For ie8 support
        var textContent = ('textContent' in document) ? 'textContent' : 'innerText';

        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value;
            var output = element.parentNode.getElementsByTagName('output')[0] || element.parentNode.parentNode.getElementsByTagName('output')[0];
            output[textContent] = value;
        }

        $document.on('input', 'input[type="range"], ' + selector, function(e) {
            valueOutput(e.target);
            
        });

        // Basic rangeslider initialization
        $element.rangeslider({	

            // Deactivate the feature detection
            polyfill: false,

            // Callback function
            onInit: function() {
                valueOutput(this.$element[0]);
            },

            // Callback function
            onSlide: function(position, value) {
                console.log('onSlide');
                console.log('position: ' + position, 'value: ' + value);
                socket.emit('ToSerialPort', + 	value);
                $(".warn-disp").html('position: ' + position );
                  $(".warn-disp").html('value: ' + value);
                Gauge.Collection.get('temp').setValue(value); 
                  $(".warn-disp").html('position: ' + position );
                Gauge.Collection.get('temp2').setValue( position); 
            },

            // Callback function
            onSlideEnd: function(position, value) {
                console.log('onSlideEnd');
                console.log('position: ' + position, 'value: ' + value);
            }
        });
 
	  
  }); 	  
  
//----------------------------SLIDER----------------------------------------  
 
$(".vbtns").click(function(){
	
	var _arid=this.id;
	switch(_arid){
		case "videost":
		
                 
		     break;
		case "picsnap":
	
		    break;
		default:
			break;
	}
});


$(document).ready(function () {
             $("#rbtn1").click(function () {
             
            });//option 1

             $("#rbtn2").click(function () {
             
            });//option2
});


$(document).ready(function () {

             $("#rbtn3").click(function () {
        
            });//option 3
 
            $("#rbtn4").click(function () {
              
            });//option 4
        });
 
});
