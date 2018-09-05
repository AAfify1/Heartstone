#include <ESP8266WiFi.h>
#include <SPI.h>
#define temperature 14
#define motion 13
#define noise 15
#define light 16
#define buzzer 12

const char* ssid = "KeySurf_807d33";
const char* password = "pgmxspuc";
const char* host = "51.140.5.197";
String light1;
String light2;
String light3;
String light4;
bool state1;
bool state2;
bool state3;
bool state4;

String response = "";
char character;
WiFiClient client;

void setup() {

  pinMode(temperature, OUTPUT);
  pinMode(motion, OUTPUT);
  pinMode(light, OUTPUT);
  pinMode(noise, OUTPUT);
  pinMode(buzzer, OUTPUT);
  digitalWrite(buzzer, LOW);
  digitalWrite(temperature, LOW);
  digitalWrite(motion, LOW);
  digitalWrite(noise, LOW);
  digitalWrite(light, LOW);

  Serial.begin(9600);

  connectWifi();
}

void loop() {
  getData();
  controlLights();
  delay(1000);
}
void getData() {

  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    connectWifi();
    return;
  }

  client.println("GET /indicators.php HTTP/1.1");
  client.println("Host: 51.140.5.197");
  client.println("Connection: keep-alive");
  client.println();

  delay(100);


  response = client.readStringUntil('^');



  light1 = response.substring(101, 102);
  light2 = response.substring(105, 106);
  light3 = response.substring(109, 110);
  light4 = response.substring(113, 114);
wha
  return;

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

void controlLight1()
{

  if (!state1) {

    if (light1.equals("A"))
    {
      digitalWrite(temperature, HIGH);
      Serial.println("Turning on Light 1");
      beep(2, 1000, 1);
      state1 = true;
    }
  }
  else if (light1.equals("B"))
  {
    digitalWrite(temperature, LOW);
    Serial.println("Turning off Light 1");
    state1 = false;
  }
}

void controlLight2()
{
  if (!state2) {

    if (light2.equals("A"))
    {
      digitalWrite(motion, HIGH);
      Serial.println("Turning on Light 2");
      beep(2, 1000, 1);
      state2 = true;
    }
  }
  else if (light2.equals("B"))
  {
    digitalWrite(motion, LOW);
    Serial.println("Turning off Light 2");
    state2 = false;
  }
}
void controlLight3()
{
  if (!state3)
  {
    if (light3.equals("A"))
    {
      digitalWrite(noise, HIGH);
      Serial.println("Turning on Light 3");
      beep(2, 1000, 3);
      state3 = true;

    }
  }
  else  if (light3.equals("B")) {
    digitalWrite(noise, LOW);
    Serial.println("Turning off Light 3");
    state3 = false;
  }
}
void controlLight4()
{
  if (!state4)
  {
    if (light4.equals("A"))
    {
      digitalWrite(light, HIGH);
      Serial.println("Turning on Light 4");
      beep(2, 1000, 4);
      state4 = true;

    }
  }
  else if (light4.equals("B"))
  {
    digitalWrite(light, LOW);
    Serial.println("Turning off Light 4");
    state4 = false;
  }
}

void beep(int beeps, int interval, int srrc) {
  for (int i = 0; i < beeps; i++) {
    digitalWrite(buzzer, HIGH);
    Serial.println("on" + srrc);
    delay(interval);
    digitalWrite(buzzer, LOW);
    delay(interval);
    Serial.println("off" + srrc);
  }
}

void controlLights()
{
  controlLight1();
  controlLight2();
  controlLight3();
  controlLight4();
}
