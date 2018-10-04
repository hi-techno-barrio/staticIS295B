
      var display = new SegmentDisplay("display7");
        display.pattern         = "##:##:##";
        display.displayAngle    = 6;
        display.digitHeight     = 30;
        display.digitWidth      = 14;
        display.digitDistance   = 2.5;
        display.segmentWidth    = 2;
        display.segmentDistance = 0.3;
        display.segmentCount    = 7;
        display.cornerType      = 3;
        display.colorOn         = "#e95d0f";
        display.colorOff        = "#4b1e05";
        display.draw();

         animate();

      function animate() {
        var time    = new Date();
        var hours   = time.getHours();
        var minutes = time.getMinutes();
        var seconds = time.getSeconds();
        var value   = ((hours < 10) ? ' ' : '') + hours
                    + ':' + ((minutes < 10) ? '0' : '') + minutes
                    + ':' + ((seconds < 10) ? '0' : '') + seconds;
        display.setValue(value);
        window.setTimeout('animate()', 100);
      }

