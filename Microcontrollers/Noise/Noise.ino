#include <ESP8266WiFi.h> 
#include <SPI.h>

#define MIC_PIN A0

int noise = 0;
int noiseLevel;
const char* ssid = "KeySurf_807d33";
const char* password = "pgmxspuc";
WiFiClient client; 

void setup() {

Serial.begin(9600);
connectWifi();
}

void loop() {
  
  readNoise();
  POST();
  delay(1000);
}

void readNoise()
{
    Serial.println("noise:"+noise);
  Serial.println("1");

  noise = analogRead(MIC_PIN);
  noiseLevel = level(noise);
  Serial.println("noise:"+noise);
  Serial.println("noise level"+noiseLevel);
}
int level( int c)
{ int level = 0;
  if( c >= 1 && c <= 100)
  {
    level=5;
  }

  else if ( c > 100 && c <= 200)
  {
    level = 4;
  }
  else if ( c > 200 && c <= 300)
  {
    level = 3;
  }
  else if ( c > 300 && c <= 400)
  {
    level = 2;
  }

  else if ( c > 400)
  {
    level = 1;
  }
  else level =0;
  return level;
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
  
   String noiseStr= String(noise);
    String noiseLevelStr= String(noiseLevel);
    String postString = "noise="+noiseStr  + "&noiseLevel="+noiseLevelStr + "&roomNo=" + roomNo;
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
  client.println("POST /noise.php HTTP/1.1");
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

