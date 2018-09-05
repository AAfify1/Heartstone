#include <ESP8266WiFi.h> 
#include <SPI.h>

#define inputPin 13               
int prevState = LOW;             
int motion = 0;  // variable for reading the pin status
int motionCounter=0;
unsigned long interval = 60000L;
int counter=0;
const char* ssid = "KeySurf_807d33";
const char* password = "pgmxspuc";

WiFiClient client; 

void setup() {
  Serial.begin(9600);
  connectWifi();
  pinMode(inputPin, INPUT);     // declare sensor as input
  
}
 
void loop(){
 
 
recordMotion();
Serial.println(motionCounter);
POST();
motionCounter=0;

}

void recordMotion()
{

  unsigned long startTime = millis();
 
  while( (millis()-startTime) < interval)
  {
  motion = digitalRead(inputPin);
  
  if (motion == HIGH) {            
  
    if (prevState == LOW) {
      Serial.println("Motion detected!");
      prevState = HIGH;
      motionCounter++;
      delay(3000);
    }
  } else {
    
    if (prevState == HIGH){
      Serial.println("Motion ended!");
      prevState = LOW;
      delay(1000);
    }
  }
  
  }
 
}
void connectWifi()
{


Serial.print("Connecting to ");
Serial.println(ssid);
WiFi.begin(ssid, password);

while (WiFi.status() != WL_CONNECTED) { // while not connected
  delay(500);
  Serial.print("."); //prints a dot every half second
  }

Serial.println("");
Serial.println("WiFi connected");
}
void POST()
{
int roomNo = 1;

const char* host = "51.140.5.197";
  
   String motionStr= String(motionCounter);
    String postString = "motion="+motionStr  + "&roomNo=" + roomNo;
    String postStringLength = String(postString.length(), DEC);
    
    Serial.print("Connecting to Server: ");
    
    WiFiClient client;
    const int httpPort = 80;
    
    if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    connectWifi();
    return;
    }

  Serial.println("connected");
  client.println("POST /motion.php HTTP/1.1");
  client.println("Host: 51.140.5.197 ");
  client.println("Content-Type: application/x-www-form-urlencoded");
  client.println("Connection: keep-alive");
  client.print("Content-Length: ");
  client.println(postStringLength);
  client.println();
  client.print(postString);
  client.println();
  Serial.println("Posted:  "+postString);
 
   
  
  
  // Read all the lines of the reply from server and print them to Serial
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  Serial.println();
  Serial.println("closing connection");
   

}

