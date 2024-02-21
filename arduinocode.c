#include <WiFi.h>
#include <HTTPClient.h>
#define RXp2 16
#define TXp2 17
#define WIFI_SSID "Dan iPhone"
#define WIFI_PASSWORD "hello123"

String prestate;
String state="OFF";
int var1=1;
int count=10;
unsigned long counttime=0;
float powerused=0;
unsigned long StartTime;

void setup() {
  Serial.begin(115200);
  Serial2.begin(9600, SERIAL_8N1, RXp2, TXp2);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.println("starting");
}
bool isConnected = false;
void loop() {
  if (WiFi.status() == WL_CONNECTED && !isConnected) {
    Serial.println("Connected");
    isConnected = true;
  }
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println(".");
    isConnected = false;
  }
  Serial.println("Message Received: ");
  var1= Serial2.parseInt();
  count= Serial2.parseInt();
  Serial.println("state:"+String(var1));
  Serial.println("time:"+String(count));
  powerused = (count/60)*5; 
   if(var1 == 0){
      state = "OFF";
     }
   if(var1==1){
      state = "ON";
      StartTime = millis();
      counttime += (millis()-StartTime);
      Serial.println("counter"+String(counttime));
     }
  if(state != prestate){
        sendFirstRequest();
        sendSecondRequest();
  }
  else{
       sendSecondRequest();
   }
   delay(60000);
   prestate = state;
}
void sendFirstRequest() {
String	url	=	 "http://smarthomesystemproject.atwebpages.com/insert_data.php?key=smarthomesystemproject&state=ON";
  HTTPClient http;
  Serial.print("Sending first request to ");
  Serial.println(url);
  // Send the HTTP GET request
  http.begin(url);
  int httpResponseCode = http.GET();
  // Check for errors
  if (httpResponseCode > 0) {
    Serial.print("First request success, response code: ");
    Serial.println(httpResponseCode);
  } else {
    Serial.print("First request failed, error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
  http.end();
}
void sendSecondRequest() {
String	url	= "http://smarthomesystemproject.atwebpages.com/insert_data2.php?key=smarthomesystemproject&time="+String(count)+"&powerused="+String(powerused);
  HTTPClient http;
  Serial.print("Sending second request to ");
  Serial.println(url);
  // Send the HTTP GET request
  http.begin(url);
  int httpResponseCode = http.GET();
  // Check for errors
  if (httpResponseCode > 0) {
    Serial.print("Second request success, response code: ");
    Serial.println(httpResponseCode);
  } else {
    Serial.print("Second request failed, error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
 http.end();
}
