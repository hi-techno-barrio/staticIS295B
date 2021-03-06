
/* 	<script type="text/javascript">  */
		!(function() {

			// Stats.js _______________________________________________

			var stats = new Stats();

			stats.domElement.style.position = 'absolute';
			stats.domElement.style.left = '0px';
			stats.domElement.style.top = '0px';
			document.body.appendChild( stats.domElement );

			// Initalize ___________________________________________
			
			var minAngle = 0;
			var maxAngle = 360;
			var maxDistance = 190;
			var width = 195;
			var pos = []; // Radar positions
			var drawPath = "";
			var detectAngle = 10;
			var centerP = {x:200, y:200}; // Center points
			var paper = Raphael("canvas", 400, 400);
			var duration = 360;
			var curve;
			var defaultStyle = { fill: "#fbb03b", "stroke-width": 1, "stroke": "#fbb03b",  "fill-opacity": 0.5, opacity: 0.35 };
			var defaultFontStyle = { "font-size": 13, "fill": "#FFF", "font-weight": "bold" };
			var gridStyle = { "stroke-width": 1, "stroke": "#fbb03b", opacity: 0.35 };
			var circle = paper.circle(centerP.x, centerP.y, width).attr(defaultStyle);
			var area0 = paper.circle(centerP.x, centerP.y, width * 0.75).attr(defaultStyle);
			var area1 = paper.circle(centerP.x, centerP.y, width * 0.5).attr(defaultStyle);
			var area2 = paper.circle(centerP.x, centerP.y, width * 0.25).attr(defaultStyle);
			var radar = paper.path("M" + centerP.x + "," + centerP.y + " v-" + width + " a" + width + "," + width + " 0 0,0 -" + width + "," + width + " z")
				.attr({
					"fill": "225-#fbb03b:20-#fbb03b:50",
					"fill-opacity": "0.001",
					"stroke-width": 0
				})
				.transform("r-90," + centerP.x + "," + centerP.y);
			var cmLabel1 = paper.text(centerP.x, centerP.y - width, maxDistance + "+cm").attr(defaultFontStyle);
			var cmLabel2 = paper.text(centerP.x, centerP.y - width * 0.75, (maxDistance * 0.75) + "cm").attr(defaultFontStyle);
			var cmLabel3 = paper.text(centerP.x, centerP.y - width * 0.5, (maxDistance * 0.5) + "cm").attr(defaultFontStyle);
			var cmLabel4 = paper.text(centerP.x, centerP.y - width * 0.25, (maxDistance * 0.25) + "cm").attr(defaultFontStyle);
			var cmLabel5 = paper.text(centerP.x, centerP.y, "0cm").attr(defaultFontStyle);
			var grid1 = paper.path("M" + (centerP.x - width) + " " + centerP.y + "l" + (width * 2) + " 0M" + centerP.x + " " +  centerP.y + "l0 -" + width + " M" + centerP.x + " " +  centerP.y + "l" + (Math.sin(Math.PI-(45*Math.PI/180)) * width) + " " + (Math.cos(Math.PI-(45*Math.PI/180)) * width) + "M" + centerP.x + " " +  centerP.y + "l" + (Math.sin(Math.PI-(-45*Math.PI/180)) * width) + " " + (Math.cos(Math.PI-(-45*Math.PI/180)) * width)).attr(gridStyle);
			
			// Logic _______________________________________________
			
			function getPointAt(center, radius, angle) {
				angle *= Math.PI / 180;
				return {x: center.x + Math.sin(Math.PI - angle) * radius,
						y: center.y + Math.cos(Math.PI - angle) * radius};
			}

			function draw(distance, angle) {
				
				var lastPos;

				pos.push(distance);
				
				if(angle == minAngle) {
					drawPath = "";
					high = 0;
					pos = [];
					curve = paper.path(drawPath.substr(0, drawPath.indexOf("l"))).attr({
						"stroke-width": 1,
						"stroke": "#fbb03b",
						"fill": "#fbb03b",
						"fill-opacity": 0.45
					});
					radar.attr({transform: "r-90," + centerP.x + "," + centerP.y})
				}

				for(var i = 0; i < pos.length; i++) {
					var d, p, path, nx, ny;
					
					// Remove last points
					drawPath = drawPath.substr(0, drawPath.lastIndexOf("l"));
					
					p = (pos[i])?((pos[i]/maxDistance) * width):0;
					p = (p > width)?width:p;
					a = (i * detectAngle) - 90;
					pointZero = {x:0,y:0};
					d = getPointAt(pointZero, p, a);
					d2 = getPointAt(pointZero, p, a + detectAngle);
					
					if(i == 0) {
						drawPath = "M" + centerP.x + " " + centerP.y + "l" + d.x + " " + d.y + "l" + (d2.x - d.x) + " " + (d2.y - d.y);						
					} else {
						nx = (d.x - lastPos.x);
						ny = (d.y - lastPos.y);
						drawPath += "l" + nx + " " + ny  + "l" + (d2.x - d.x) + " " + (d2.y - d.y);
					}
					
					// Close the path
					d = getPointAt(pointZero, 0, a);
					drawPath += "l" + (d.x - d2.x) + " " + (d.y - d2.y);
					
					lastPos = {x: d2.x, y: d2.y};
				}

				// Radar animation
				radar.animate({transform: "r" + angle + "," + centerP.x + "," + centerP.y}, duration);
				
				var lastPath = drawPath;
				var lastPath1 = drawPath.substr(0, drawPath.lastIndexOf("l"));
				var lastPath2 = drawPath.substr(0, lastPath1.lastIndexOf("l"));
				curve.attr({path: lastPath2}).animate({path: lastPath1}, duration, function() {
					this.attr({path: lastPath});
				});
				
				// Last step
				if(angle >= maxAngle) {
					curve.animate({opacity: 0}, duration * 4, function() {
						this.remove();
					});
				}
				
				stats.update();
			}
			
		/*----------------------------Temporary ----------------------*/
			var angle = minAngle;
			
			function loop() {
				setTimeout(function() {
					var d, r;
					
					if(angle > maxAngle) {
						angle = minAngle;
					}

					d = ~~(Math.random() * 100) + 10;
					//d = 50;
					draw(d, angle);
					angle += 10;
					loop();
				}, 350);
			}
			
			loop();
	/*----------------------- Temporary --------------------------*/
			
	/* SOCKET ON
	          socket.on("message", function(data) {
				var d, r;
				data = eval("(" + data + ")");
				d = data.d;
				r = (180 - data.r) - 90;
				
				draw(d, r);
			});
	
	*/

                
		})();
	/* </script>  */
	
