/*

// Xentrino Bot V1.1
// Christopher M. Coballes
 */

#include <aJSON.h>
#include <stdio.h>
#include <SPI.h>         // needed for Arduino versions later than 0018
#include <Ethernet.h>
#include <EthernetUdp.h>         // UDP library from: bjoern@cs.stanford.edu 12/30/2008
#define UDP_TX_PACKET_MAX_SIZEX 27 

/*
  // will try the same pin
  //int myEraser = 7;             // this is 111 in binary and is used as an eraser
  // TCCR2B &= ~myEraser;   // this operation (AND plus NOT),  set the three bits in TCCR2B to 0
  //int myPrescaler = 3;         // this could be a number in [1 , 6]. In this case, 3 corresponds in binary to 011.   
  //TCCR2B |= myPrescaler;  //this operation (OR), replaces the last three bits in TCCR2B with our new value 011

 * 
 */
 /*
int wd_pin   = 11; // this should be connected to both driver
int m1_dir   = 12;
int m1_speed = 9;
int m2_dir   = 10;
int m2_speed = 8;
int speed_pwr;   */

int wd_pin   = 3; // this should be connected to both driver
int m1_dir   = 2;
int m1_speed = 6;
int m2_dir   = 5;
int m2_speed = 7;
int speed_pwr;

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFD, 0xDD  };
IPAddress ip(192, 168, 8, 104);
unsigned int localPort = 5555;      // local port to listen on

// buffers for receiving and sending data
char packetBuffer[47];  //buffer to hold incoming packet,
// An EthernetUDP instance to let us send and receive packets over UDP
EthernetUDP Udp;

void setup() {
 Serial.begin(115200);
   // start the Ethernet and UDP:
  
  Ethernet.begin(mac, ip);
  Udp.begin(localPort);

  pinMode(wd_pin, OUTPUT);
  pinMode(m1_dir, OUTPUT);
  pinMode(m1_speed, OUTPUT);
  pinMode(m2_dir, OUTPUT);
  pinMode(m2_speed, OUTPUT); 
  //TCCR2B = TCCR2B & 0b11111000 | 0x07; this is for UNO 
  TCCR1B = TCCR1B & 0b11111000 | 0x05; // this is for Arduino Mega to generate 30.60hz
 
  analogWrite(wd_pin,10); 
 //  digitalWrite(led13,LOW); 
 Serial.println("Initialize");
}


//Forward
void Forward(int speed_pwr)
{
 // sendUDP();
  analogWrite(m1_speed,speed_pwr);
  digitalWrite(m1_dir,HIGH);
  analogWrite(m2_speed,speed_pwr);
  digitalWrite(m2_dir,HIGH);
  //digitalWrite(led13,HIGH);
}
//Backward
void Backward(int speed_pwr)
{
 analogWrite(wd_pin,10);
 analogWrite(m1_speed,speed_pwr);
 digitalWrite(m1_dir,LOW);
 analogWrite(m2_speed,speed_pwr);
 digitalWrite(m2_dir,LOW);
// digitalWrite(led13,LOW);

}


//stop
void Stop(int speed_pwr)
{ 
  delay(50);
 analogWrite(m1_speed,speed_pwr);
 analogWrite(m2_speed,speed_pwr);
 //digitalWrite(led13,LOW);
}
//Left
void Left(int speed_pwr)
{ 
    int cal_speed;
  cal_speed = speed_pwr + 25;
 analogWrite(wd_pin,10);
 analogWrite(m1_speed,cal_speed);
 digitalWrite(m1_dir,HIGH);
 analogWrite(m2_speed,0);
 digitalWrite(m2_dir,LOW);
 // digitalWrite(led13,LOW);
}

//Turn Left
void turnLeft(int speed_pwr)
{
 // int cal_speed;
 // cal_speed = speed_pwr -15;
 analogWrite(wd_pin,10);
 analogWrite(m1_speed,150);
 digitalWrite(m1_dir,HIGH);
 analogWrite(m2_speed,180);
 digitalWrite(m2_dir,LOW);
}

//Right
void Right(int speed_pwr)
{
 // int cal_speed;
 // cal_speed = speed_pwr -24;
 analogWrite(wd_pin,10);
 analogWrite(m1_speed,0);
 digitalWrite(m1_dir,LOW);
 analogWrite(m2_speed,speed_pwr);
 digitalWrite(m2_dir,HIGH);

}

//Turn Right
void turnRight(int speed_pwr)
{
 // int cal_speed;
  //cal_speed = speed_pwr -15;
 analogWrite(wd_pin,10);
 analogWrite(m1_speed,150);
 digitalWrite(m1_dir,LOW);
 analogWrite(m2_speed,180);
 digitalWrite(m2_dir,HIGH);

}
void loop() {
 // String str;
  int   i;
  char  dmy[8];
//  char  nl = 10; 
 // char  buf[256];
  //char  ReplyBuffer[256];
  int   power_num;
  aJsonObject* jsonObject=NULL ;
  aJsonObject* name=NULL;
  aJsonObject* power=NULL;
  char *jsonStr;
  
  //Serial.println("RIGHT");
  int packetSize = Udp.parsePacket(); // if there's data available, read a packet
  if (packetSize) {

      Udp.read(packetBuffer,sizeof(packetBuffer)); //  read the packet into packetBufffer
      Udp.beginPacket(Udp.remoteIP(), Udp.remotePort());
     
        Udp.print(packetBuffer);
        Serial.println(packetBuffer);
        Udp.endPacket();   
      }
    /* refresh packetBuffer */
       //  packetBuffer[0]="\n";
 
  jsonObject = aJson.parse(packetBuffer);
  if(jsonObject != NULL ){
       name = aJson.getObjectItem(jsonObject, "CTL");
       power = aJson.getObjectItem(jsonObject, "PWR");
       power_num = atoi(power->valuestring); // convert to integer
       strcpy(dmy, name->valuestring); // copy in the memory      
       aJson.deleteItem(jsonObject);
      }
        
  if(strcmp(dmy, "RGT") == 0){
    Right(power_num );
  }
  if(strcmp(dmy, "LFT") == 0){
    Left(power_num);
  }
  if(strcmp(dmy, "FWD") == 0){
    Forward( power_num);
  }
  if(strcmp(dmy, "TLT") == 0){
    turnLeft(power_num);
  }
   if(strcmp(dmy, "TRT") == 0){
    turnRight(power_num);
  }
  if(strcmp(dmy, "BWD") == 0){
    Backward(power_num);
  }
  if(strcmp(dmy, "STP") == 0){
    Stop(0);
  }  
  
}

