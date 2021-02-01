/*
    setting untuk konfigurasi javascript
    DEBUG = 1 untuk localhost
    DEBUG = 0 untuk Hosting di HO
    
*/

var CUSTOM = 1;

var DEBUG = 1;

var BASE_URL = "";
var SITE_URL = "";

var INET_URL = "http://159.65.135.69/Ananti/";

var MAX_TEMP_BEARING = 80;
var MAX_TEMP_MOTOR = 60;

var MIN_CABLE_MEGGER = 5;
var MED_CABLE_MEGGER = 20;
var SAFE_CABLE_MEGGER = 50;

var MIN_MOTOR_MEGGER = 5;
var MED_MOTOR_MEGGER = 20;
var SAFE_MOTOR_MEGGER = 50;

if(CUSTOM == 1) {
    var url = window.location.href;
    console.log(url);

    var x = url.split("/");
    console.log(x);

    BASE_URL = x[0]+"//"+x[2]+"/"+x[3]+"/"; // "http://localhost/ananti/";
    if(x[4]=="index.php"){
        SITE_URL = x[0]+"//"+x[2]+"/"+x[3]+"/index.php/"; // "http://localhost/ananti/index.php";
    }else{
        SITE_URL = x[0]+"//"+x[2]+"/"+x[3]+"/"; // "http://localhost/ananti/";
    }

    console.log(BASE_URL);
    console.log(SITE_URL);
}else{
    if (DEBUG == 2) {
        var BASE_URL = "http://167.99.64.44/Ananti/";
    } else if (DEBUG == 1) {
        var BASE_URL = "http://localhost/ananti/";
    } else {
        var BASE_URL = "http://10.23.3.101/MDP/";
    }

}