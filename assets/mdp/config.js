/*

    setting untuk konfigurasi javascript

    DEBUG = 1 untuk localhost
    DEBUG = 0 untuk Hosting di HO

*/

var DEBUG = 1;

var BASE_URL = "";

if (DEBUG == 2) {
    var BASE_URL = "http://167.99.64.44/Ananti/";
}else if(DEBUG==1){
    var BASE_URL = "http://localhost/ananti/";
}else{
    var BASE_URL = "http://10.23.3.101/MDP/";
}
