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
//-----------------------------socket communications---------------------------------------------
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
				  datasets.hmdty0.data.shift();
				  datasets.temp0.data.shift();
				  datasets.hmdty1.data.shift();     
				  datasets.temp1.data.shift();
				  datasets.hmdty2.data.shift();    
				  datasets.temp2.data.shift();
				  datasets.hmdty3.data.shift();  
				  datasets.temp3.data.shift();

				  now += updateInterval

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
		//--------------Flot Graph--------------------
				 plotAccordingToChoices();	             
		});
//--------------------------------------------InitData-------------------------------------
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
//----------------------------()------------------------
//setInterval(getData, 100); 
//------------------------------()------------------------
var plotIndex = 0;
//-----------------------()-------------------------

function plots(index){ // need only different options
	var data = [];
	
	choiceContainer.find("input:checked").each(function () {
		var key = $(this).attr("name");
	
		if (key && datasets[key]) {
			data.push(datasets[key]);
		}
		
		switch (index){
			case 1:
				// year
				$.plot(".displayarea", data, {
				xaxis: { mode: "time" ,timeformat: " %y",
				  min: (new Date()).getTime()-1800000,
                  max: (new Date()).getTime()
                                       }
				}); 
				
				 // $(".displayarea").hide(); 
			break;
			case 2:
				//month
				 $.plot(".displayarea", data, {
				xaxis: {
					mode: "time",timeformat: " %b %y ",
					min: (new Date()).getTime()-86400000, //-3600000,
                    max: (new Date()).getTime()
					}
				});  
				//$(".displayarea").show(); 
			break;
			case 3:
				//week
				$.plot(".displayarea", data, {
				xaxis: {
					mode: "time",timeformat: " %d/%w",
					minTickSize: [1, "day"],
					min: (new Date()).getTime()-172800000,
                    max: (new Date()).getTime()
					//timeformat: "%a"
					
					}
				});  
			break;
			case 4:
				// day
				$.plot(".displayarea", data, {
				xaxis: {
				    mode: "time" , timeformat: "%b %d, %H:%P",
					minTickSize: [12, "hour"],
					min: (new Date()).getTime()-180000000,//-86400000,
                    max: (new Date()).getTime()
				}
				}); 
			break;
			case 5:
				// hour
		  		$.plot(".displayarea", data, {
				xaxis: {
					mode: "time",timeformat: "%d, %H:%P",
					minTickSize: [1, "hour"],
					min: (new Date()).getTime()-430200000,
                    max: (new Date()).getTime()
					//twelveHourClock: true
					}
				});  
			break;
			case 6:
				//minute
				$.plot(".displayarea", data, {
				xaxis: {
					mode: "time",timeformat: "%d, %H:%M:%P",
					minTickSize: [30, "minute"],
					min: (new Date()).getTime()-430200000,
                    max: (new Date()).getTime()
					//twelveHourClock: true
					}
				});  
			break;
			case 7:
				//second
				$.plot(".displayarea", data, {
				xaxis: {
					mode: "time",timeformat: " %H:%M:%P",
					minTickSize: [10, "second"],
					min: (new Date()).getTime()-430200000,
                    max: (new Date()).getTime()
					//twelveHourClock: true
					}
				});  
			break;
			default:
			// realtime graph as usual
		    break;
			
		}// Switch
	});
	

}

/*End Flot Code*/
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
/*End Status code*/
/*Archive and Current Button*/
$(".archv-btn").click(function(){
	
	$(this).addClass("actvbtn").siblings().removeClass("actvbtn");
	switch(this.id){
		case "year":
			//alert("Insert your code here for year");
			plotIndex=1;
			plots(plotIndex);
			break;
		case "month":
			plotIndex=2;
			plots(plotIndex);
			break;
		case "week":
			plotIndex=3;
			plots(plotIndex);
			break;
		case "day":
			plotIndex=4;
			plots(plotIndex);
			break;
		default:
			break;
	}
});

$(".cur-btn").click(function(){
	$(this).addClass("actvbtn").siblings().removeClass("actvbtn");
	switch(this.id){
		case "hour":
			plotIndex=5;
			plots(plotIndex);
			break;
		case "minute":
			plotIndex=6;
			plots(plotIndex);
			break;
		case "second":
			plotIndex=7;
			plots(plotIndex);
			break;
		case "html":
			//window.location.assign(  "localhost/staticIS295B/includes/main/report.php");
			 document.getElementById("html").href = "http://localhost/staticIS295B/includes/main/report.php";
			break;
		case "excel":
			//alert("Insert your code here for second");
			//window.location.href = "../../includes/main/report.php";
			break;
		default:
			break;
	}
});

		
/*End*/

});
