/*
 Hi-Techno Barrio
 Author: E^3
 The said sketch is able to communicate host pc using UDP protocol and json parsing.
 ALthough much care was done using this program and was personally tested by the author
 however you may use it as is and  at your own risk.
 * ARDUINO DUE
 * 
 */

#include <Wire.h>
#include  <stdlib.h> 
#include <Arduino.h>
#include <SPI.h>
#include <Ethernet.h>
#include <EthernetUdp.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_HMC5883_U.h>
#include <SimpleDHT.h>

//String jsonString;
/* Assign a unique ID to this sensor at the same time */
Adafruit_HMC5883_Unified mag = Adafruit_HMC5883_Unified(12345);

#include "A4988.h"
// Motor steps per revolution. Most steppers are 200 steps or 1.8 degrees/step
String jsonString ;
int lightPin= A0;
int smokePin= A1;
int noisePin= A2;
int dustPin = A5; // dust sensor - Arduino A0 pin
int ledDust = 48;  

int trigPin1 = 38;
int echoPin1 = 39;

int trigPin2 = 40;
int echoPin2 = 41;

int trigPin3 = 42;
int echoPin3 = 43;

int trigPin4 = 44;
int echoPin4 = 45;

int trigPin5 = 46;
int echoPin5 = 47;


#define MOTOR_STEPS 200
// All the wires needed for full functionality
#define DIR 8
#define STEP 9
//#define ENBL 10

// microstep control for A4988
 #define MS1 10
 #define MS2 11
 #define MS3 12
 A4988 stepper(MOTOR_STEPS, DIR, STEP, MS1, MS2, MS3);
 
int sensorValue= 0;
int pinDHT11 = 2;
SimpleDHT11 dht11;
  
// Record any errors that may occur in the compass.
int error = 0;
float previousDeg;
float headingDegrees;
float diffDeg;
//char inByte;


/* Variable for DUST! */
float voMeasured = 0;
float calcVoltage = 0;
float dustDensity = 0;


EthernetUDP Udp;

byte arduinoMac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xEF, 0xED };
IPAddress arduinoIP(192, 168, 8, 110); // desired IP for Arduino
unsigned int arduinoPort = 7777;      // port of Arduino

IPAddress receiverIP(192, 168 ,8, 100); // IP of udp packets receiver
unsigned int receiverPort = 3333;      // port to listen on my PC


void setup() {
  
   Serial.begin(115200);
   Serial1.begin(19200);
   initLidar();
   Ethernet.begin(arduinoMac,arduinoIP);
   Udp.begin(arduinoPort);
  
   pinMode(trigPin1, OUTPUT);
   pinMode(echoPin1, INPUT);
   pinMode(trigPin2, OUTPUT);
   pinMode(echoPin2, INPUT);
   pinMode(trigPin3, OUTPUT);
   pinMode(echoPin3, INPUT);
   pinMode(trigPin4, OUTPUT);
   pinMode(echoPin4, INPUT);
   pinMode(trigPin5, OUTPUT);
   pinMode(echoPin5, INPUT);

 /* Initialise the sensor */
  if(!mag.begin())
  {
    /* There was a problem detecting the HMC5883 ... check your connections */
   // Serial.println(" no HMC5883 detected!");
  }
      
} //setup


/**********************    DISTANCE FOR ULTRASONICE SENSORS      ***************************************/
/* DISTANCE 1 */
float range1(){ // This function is for first sensor.
     int duration1;
     float distance1;
       digitalWrite (trigPin1, LOW);
       delayMicroseconds (2);
       digitalWrite (trigPin1, HIGH);
       delayMicroseconds (5);
       digitalWrite(trigPin1, LOW);
       duration1 = pulseIn (echoPin1, HIGH);
       distance1 = (duration1/200) / 29.1;
     return distance1;
     
}

/* DISTANCE 2 */
float range2(){ // This function is for second sensor.
       int duration2;
      float distance2;
       digitalWrite (trigPin2, LOW);
       delayMicroseconds (2);
       digitalWrite (trigPin2, HIGH);
       delayMicroseconds (5);
       digitalWrite(trigPin2, LOW);
       duration2 = pulseIn (echoPin2, HIGH);
       distance2 = (duration2/200.00) / 29.1;

     return distance2;
}
 


/* DISTANCE 3 */
float range3(){ // This function is for third sensor.
      int duration3;
      float distance3;
       digitalWrite (trigPin3, LOW);
       delayMicroseconds (2);
       digitalWrite (trigPin3, HIGH);
       delayMicroseconds (5);
       digitalWrite(trigPin3, LOW);
       duration3 = pulseIn (echoPin3, HIGH);
       distance3 = (duration3/200) / 29.1;

     return distance3;
}

/* DISTANCE 4 */
float range4(){ // This function is for third sensor.
     int duration4;
     float distance4;
       digitalWrite (trigPin4, LOW);
       delayMicroseconds (2);
       digitalWrite (trigPin4, HIGH);
       delayMicroseconds (5);
       digitalWrite(trigPin4, LOW);
       duration4 = pulseIn (echoPin4, HIGH);
       distance4 = (duration4/200) / 29.1;

     return distance4;
}

/* HEIGHT  */
float sensorHeight(){ // This function is for third sensor.
     int duration5;
     float distance5;
       digitalWrite (trigPin5, LOW);
       delayMicroseconds (2);
       digitalWrite (trigPin5, HIGH);
       delayMicroseconds (5);
       digitalWrite(trigPin5, LOW);
       duration5 = pulseIn (echoPin5, HIGH);
       distance5 = (duration5/200) / 29.1;

     return distance5;
}

/* HEADING MAGNEMOMETER */
int sensorTemperature()
{
// read without samples.
  byte temperature = 0;
  byte humidity = 0;
  if (dht11.read(pinDHT11, &temperature, &humidity, NULL)) {
    Serial.print("Read DHT11 failed.");
  }
  return temperature;
}

/* HEADING MAGNEMOMETER */
int sensorHumidity()
{
// read without samples.
  byte temperature = 0;
  byte humidity = 0;
  if (dht11.read(pinDHT11, &temperature, &humidity, NULL)) {
    Serial.print("Read DHT11 failed.");

  }
  return humidity;
}

/* HEADING MAGNEMOMETER */
float sensorDust()
{
  digitalWrite(ledDust,LOW); // power on the LED
  delayMicroseconds(280);
  
  voMeasured = analogRead(dustPin); // read the dust value
  
  delayMicroseconds(40);
  digitalWrite(ledDust,HIGH); // turn the LED off pwede ito sa bakante
  delayMicroseconds(10);
  // 0 - 5V mapped to 0 - 1023 integer values
  // recover voltage
  calcVoltage = voMeasured * (5.0 / 1024.0);
  dustDensity = 0.17 * calcVoltage - 0.1;

  return dustDensity;
  }
  
/* HEADING MAGNEMOMETER */
int sensorLight()
  {
    
  sensorValue = analogRead(lightPin); // read the value from the sensor
    delay(5);
  return sensorValue; //prints the values coming from the sensor on the screen

    }
    
/* HEADING MAGNEMOMETER */
int sensorSmoke()
  {
     sensorValue = analogRead(smokePin); // read the value from the sensor
    delay(5);
    return sensorValue; //prints the values coming from the sensor on the screen
    }
    
/* HEADING MAGNEMOMETER */    
 int sensorNoise()
  {
     sensorValue = analogRead(noisePin); // read the value from the sensor
     delay(5);
     return sensorValue; //prints the values coming from the sensor on the screen
    }
    
/* HEADING MAGNEMOMETER */
float headingMark()
{
  /* Get a new sensor event */ 
  sensors_event_t event; 
  mag.getEvent(&event);
 
  // Calculate heading when the magnetometer is level, then correct for signs of axis.
  float heading = atan2(event.magnetic.y, event.magnetic.x);
  // Once you have your heading, you must then add your 'Declination Angle', which is the 'Error' of the magnetic field in your location.
  // Find yours here: http://www.magnetic-declination.com/
  // Mine is: -13* 2' W, which is ~13 Degrees, or (which we need) 0.22 radians
  // If you cannot find your Declination, comment out these two lines, your compass will be slightly off.
  //float declinationAngle = 0.22;
  
   float declinationAngle = -0.035;
    heading += declinationAngle;
  
  // Correct for when signs are reversed.
  if(heading < 0)
    heading += 2*PI;
    
  // Check for wrap due to addition of declination.
  if(heading > 2*PI)
    heading -= 2*PI;
   
  // Convert radians to degrees for readability.
  return  heading * 180/M_PI; 
 // return 7.7;
}

/*  MECHANICAL  COMPASS MOTOR MOVEMENT */
float compassMotor(float degree)
{ 
    diffDeg =  degree - previousDeg;  //presentDeg; 
    previousDeg = degree;
  //  driveMotor(2,110,diffDeg,20);
    return diffDeg;
    //return 10.5;
}

/*--------------------MOTOR ----------------*/
void driveMotor(int stp,int rpm, int rot, int t )
{
  stepper.setRPM(rpm);
  stepper.setMicrostep(stp);
  stepper.rotate(rot);
  delay (t);
}

/*   INITIALIZE LIDAR    */
void initLidar()
{
    // set the data rate for the SoftwareSerial port
    Serial1.println("O");
    delay(5);
}

/*    LIDAR DATA  */
String lidarData()
{
 String inString,strDistance; ;
 char inByte;
  int i;
   inString="";
   strDistance="";
         i=0;
        Serial1.write('D');
        while(Serial1.available() > 0)
           {  
         inByte = Serial1.read();
            if ((inByte!='D')&&(inByte!= NULL)&&(inByte!=':')&&(inByte!=',')&&(inByte!='m')&&(inByte!='"'))
              {
               inString += inByte;
               }// limit
           }//while 
           
           
           strDistance = inString.substring(0,5);
           if (strDistance == "OK!")
             {
              strDistance = "Start";
             }
             return  strDistance;
}          

  String stringPackage()
  {
   
    
   jsonString = "{\"light\":\"";
    jsonString += sensorLight();
    jsonString +="\",\"noise\":\"";
    jsonString += sensorNoise();   
    jsonString +="\",\"smoke\":\"";
    jsonString += sensorSmoke();
   
    jsonString +="\",\"distance1\":\"";
    jsonString += range1();
    
    jsonString +="\",\"distance2\":\"";
    jsonString += range2();

    jsonString +="\",\"distance3\":\"";
    jsonString += range3();
    
    jsonString +="\",\"distance4\":\"";
    jsonString += range4();
    
    jsonString +="\",\"height\":\"";
    jsonString += sensorHeight();
    
    //jsonString +="\",\"humidity\":\"";
    //jsonString += sensorHumidity();
   // jsonString +="\",\"temperature\":\"";
  //  jsonString += sensorTemperature();
   // jsonString +="\",\"dust\":\"";
   // jsonString += sensorDust();

  //  jsonString +="\",\"lidar\":\"";
  //  jsonString += lidarData(); 
    
  //  jsonString +="\",\"heading\":\"";
  //  jsonString +=  headingMark();
   // jsonString +="\",\"compass\":\"";
  //  jsonString += compassMotor( headingMark()); 
    
    jsonString +="\"}";

    return jsonString;
  }
void loop() {

   Serial.println(stringPackage());
    Udp.beginPacket(receiverIP, receiverIP); //start udp packet
    Udp.print(stringPackage()); //write sensor data to udp packet
    Udp.endPacket(); // end packet
  //jsonString="";

}
