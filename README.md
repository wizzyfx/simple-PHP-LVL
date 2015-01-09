simple-PHP-LVL
==============

A simple PHP function for validating and parsing Google Play (Android Market) Licence Validation Library (LVL) responses.

After setting your package name and public signature as constants, simply pass signed data and server signature to the function. If verification succeeds, it will return all required parts in an array. If not, it will simply return false.

Requires OpenSSL to be enabled in PHP.
