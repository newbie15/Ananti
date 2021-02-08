<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('job_name')){
   function job_name($x){
        switch ($x) {
            case 'J10' : return 'Breakers, LV Insulated Case >400A (inlcuding trip units)'; break;
            case 'J11' : return 'Switches, LV (>400A)'; break;
            case 'J12' : return 'DC power supply'; break;
            case 'J13' : return 'Battery Charger'; break;
            case 'J14' : return 'UPS System'; break;
            case 'J15' : return 'Batteries, Sealed and Vented'; break;
            case 'J16' : return 'Breakers(Short Circuit Breaker), HV Air'; break;
            case 'J16' : return 'Breakers(Short Circuit Breaker), HV Vacuum'; break;
            case 'J16' : return 'Breakers(Short Circuit Breaker), HV Oil'; break;
            case 'J16' : return 'Breakers(Short Circuit Breaker), HV SF6'; break;
            case 'J17' : return 'Switches, HV Air (with or without fuse)'; break;
            case 'J17' : return 'Switches, HV Vacuum (with or without fuse)'; break;
            case 'J17' : return 'Switches, HV SF6 (with or without fuse)'; break;
            case 'J19' : return 'Switchgear/Switchboard (including MCC), LV '; break;
            case 'J20' : return 'Starters (Contactors), fixed mounted, LV'; break;
            case 'J21' : return 'Starters (Contactors), withdrawable, LV'; break;
            case 'J24' : return 'Variable Speed Drives VSD, LV'; break;
            case 'J25' : return 'Softstarters, LV'; break;
            case 'J4'  : return 'Transformer, Oil-Filled >500 KVA (incl. OLTC)'; break;
            case 'J40' : return 'Main feeding busbars, LV, External'; break;
            case 'J42' : return 'Power Factor Correction PFC (Capacitors incl. Reactors), LV'; break;
            case 'J46' : return 'Starters (Contactors), HV Vacuum'; break;
            case 'J46' : return 'Starters (Contactors), HV Air'; break;
            case 'J47' : return 'Variable Speed Drive VSD, HV'; break;
            case 'J48' : return 'Softstarter, HV'; break;
            case 'J5'  : return 'Transformer, Oil-Filled >= 5000 KVA (incl. OLTC)'; break;
            case 'J6'  : return 'Transformer, Dry-Type >500 KVA'; break;
            case 'J60' : return 'Cable, HV '; break;
            case 'J61' : return 'Cables, LV'; break;
            case 'J62' : return 'Overhead power line, HV'; break;
            case 'J62' : return 'Overhead power line, LV'; break;
            case 'J7'  : return 'Transformer, Dry-Type >= 5000 KVA'; break;
            case 'J8'  : return 'Breakers, LV Power >400A (inlcuding trip units)'; break;
            case 'J9'  : return 'Breakers, LV Molded Case >400A (inlcuding trip units)'; break;

            default: return "-";  break;
        }
    }
}