#include <DHT.h>
#include <ESP8266WiFi.h> 
#include <SPI.h>
#define DHTPIN 2
#define DHTTYPE DHT11
const char* ssid = "KeySurf_807d33";
const char* password = "pgmxspuc";
const char* host = "51.140.5.197";
char value[4];
float h;
float t;
String temp;
String hum;
int roomNo = 1;
DHT dht(DHTPIN, DHTTYPE);
WiFiClient client;


void setup() {

Serial.begin(9600);
connectWifi();
dht.begin();

}

void loop() {

  //readin data from the sensor
  readData();

  //printing data
  printData();

  //posting data
  POST();
  
  // controlling the data interval
  delay(60000);

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

 void readData()
 {
   h = dht.readHumidity();
   t = dht.readTemperature();
  
  
  dtostrf(t, 5, 2, value);  //coverting float to string
  for(int i=0;i<sizeof(value);i++)
  {
    temp+=value[i];
  }

  dtostrf(h, 4, 4, value);
  for(int i=0;i<sizeof(value);i++)
  {
    hum+=value[i];
  }
 }
 void printData(){  
  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.println(" *C ");
}
void POST()
{
  
   if( !temp.equals("nan") && !hum.equals("nan"))
   {
    String postString = "temp="+temp + "&hum=" + hum + "&roomNo=" + roomNo;
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
  client.println("POST /temphum.php HTTP/1.1");
  client.println("Host: 51.140.5.197 ");
  client.println("Content-Type: application/x-www-form-urlencoded");
  client.println("Connection: keep-alive");
  client.print("Content-Length: ");
  client.println(postStringLength);
  client.println();
  client.print(postString);
  client.println();
  Serial.println("Posted:  "+postString);
  temp="";
  hum="";
   
  
  
  // Read all the lines of the reply from server and print them to Serial
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  Serial.println();
  Serial.println("closing connection");
   }
  else Serial.println("no data");
}



