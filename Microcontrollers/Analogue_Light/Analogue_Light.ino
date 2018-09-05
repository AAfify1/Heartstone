#include <ESP8266WiFi.h> 
#include <SPI.h>

#define LDR_PIN A0

int light = 0;
int lightIntensity;
const char* ssid = "KeySurf_807d33";
const char* password = "pgmxspuc";
WiFiClient client; 

void setup() {

Serial.begin(9600);
connectWifi();
}

void loop() {
  
  readlight();
  POST();
  delay(1000);
}

void readlight()
{
    Serial.println("light:"+light);
  Serial.println("1");

  light = analogRead(LDR_PIN);
  lightIntensity = Intensity(light);
  Serial.println("light:"+light);
  Serial.println("light Intensity"+lightIntensity);
}
int Intensity( int c)
{ int Intensity = 0;
  if( c >= 1 && c <= 100)
  {
    Intensity=5;
  }

  else if ( c > 100 && c <= 200)
  {
    Intensity = 4;
  }
  else if ( c > 200 && c <= 300)
  {
    Intensity = 3;
  }
  else if ( c > 300 && c <= 400)
  {
    Intensity = 2;
  }

  else if ( c > 400)
  {
    Intensity = 1;
  }
  else Intensity =0;
  return Intensity;
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
  
   String lightStr= String(light);
    String lightIntensityStr= String(lightIntensity);
    String postString = "light="+lightStr  + "&lightIntensity="+lightIntensityStr 
    + "&roomNo=" + roomNo;
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
  client.println("POST /light.php HTTP/1.1");
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
    String line = client.readStringUntil('^');
    Serial.print(line);
  }
  Serial.println();
  Serial.println("closing connection");
}

