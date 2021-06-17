/*
                 Connection between RFID reader and ESP8266
  RST/Reset=>D3
  SPI SS=>D8
  SPI MOSI=>D7
  SPI MISO=>D6
  SPI SCK=>D5
*/

#include <Wire.h>
#include <MFRC522.h>
#include <SPI.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <Adafruit_MLX90614.h>

#define RST_PIN D3 // RST-PIN for RC522 - RFID - SPI - Module GPIO15 
#define SS_PIN  D8  // SDA-PIN for RC522 - RFID - SPI - Module GPIO2
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

#define RedLed 1 // Red pin of LED
#define GreenLed D4 // Green pin of LED
#define BlueLed D0 // Blue pin of LED

//Wireless name and password
const char* ssid     = "Wide Putin"; // replace with you wireless network name
const char* password = "01000101"; //replace with you wireless network password

// Remote site information
const char* host = "148.251.15.228"; // IP address of your local server or web domain
String url = "http://temperaturelog.altervista.org/website/lettura.php"; // folder location of the txt file with the RFID cards identification 

int time_buffer = 5000; // amount of time in miliseconds that the relay will remain open

#define MLX90614_I2C   0x5A // MLX90614 I2C address (Temperature sensor)

Adafruit_MLX90614 mlx = Adafruit_MLX90614(MLX90614_I2C); // Initialize MLX90614 object

void setup() {

  pinMode(RedLed, FUNCTION_3); // swap the TX pin to a GPIO pin
  pinMode(BlueLed, OUTPUT);
  pinMode(GreenLed, OUTPUT);
  pinMode(RedLed, OUTPUT);
  digitalWrite(BlueLed, 1);
  Serial.begin(115200);    // Initialize serial communications
  SPI.begin();           // Init SPI bus
  mfrc522.PCD_Init();    // Init MFRC522

  // We start by connecting to a WiFi network

  Serial.println("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(2500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  delay(3000);
}

void loop() {
  leds_off();
  int authorized_flag = 0;
  int measurement_flag = 0;
  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    delay(50);
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  ////-------------------------------------------------RFID----------------------------------------------


  // Shows the card ID on the serial console
  float temperature = 0; // temperature registered
  String content = ""; // RFID card code
  for (byte i = 0; i < mfrc522.uid.size; i++)
  {
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  Serial.println();
  //content.toUpperCase();
  Serial.println("Cart read:" + content);

  ////-------------------------------------------------SERVER----------------------------------------------


  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  //Serial.println("ok 1");
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    //Serial.println("ok 2");
    Serial.println("connection failed");
    reject(10000);
    return;
  }
  //Serial.println("ok 2");
  if (client.connect(host, httpPort)) {
    //Serial.println("ok 3");
    url = "http://temperaturelog.altervista.org/website/lettura.php"; //folder location where is located the php file "lettura.php"
    url += "?codice=" + String(content);
    Serial.println("Connected with " + url);
    // This will send the request to the server
    // This will send the request to the server
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    connectweb(5);
    leds_off();

    // Read all the lines of the reply from server and print them to Serial

    while (client.available()) {
      String line = client.readStringUntil('\r');
      //Serial.print(line); //DEBUG
      if (line.indexOf(content) > 0) {
        authorized_flag = 1;
      }

      if (line == content) {
        authorized_flag = 1;
      }
    }

    if (authorized_flag == 1) {
      Serial.println("AUTHORIZED\n");
      authorize(200);
      delay(500);

      ////-------------------------------------------------TEMPERATURE----------------------------------------------

      mlx.begin();
      int counter = 0;
      for (int i = 0; i < 2; i++) {
        leds_on(255, 255, 0);
        delay(80);
        leds_off();
        delay(80);
      }
      delay(500);
      for (counter = 0; counter <= 10; counter = counter) {
        temperature = (mlx.readObjectTempC() + 7);
        Serial.print("temperature object: ");
        Serial.print(temperature);
        Serial.println("°C");
        measurement(1);
        counter = counter + 1;
        
        if (temperature >= 35.5) {
          break;
        }
      }
      if (temperature < 35.5) {
        measurement_flag = 0;
      }
      if (temperature > 41) {
        measurement_flag = 0;
      }
      else {
        measurement_flag = 1;
      }
    }
    else {
      Serial.println("NOT AUTHORIZED");
      int i = 0;
      for (i = 0; i < 0; i++) {
        reject(500);
      }
    }
  }
  client.stop();
  if (measurement_flag == 1) {
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
      Serial.println("\nconnection failed\n");
      reject(10000);
      return;
    }
    if (client.connect(host, httpPort)) {
      url = "http://temperaturelog.altervista.org/website/inserisci_temperatura.php"; //folder location where is located the php file "inserisci_temperatura.php"
      url += "?temperatura=" + String(temperature);
      url += "&codice=" + String(content);
      Serial.println("Connected with " + url);
      // This will send the request to the server
      client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                   "Host: " + host + "\r\n" +
                   "Connection: close\r\n\r\n");
      loading(3);
      leds_off();

      // Read all the lines of the reply from server and print them to Serial

      while (client.available()) {
        String line = client.readStringUntil('\r');
        //Serial.print(line); //DEBUG
      }
      Serial.println("REGISTERED\n");
      registered(5000);
    }
  }
  else {
    Serial.print("FAILED\n");
    int i = 0;
    for (i = 0; i < 3; i++) {
      reject(500);
    }
  }
}

void leds_on(int red, int green, int blue) {   // set the LED color
  analogWrite(RedLed, red);
  analogWrite(GreenLed, green);
  analogWrite(BlueLed, blue);
}

void leds_off() {
  digitalWrite(BlueLed, 0);   // turn the LED off
  digitalWrite(GreenLed, 0);   // turn the LED off
  digitalWrite(RedLed, 0);   // turn the LED off
}

void reject(int buffering) {
  leds_on(255, 0, 0); // turn the Red LED on
  delay(buffering);
  leds_off();
  delay(buffering);
}
void connectweb(int times) {   // turn the Blue LED on in an alternative fading
  for (int i = 0; i < times; i++) {
    for (int i = 0; i < 256; i++) {
      leds_on(0, 0, 255 - i);
      delay(4);
    }
    for (int i = 0; i < 256; i++) {
      leds_on(0, 0, 0 + i);
      delay(4);
    }
  }
  leds_on(0, 0, 255);
  delay(50);
  leds_off();
  delay(50);
}
void authorize(int buffering) {
  for (int i = 0; i < 2; i++) {
    leds_on(0, 255, 0); // turn the Green LED on
    delay(buffering);
    leds_off();
    delay(buffering);
  }
}
void measurement(int times) {   // turn the Yellow LED on in an alternative fading
  for (int i = 0; i < times; i++) {
    for (int i = 0; i < 256; i++) {
      leds_on(0 + i, 0 + i, 0);
      delay(3);
    }
    for (int i = 0; i < 256; i++) {
      leds_on(255 - i, 255 - i, 0);
      delay(3);
    }
  }
}
void loading(int times) {   // turn the Yellow LED on
  for (int i = 0; i < times; i++) {
      leds_on(255, 255, 0);
      delay(1000);
    }
}
void registered(int buffering) {
  leds_on(0, 255, 0); // turn the Green LED on
  delay(buffering);
  leds_off();
}

// Helper routine to dump a byte array as hex values to Serial
void dump_byte_array(byte *buffer, byte bufferSize) {
  for (byte i = 0; i < bufferSize; i++) {
    //Serial.print(buffer[i] < 0x10 ? " 0" : " ");
    //Serial.print(buffer[i], HEX);
  }
}
